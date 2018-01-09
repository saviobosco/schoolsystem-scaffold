<?php
namespace FinanceManager\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\I18n\Date;
use Cake\ORM\Entity;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Students Model
 *
 * @property \FinanceManager\Model\Table\ClassesTable|\Cake\ORM\Association\BelongsTo $Classes
 * @property \FinanceManager\Model\Table\ReceiptsTable|\Cake\ORM\Association\HasMany $Receipts
 * @property \FinanceManager\Model\Table\StudentFeesTable|\Cake\ORM\Association\HasMany $StudentFees
 * @property \FinanceManager\Model\Table\StudentFeePaymentsTable|\Cake\ORM\Association\HasMany $StudentFeePayments
 *
 * @method \FinanceManager\Model\Entity\Student get($primaryKey, $options = [])
 * @method \FinanceManager\Model\Entity\Student newEntity($data = null, array $options = [])
 * @method \FinanceManager\Model\Entity\Student[] newEntities(array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Student|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \FinanceManager\Model\Entity\Student patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Student[] patchEntities($entities, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Student findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StudentsTable extends Table
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

        $this->setTable('students');
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

        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id',
            'joinType' => 'INNER',
            'className' => 'FinanceManager.Classes'
        ]);
        $this->hasMany('StudentFees', [
            'foreignKey' => 'student_id',
            'className' => 'FinanceManager.StudentFees'
        ]);

        $this->hasMany('Receipts', [
            'foreignKey' => 'student_id',
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
            ->add('id', 'unique', [
                'rule' => 'validateUnique',
                'last'=>true,
                'message' => __( 'Admission Number already exists'),
                'provider' => 'table'])
            ->requirePresence('id', 'create')
            ->notEmpty('id', 'create');

        $validator
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            //->requirePresence('date_of_birth', 'create')
            ->allowEmpty('date_of_birth');

        $validator
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');

        $validator
            ->allowEmpty('religion');

        $validator
            ->allowEmpty('home_residence');

        $validator
            ->allowEmpty('guardian');

        $validator
            ->allowEmpty('relationship_to_guardian');

        $validator
            ->allowEmpty('occupation_of_guardian');

        $validator
            ->allowEmpty('guardian_phone_number');

        $validator
            ->allowEmpty('photo');

        $validator
            ->allowEmpty('photo_dir');

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
        $rules->add($rules->existsIn(['class_id'], 'Classes'));

        return $rules;
    }

    /***
     * @param Event $event
     * @param $data
     * The function is fired by the cakephp system automatically before a
     * request data is converted to entities
     */
    public function beforeMarshal(Event $event, $data )
    {
        if ( !empty($data['date_of_birth'] )) {
            $data['date_of_birth'] = new Date($data['date_of_birth']); // Converts the birth date Date properly
        }
    }


    public function deleteStudent(EntityInterface $student )
    {
        if ( (bool)$this->StudentFees->find()->where(['student_id'=>$student->id])->first() ) {
            throw new \PDOException;
        }
        $this->delete($student);
        return true;
    }


    public function getStudentFees($student_id)
    {
        /*return $this->StudentFees->Fees->find('all')
            ->contain([
                'FeeCategories' => function ($q) {
                    return $q->select(['FeeCategories.id','FeeCategories.type']);
                },
                'StudentFees' => function ($q) use ($student_id){
                    return $q->where(['student_id'=>$student_id,'paid'=>0]);
                }
            ])->groupBy('session_id')->toArray();*/

        $studentFees = $this->StudentFees->find('all')
            ->contain(['Fees.FeeCategories' => function ($q) {
                return
                    $q->select(['FeeCategories.id','FeeCategories.type']);
                $q->orderDesc('Fees.created');
            }])->where(['student_id'=>$student_id,'paid'=>0]);

        return $studentFees/*->groupBy('fee.session_id')*/->toArray();
    }

    public function getStudentFeesWithTermClassSession($student_id,$term_id,$class_id,$session_id)
    {
        $studentFees = $this->StudentFees->find('all')
            ->contain(['Fees.FeeCategories' => function ($q) use ($term_id,$class_id,$session_id) {
                if ( empty($term_id) ) {
                    return
                        $q->select(['FeeCategories.id','FeeCategories.type'])
                            ->where(['Fees.class_id' => $class_id,'Fees.session_id' => $session_id])
                            ->orderDesc('Fees.created');
                } else {
                    return
                        $q->select(['FeeCategories.id','FeeCategories.type'])
                            ->where(['Fees.class_id' => $class_id,'Fees.session_id' => $session_id,'Fees.term_id' => $term_id ])
                            ->orderDesc('Fees.created');
                }

            }])->where(['student_id'=>$student_id,'paid'=>0]);

        return $studentFees->toArray();
    }


    public function getReceiptDetails($receipt_id)
    {
        $receiptsTable = TableRegistry::get('FinanceManager.Receipts');
        return $receiptDetails = $receiptsTable->find('all')->contain([
            'Payments',
            'StudentFeePayments.StudentFees.Fees.FeeCategories' => function($q) {
                return
                    $q->select(['FeeCategories.id','FeeCategories.type']);
                $q->orderDesc('Fees.created');
            }
        ])->where(['Receipts.id'=>$receipt_id])->first();
    }

    public function getStudentsWithId( $id )
    {
        return $this->find('all')->contain(['Classes'])->where(['Students.id'=>$id])->toArray();
    }

    public function getStudentArrears($student_id)
    {
        return $studentFees = $this->StudentFees->find('all')
            ->contain(['Fees.FeeCategories' => function ($q) {
                return
                    $q->select(['FeeCategories.id','FeeCategories.type']);
                $q->orderDesc('Fees.created');
            }
            ])->where(['student_id'=>$student_id,'paid'=>0])->toArray();
    }

    public function getStudentPaymentReceipts()
    {

    }

    public function changeStudentsClass($class_id,$student_ids)
    {
        $returnData['success'] = 1;
        // get the students one by one
        foreach ( $student_ids as $student_id) {
            $student = $this->find()->select(['id','class_id'])->where(['id'=>$student_id])->first();
            // change the class
            if ( !$student ) {
                continue;
            }
            if ( $student->class_id == $class_id ) {
                $returnData['success'] = 0;
                break;
            }
            $student->class_id = $class_id;
            $this->save($student);
        }
        return $returnData;
    }

    public function getStudentsDataList()
    {
        $students = $this->StudentFees->Students->find('all')
            ->map(function($row ) {
                $row->full_name = $row->first_name.' '.$row->last_name;
                return $row;
            })
            ->combine('id','full_name')
            ->toArray();
        return $students;
    }

    public function afterSave(Event $event,Entity $entity)
    {
        if ($event->isStopped() === false){
            // create the student fees
            if ( $entity->isNew()){
                $this->createStudentFeesByClassIdAndSessionId($entity->id,$entity->class_id,$entity->session_id);
            }
        }
    }

    /**
     * @param $student_id
     * @param $class_id
     * @param $session_id
     * This function creates a new student fees using the student class and session admitted.
     */
    public function createStudentFeesByClassIdAndSessionId($student_id,$class_id,$session_id)
    {
        $fees = $this->StudentFees->Fees->find('all')->where(['class_id'=>$class_id,'session_id'=>$session_id]);
        foreach ( $fees as $fee ) {
            // check if student has the record
            $recordExists = (bool)$this->StudentFees->find()->where(['fee_id'=>$fee->id,'student_id'=>$student_id])->first();
            if ( $recordExists ) {
                continue;
            }
            $student_fee = $this->StudentFees->newEntity(['fee_id'=>$fee->id,'student_id'=>$student_id,'paid'=>0]);
            if($this->StudentFees->save($student_fee)) {
                // increment number of students
                $fee->number_of_students = (int)$fee->number_of_students + 1;
                $fee->income_amount_expected = (float)$fee->income_amount_expected + $fee->amount;
                $this->StudentFees->Fees->save($fee);
            }
        }
    }
}
