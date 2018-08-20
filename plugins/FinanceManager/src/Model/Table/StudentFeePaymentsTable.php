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
    const EVENT_DELETED_PAYMENT_FEE_ITEM = 'Model.StudentFeePayments.afterPaymentItemIsDeleted';
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
    public function processPaymentData($paymentInput,$paymentOutput = [])
    {
        $total = 0;
        if ( is_array($paymentInput)) {
            foreach ( $paymentInput as $value ) {
                $value->amount_paid = str_replace(',','',$value->amount_paid);// removes any comma in the figure
                if ( !empty(trim($value->amount_paid)) && $value->amount_paid > 0 ) {
                    $paymentOutput[] = $value;
                    $total += $value->amount_paid;
                }
            }
        }
        return ['paymentData' => $paymentOutput , 'total' => $total ] ;
    }

    /**
     * @param $postData
     * @return null
     * Pays student fees
     */
    public function payFees($postData)
    {
        $return = null;
        $entities = $this->newEntities($postData['student_fees']);
        // Process data and get total amount paid
        $studentPaymentDetails = $this->processPaymentData($entities);
        if ( empty($studentPaymentDetails['paymentData']) ) {
            $return['error'] = 'No payment amount was entered for payment';
            return $return;
        }
        // generate receipt
        $receiptDetail = $this->Receipts->generateReceipt($postData['student_id'],$studentPaymentDetails['total']);
        // generate and save payment records
        if ($this->savePayment($studentPaymentDetails['paymentData'],$receiptDetail,$postData['payment']) === false) {
            $return['error'] = __('Could not save the payment details please try again.');
            // revert the receipt generated
            $this->Receipts->delete($receiptDetail);
            return $return;
        }
        $return['receipt_id'] = $receiptDetail->id;
        return $return;
    }


    public function savePayment(Array $StudentFeesPaymentItems,EntityInterface $receipt,$paymentDetail)
    {
        if ( empty($StudentFeesPaymentItems)) {
            return false;
        }
        $paymentTable = TableRegistry::get('FinanceManager.Payments');
        $paymentDetail['payment_status'] = 1;
        $paymentDetail['receipt_id'] = $receipt->id;
        $newEntity = $paymentTable->newEntity($paymentDetail);
        $savedPaymentRecord = $paymentTable->save($newEntity);
        if ($savedPaymentRecord === false ) {
            // delete the receipt
            $this->Receipts->delete($receipt);
            return false;
        }
        foreach ( $StudentFeesPaymentItems as $paymentItem ) {
            if ( $paymentItem->amount_paid < $paymentItem->amount_to_pay ) {
                $paymentItem->amount_remaining = (float)$paymentItem->amount_to_pay - (float)$paymentItem->amount_paid ;
            }
            $paymentItem->receipt_id = $receipt->id;
            $savedPaymentItem = $this->save($paymentItem);

            $event = new Event(self::EVENT_AFTER_EACH_FEE_PAYMENT,$this,[
                'paymentItem' => $savedPaymentItem ]);
            $this->getEventManager()->dispatch($event);
        }
        $event = new Event(self::EVENT_AFTER_FEES_PAYMENT,$this,[
            'receipt' => $receipt
        ]);
        $this->getEventManager()->dispatch($event);
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

    public function getStudentPaymentRecords($student_id)
    {
        $query = $this->find('all')
            ->enableHydration(false)
            ->contain([
                'StudentFees' => function ($q) use ($student_id) {
                    $q->select(['id', 'student_id', 'fee_id']);
                    $q->where(['StudentFees.student_id' => $student_id]);
                    return $q;
                },
                'StudentFees.Fees' => function ($q) {
                    $q->select(['Fees.id', 'Fees.fee_category_id','Fees.session_id','Fees.class_id','Fees.term_id']);
                    return $q;
                },
                'StudentFees.Fees.FeeCategories' => function ($q) {
                    $q->select(['FeeCategories.id', 'FeeCategories.type']);
                    return $q;
                }
            ]);
        $specialFeePayments = $this->find('all')
            ->enableHydration(false)
            ->contain([
            'StudentFees'=>function($q){
                $q->select(['id', 'student_id', 'fee_id','Purpose']);
                $q->where(['StudentFees.fee_id IS NULL']);
                return $q;
            }
        ])->toArray();
        $mergedFeesPayments = collection($query->toArray())->append($specialFeePayments);
        return $mergedFeesPayments->toList();
    }

    public function destroyStudentFeePaymentsBelongingToReceipt($receipt)
    {
        $studentFeePaymentItems = $this->find('all')
            ->contain(['StudentFees'])
            ->where(['StudentFeePayments.receipt_id' => $receipt->id]);
        $studentFees = null;
        foreach ( $studentFeePaymentItems as $paymentItem ) {
            if ($paymentItem->student_fee->paid) {
                $paymentItem->student_fee->amount_remaining = $paymentItem->amount_paid;
            } else {
                $paymentItem->student_fee->amount_remaining = $paymentItem->student_fee->amount_remaining + $paymentItem->amount_paid;
            }
            $paymentItem->student_fee->paid = 0;
            $studentFees[] = $paymentItem->student_fee;
            if ($this->delete($paymentItem)) {
                $event = new Event(self::EVENT_DELETED_PAYMENT_FEE_ITEM, $this, [
                    'paymentItem' => $paymentItem
                ]);
                $this->getEventManager()->dispatch($event);
            }
        }
        $this->StudentFees->saveMany($studentFees);
    }
}
