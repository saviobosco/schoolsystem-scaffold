<?php
namespace FinanceManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
/**
 * StudentFeePayments Model
 *
 * @property \FinanceManager\Model\Table\StudentFeesTable|\Cake\ORM\Association\BelongsTo $StudentFees
 * @property \FinanceManager\Model\Table\ReceiptsTable|\Cake\ORM\Association\BelongsTo $Receipts
 * @property \FinanceManager\Model\Table\FeesTable|\Cake\ORM\Association\BelongsTo $Fees
 * @property \FinanceManager\Model\Table\FeeCategoriesTable|\Cake\ORM\Association\BelongsTo $FeeCategories
 *
 * @method \FinanceManager\Model\Entity\StudentFeePayment get($primaryKey, $options = [])
 * @method \FinanceManager\Model\Entity\StudentFeePayment newEntity($data = null, array $options = [])
 * @method \FinanceManager\Model\Entity\StudentFeePayment[] newEntities(array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\StudentFeePayment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \FinanceManager\Model\Entity\StudentFeePayment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\StudentFeePayment[] patchEntities($entities, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\StudentFeePayment findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StudentFeePaymentsTable extends Table
{

    const EVENT_AFTER_FEES_PAYMENT = 'Model.StudentFeePayments.afterPayment';
    const EVENT_AFTER_EACH_FEE_PAYMENT = 'Model.StudentFeePayments.afterEachPaymentSaved';
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('student_fee_payments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('Muffin/Footprint.Footprint', [
            'events' => [
                'Model.beforeSave' => [
                    'created_by' => 'new',
                    'modified_by' => 'always'
                ]
            ],
        ]);

        $this->belongsTo('StudentFees', [
            'foreignKey' => 'student_fee_id',
            'joinType' => 'INNER',
            'className' => 'FinanceManager.StudentFees'
        ]);

        $this->belongsTo('Receipts', [
            'foreignKey' => 'receipt_id',
            'joinType' => 'INNER',
            'className' => 'FinanceManager.Receipts'
        ]);

        $this->hasMany('Incomes', [
            'foreignKey' => 'student_fee_payment_id',
            'className' => 'FinanceManager.Incomes'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->decimal('amount_paid')
            ->requirePresence('amount_paid', 'create')
            ->notEmpty('amount_paid');

        $validator
            ->decimal('amount_remaining')
            ->allowEmpty('amount_remaining');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['student_fee_id'], 'StudentFees'));

        return $rules;
    }

    /**
     * @param $paymentInput
     * @param array $paymentOutput
     * @return array
     * This Function filters through each payment Data to remove those with empty amount
     * This is to prevent data corruption ..
     */
    public function processPaymentData($paymentInput,&$paymentOutput = [])
    {
        $total = 0;
        if ( is_array($paymentInput)) {
            foreach ( $paymentInput as $id => $value ) {
                if ( !empty(trim($value->amount_paid)) && $value->amount_paid > 0 ) {
                    $paymentOutput[] = $value;
                    $total += $value->amount_paid;
                }
            }
        }
        return ['paymentData' => $paymentOutput , 'total' => $total ] ;
    }

    public function savePayment(Array $payments,EntityInterface $receipt ,$paymentDetail)
    {
        if ( empty($payments)) {
            return false;
        }
        // Create payment Record
        $paymentTable = TableRegistry::get('FinanceManager.Payments');
        $paymentDetail['payment_status'] = 1;
        $newEntity = $paymentTable->newEntity($paymentDetail);
        $savedPaymentRecord = $paymentTable->save($newEntity);
        if ($savedPaymentRecord === false ) {
            // delete the receipt
            $this->Receipts->delete($receipt);
            return false;
        }

        foreach ( $payments as $payment ) {

            if ( $payment->amount_paid < $payment->amount_to_pay ) { // if amount paid is less than the amount to pay
                $payment->amount_remaining = (float)$payment->amount_to_pay - (float)$payment->amount_paid ;
            }
            $payment->receipt_id = $receipt->id;
            $saved = $this->save($payment);

            $event = new Event(self::EVENT_AFTER_EACH_FEE_PAYMENT,$this,[
                'paymentDetail' => $saved ]);
            $this->getEventManager()->dispatch($event);
            // dispatch Income by fees record keeping
        }
        $event = new Event(self::EVENT_AFTER_FEES_PAYMENT,$this,[
            'receipt' => $receipt
        ]);
        // dispatch payment event
        $this->getEventManager()->dispatch($event);
        // this returns the receipt id
        return true;
    }


    public function afterSave(Event $event, EntityInterface $entity )
    {
        if ( $event->isStopped() === false) {
            $studentFees = $this->StudentFees->get($entity->student_fee_id);
            if ( $entity->amount_remaining ) {
                $studentFees->amount_remaining = $entity->amount_remaining;
                $this->StudentFees->save($studentFees);
            } else {
                $studentFees->paid = 1;
                $studentFees->amount_remaining = null;
                $this->StudentFees->save($studentFees);
            }
        }
    }
}
