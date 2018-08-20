<?php
namespace FinanceManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\EntityInterface;
use FinanceManager\Exception\MissingIncomeRecordException;

/**
 * Receipts Model
 *
 * @property \FinanceManager\Model\Table\StudentsTable|\Cake\ORM\Association\BelongsTo $Students
 * @property \FinanceManager\Model\Table\IncomesTable|\Cake\ORM\Association\BelongsTo $Incomes
 * @property \FinanceManager\Model\Table\PaymentsTable|\Cake\ORM\Association\HasMany $Payments
 * @property \FinanceManager\Model\Table\StudentFeePaymentsTable|\Cake\ORM\Association\HasMany $StudentFeePayments
 *
 * @method \FinanceManager\Model\Entity\Receipt get($primaryKey, $options = [])
 * @method \FinanceManager\Model\Entity\Receipt newEntity($data = null, array $options = [])
 * @method \FinanceManager\Model\Entity\Receipt[] newEntities(array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Receipt|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \FinanceManager\Model\Entity\Receipt patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Receipt[] patchEntities($entities, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Receipt findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReceiptsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('receipts');
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

        $this->hasMany('StudentFeePayments', [
            'foreignKey' => 'receipt_id',
            'joinType' => 'INNER',
            'className' => 'FinanceManager.StudentFeePayments'
        ]);

        $this->hasOne('Payments', [
            'foreignKey' => 'receipt_id',
            'joinType' => 'INNER',
            'className' => 'FinanceManager.Payments'
        ]);

        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER',
            'className' => 'FinanceManager.Students'
        ]);

        $this->belongsTo('CreatedByUser',[
            'className' => 'FinanceManager.Accounts',
            'foreignKey' => 'created_by'
        ]);

        $this->belongsTo('ModifiedByUser',[
            'className' => 'FinanceManager.Accounts',
            'foreignKey' => 'modified_by'
        ]);

        $this->belongsTo('Incomes',[
            'className' => 'FinanceManager.Incomes',
            'foreignKey' => 'receipt_id'
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


        return $validator;
    }

    public function generateReceipt($student_id,$total)
    {
        $newData = $this->newEntity([
            'student_id' => $student_id,
            'total_amount_paid' => $total
        ]);
        return $this->save($newData);
    }

    public function deleteReceipt(EntityInterface $receipt)
    {
        try {
            $this->Incomes->removeRecordWithReceiptId($receipt);
            $this->StudentFeePayments->destroyStudentFeePaymentsBelongingToReceipt($receipt);
            $this->delete($receipt);
        } catch (MissingIncomeRecordException $exception) {
            return false;
        }
        return true;
    }

    public function getReceiptDetails($receipt_id)
    {
        $receipt = $this->find('all')->contain([
            'StudentFeePayments.StudentFees.Fees.FeeCategories' => function($q) {
                $q->select(['FeeCategories.id','FeeCategories.type']);
                $q->orderDesc('Fees.created');
                return $q;
            }
        ])
            ->select(['Receipts.id'])
            ->where(['Receipts.id'=>$receipt_id])
            ->enableHydration(false)
            ->first();
        // getting the student special fees
        $specialFees = $this->find('all')->contain([
            'StudentFeePayments.StudentFees'=>function($q){
                $q->where(['StudentFees.fee_id IS NULL']);
                return $q;
            }
        ])->enableHydration(false)->where(['Receipts.id'=>$receipt_id])->first();
        $collection = collection($receipt['student_fee_payments'])->append($specialFees['student_fee_payments']);
        return $collection->toList();
    }
}
