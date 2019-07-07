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
            'className' => 'FinanceManager.StudentFees',
            'joinType' => 'LEFT'
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

    /**
     * @param $student_id
     * @param array $queryData
     * @return array
     * Get the student fees with session class and term.
     */
    public function getStudentFees($student_id,$queryData = [])
    {
        $studentFees = $this->StudentFees->find('all')
            ->enableHydration(false)
            ->contain(['Fees.FeeCategories'=> function ($q) use ($queryData) {
                    $q->select(['FeeCategories.id','FeeCategories.type']);
                    if ( isset($queryData['session_id']) && !empty($queryData['session_id'])) {
                        $q->where(['Fees.session_id'=>$queryData['session_id']]);
                    }
                    if ( isset($queryData['class_id']) && !empty($queryData['class_id'])) {
                        $q->where(['Fees.class_id'=>$queryData['class_id']]);
                    }
                    if ( isset($queryData['term_id']) && !empty($queryData['term_id'])) {
                        $q->where(['Fees.term_id'=>$queryData['term_id']]);
                    }
                    $q->orderDesc('Fees.created');
                return $q;
            },
                'Fees.Classes',
                'Fees.Terms',
                'Fees.Sessions'
            ])->where(['student_id'=>$student_id,'paid'=>0])
            ->orderDesc('session_id')
            ->orderDesc('class_id')
            ->orderDesc('term_id');
            $collection = collection($studentFees->toArray()); // make fee a collection
            $mergedFees = $collection->append($this->getStudentSpecialFees($student_id)); // gets student special fee if any.
        return $mergedFees->toList();
    }

    /**
     * @param $student_id
     * @return array
     * This function is used to get the student special fees.
     */
    public function getStudentSpecialFees($student_id)
    {
        $studentFees = $this->StudentFees->find('all')
            ->enableHydration(false)
            ->where(['fee_id IS NULL'])
            ->andWhere(['student_id'=>$student_id,'paid'=>0]);
        return $studentFees->toArray();
    }

    /**
     * @param $receipt_id
     * @return array|EntityInterface|null
     * THis function is used to get the student receipts
     */
    public function getReceiptDetails($receipt_id)
    {
        $receipt = $this->Receipts->find('all')->contain([
            'Students' => function ($q){
                $q->select(['id','first_name','last_name','class_id']);
                return $q;
            },
            'Students.Classes'=> function ($q){
                $q->select(['id','class']);
                return $q;
            },
            'Payments',
            'StudentFeePayments.StudentFees.Fees.FeeCategories' => function($q) {
                    $q->select(['FeeCategories.id','FeeCategories.type']);
                    $q->orderDesc('Fees.created');
                return $q;
            }
        ])->where(['Receipts.id'=>$receipt_id])->enableHydration(false)->first();
        // getting the student special fees
        $specialFees = $this->Receipts->find('all')->contain([
            'StudentFeePayments.StudentFees'=>function($q){
                $q->where(['StudentFees.fee_id IS NULL']);
                return $q;
            }
        ])->enableHydration(false)->where(['Receipts.id'=>$receipt_id])->first();
        $collection = collection($receipt['student_fee_payments'])->append($specialFees['student_fee_payments']);
        $receipt['student_fee_payments'] = $collection->toList();
        return $receipt;
    }

    /**
     * @param $id
     * @return array
     * Get the list of students with class
     * Used in the Ajax student class
     */
    public function getStudentsWithId($id)
    {
        return $this->find('all')
            ->select(['Students.id','Students.first_name','Students.last_name'])
            ->contain(['Classes'=>function($q){ $q->select(['Classes.id','Classes.class']); return $q;}])
            ->where(['Students.id'=>$id])
            ->enableHydration(false)
            ->toArray();
    }

    /**
     * @param $student_id
     * @return array
     * this function is used to return the student arrears
     */
    public function getStudentArrears($student_id)
    {
        return $studentFees = $this->StudentFees->find('all')
            ->contain(['Fees' => function ($q) {
                $q->select(['id','amount']);
                $q->orderDesc('Fees.created');
                return $q;
            }
            ])->where(['student_id'=>$student_id,'paid'=>0])->enableHydration(false)->toArray();
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

    public function getReceipts($student_id)
    {
        return $this->Receipts->find('all')
            ->enableHydration(false)
            ->where(['student_id' => $student_id])
            ->orderDesc('created')
            ->toArray();
    }
}
