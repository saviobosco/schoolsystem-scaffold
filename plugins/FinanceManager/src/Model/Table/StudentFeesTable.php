<?php
namespace FinanceManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\EntityInterface;


/**
 * StudentFees Model
 *
 * @property \FinanceManager\Model\Table\StudentsTable|\Cake\ORM\Association\BelongsTo $Students
 * @property \FinanceManager\Model\Table\FeesTable|\Cake\ORM\Association\BelongsTo $Fees
 * @property \FinanceManager\Model\Table\StudentFeePaymentsTable|\Cake\ORM\Association\HasMany $StudentFeePayments
 *
 * @method \FinanceManager\Model\Entity\StudentFee get($primaryKey, $options = [])
 * @method \FinanceManager\Model\Entity\StudentFee newEntity($data = null, array $options = [])
 * @method \FinanceManager\Model\Entity\StudentFee[] newEntities(array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\StudentFee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \FinanceManager\Model\Entity\StudentFee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\StudentFee[] patchEntities($entities, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\StudentFee findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StudentFeesTable extends Table
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
        $this->addBehavior('Timestamp');
        $this->addBehavior('Muffin/Footprint.Footprint', [
            'events' => [
                'Model.beforeSave' => [
                    'created_by' => 'new',
                    'modified_by' => 'always'
                ]
            ],
        ]);

        $this->setTable('student_fees');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER',
            'className' => 'FinanceManager.Students'
        ]);
        $this->belongsTo('Fees', [
            'foreignKey' => 'fee_id',
            'joinType' => 'INNER',
            'className' => 'FinanceManager.Fees'
        ]);
        $this->hasMany('StudentFeePayments', [
            'foreignKey' => 'student_fee_id',
            'className' => 'FinanceManager.StudentFeePayments'
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
            ->boolean('paid')
            ->requirePresence('paid', 'create')
            ->notEmpty('paid');

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
        $rules->add($rules->existsIn(['student_id'], 'Students'));
        $rules->add($rules->existsIn(['fee_id'], 'Fees'));

        return $rules;
    }

    public function deleteStudentFee(EntityInterface $studentFee)
    {
        if ( (bool)$this->StudentFeePayments->find()->where(['student_fee_id'=>$studentFee->id])->first()) {
            throw new \PDOException;
        }
        $studentFeeDeleted = $this->delete($studentFee);
        if($studentFeeDeleted) {
            // decrement fees statistics
            if (!empty($studentFeeDeleted->fee_id)) {
                $fee = $this->Fees->get($studentFeeDeleted->fee_id);
                $fee->number_of_students = (int)$fee->number_of_students - 1;
                $fee->income_amount_expected = (float)$fee->income_amount_expected - $fee->amount;
                $this->Fees->save($fee);
            }
        }
        return true;
    }
}
