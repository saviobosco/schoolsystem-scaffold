<?php
namespace FinanceManager\Model\Table;

use Cake\Database\Driver\Sqlite;
use Cake\Datasource\EntityInterface;
use Cake\I18n\Number;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Fees Model
 *
 * @property \FinanceManager\Model\Table\FeeCategoriesTable|\Cake\ORM\Association\BelongsTo $FeeCategories
 * @property \FinanceManager\Model\Table\TermsTable|\Cake\ORM\Association\BelongsTo $Terms
 * @property \FinanceManager\Model\Table\ClassesTable|\Cake\ORM\Association\BelongsTo $Classes
 * @property \FinanceManager\Model\Table\SessionsTable|\Cake\ORM\Association\BelongsTo $Sessions
 * @property \FinanceManager\Model\Table\StudentFeePaymentsTable|\Cake\ORM\Association\HasMany $StudentFeePayments
 * @property \FinanceManager\Model\Table\StudentFeesTable|\Cake\ORM\Association\HasMany $StudentFees
 *
 * @method \FinanceManager\Model\Entity\Fee get($primaryKey, $options = [])
 * @method \FinanceManager\Model\Entity\Fee newEntity($data = null, array $options = [])
 * @method \FinanceManager\Model\Entity\Fee[] newEntities(array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Fee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \FinanceManager\Model\Entity\Fee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Fee[] patchEntities($entities, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Fee findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FeesTable extends Table
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

        $this->setTable('fees');
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

        $this->belongsTo('FeeCategories', [
            'foreignKey' => 'fee_category_id',
            'joinType' => 'INNER',
            'className' => 'FinanceManager.FeeCategories'
        ]);
        $this->belongsTo('Terms', [
            'foreignKey' => 'term_id',
            'className' => 'FinanceManager.Terms'
        ]);
        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id',
            'joinType' => 'INNER',
            'className' => 'FinanceManager.Classes'
        ]);
        $this->belongsTo('Sessions', [
            'foreignKey' => 'session_id',
            'joinType' => 'INNER',
            'className' => 'FinanceManager.Sessions'
        ]);
        $this->hasMany('StudentFees', [
            'foreignKey' => 'fee_id',
            'className' => 'FinanceManager.StudentFees',
        ]);
        $this->hasMany('StudentFeePayments', [
            'foreignKey' => 'fee_id',
            'className' => 'FinanceManager.StudentFeePayments',
        ]);

        $this->belongsTo('FeeCategories',[
            'foreignKey' => 'fee_category_id',
            'className' => 'FinanceManager.FeeCategories',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('CreatedByUser',[
            'className' => 'FinanceManager.Accounts',
            'foreignKey' => 'created_by'
        ]);

        $this->belongsTo('ModifiedByUser',[
            'className' => 'FinanceManager.Accounts',
            'foreignKey' => 'modified_by'
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
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');


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
        $rules->add($rules->existsIn(['fee_category_id'], 'FeeCategories'));
        $rules->add($rules->existsIn(['term_id'], 'Terms'));
        $rules->add($rules->existsIn(['class_id'], 'Classes'));
        $rules->add($rules->existsIn(['session_id'], 'Sessions'));

        return $rules;
    }

    /**
     * @param EntityInterface $fee
     * @return bool
     * This function checks if a fee exists
     */
    public function checkIfFeeExists(EntityInterface $fee)
    {
        $query = $this->find('all')
            ->where([
            'fee_category_id'=>$fee->fee_category_id,
            'class_id'=>$fee->class_id,
            'session_id' => $fee->session_id,
            ]);
            if ($fee->term_id) {
                $query->andWhere(['term_id'=>$fee->term_id]);
            } else {
                $query->andWhere(['term_id IS NULL']);
            }
            $query = $query->first();
        if (!empty($query)) {
            return true ;
        }
        return false;
    }

    public function addFee($postData)
    {
        if ( 0 === (int)$postData['class_id']){
            $studentsTable = TableRegistry::get('FinanceManager.Students');
            $classes = $this->Classes->find('all');
            foreach($classes as $class) {
                $studentCounts = $studentsTable->find('all')->where(['class_id'=>$class->id,'status'=>1])->count();
                $fee = $this->newEntity([
                    'fee_category_id'=>$postData['fee_category_id'],
                    'compulsory' => $postData['compulsory'],
                    'amount' => $postData['amount'],
                    'term_id' => $postData['term_id'],
                    'class_id' => $class->id,
                    'session_id' => $postData['session_id'],
                    'income_amount_expected' => $studentCounts * $postData['amount'],
                    'number_of_students' => $studentCounts,
                ]);
                $fee = $this->saveFee($fee);
                if ( $fee && 1 === (int)$postData['create_students_records']) {
                    $this->createStudentsFeeRecordByClass($fee->id,$fee->class_id);
                }
                unset($studentCounts);
            }
            return true;
        } else {
            $fee = $this->newEntity($postData);
            $fee = $this->saveFee($fee);
            if ( $fee && 1 === (int)$postData['create_students_records']) {
                $this->createStudentsFeeRecordByClass($fee->id,$fee->class_id);
            }
            return true;
        }
        return false;
    }

    public function saveFee(EntityInterface $fee)
    {
        // check if fee exists
        if ( $this->checkIfFeeExists($fee)) {
            return false;
        }
        $fee = $this->save($fee);
        return $fee;
    }

    /**
     * @param $fee_id
     * @param $class_id
     * @return bool
     * This function is creates the student fees.
     */
    public function createStudentsFeeRecordByClass($fee_id,$class_id)
    {
        $studentsTable = TableRegistry::get('FinanceManager.Students');
        // find all student under that fees class and session
        $students = $studentsTable->find('all')
            ->select(['id','class_id','status'])
            ->where(['class_id'=>$class_id,'status' =>1])->enableHydration(false);
        // iterate through the result set and create their respective fees
        if ( $students ) {
            //Initialize the student fees table
            $studentFeesTable = TableRegistry::get('FinanceManager.StudentFees');
            foreach ( $students as $student ) {
                $newStudentFees = $studentFeesTable->newEntity([
                    'student_id' => $student['id'],
                    'fee_id' => $fee_id,
                    'paid' => 0,
                ]);
                $studentFeesTable->save($newStudentFees); // Save the student details
            }
        }
        return true;
    }

    public function getFeeDefaulters(Array $queryData )
    {
        $query = $this->StudentFees->find('all')
            ->enableHydration(false)
            ->select(['student_id','fee_id','amount_remaining'])
            ->contain([
                'Students' => function ($q) {
                    return $q->select(['id','first_name','last_name','class_id']);
                },
                'Fees' => function ($q) use ($queryData) {
                    $q->select(['amount','compulsory','term_id','class_id','session_id']);
                    if (!empty($queryData['session_id'])) {
                        $q->where([
                            'Fees.session_id' => $queryData['session_id'],
                        ]);
                    }
                    if (!empty($queryData['class_id'])) {
                        $q->where([
                            'Fees.class_id' => $queryData['class_id'],
                        ]);
                    }
                    if (!empty($queryData['term_id'])) {
                        $q->where([
                            'Fees.term_id' => $queryData['term_id'],
                        ]);
                    }
                    return $q;
                }
            ])
            ->andWhere(['paid'=>0])
            ->orderAsc('Fees.class_id')
            ->groupBy('student_id');
        $defaulters = $query->toArray();
        $return = [];// initialise a return array
        if ( isset($queryData['percentage']) && !empty($queryData['percentage'])) {
            $compulsoryFeesTotal = $this->getCompulsoryFeesByParameters($queryData);
        }
        foreach ( $defaulters as $defaulterStudent_id => $defaulterDetails)
        {
            $collection = collection($defaulterDetails);
            $totalAmountOwing = $collection->sumOf(function ($data) {
                return ($data['amount_remaining']) ? $data['amount_remaining']  : $data['fee']['amount'];
            });
            // check if percentage is specified and include percentage
            if ( isset($queryData['percentage']) && !empty($queryData['percentage'])) {
                $studentOwingPercentage = round($totalAmountOwing / $compulsoryFeesTotal * 100 );
                if ( $studentOwingPercentage >= $queryData['percentage'] ) {
                    $return[] = [
                        'student_id' => $defaulterStudent_id,
                        'class_id' => $defaulterDetails[0]['student']['class_id'],
                        'total' => $totalAmountOwing
                    ];
                }
            } else {
                $return[] = [
                    'student_id' => $defaulterStudent_id,
                    'class_id' => $defaulterDetails[0]['student']['class_id'],
                    'total' => $totalAmountOwing
                ];
            }
        }
        return $return;
    }

    public function getStudentsData()
    {
        $students = $this->StudentFees->Students->find('all')
            ->where(['Students.status'=>1])
            ->map(function($row ) {
                $row->full_name = $row->first_name.' '.$row->last_name;
                return $row;
            })
            ->combine('id','full_name')
            ->toArray();
        return $students;
    }

    public function getFeeWithClassSessionTerm()
    {
        return $this->find('all')
            ->contain(['FeeCategories','Sessions','Classes','Terms'])
            ->map(function ($row) {
                $row->modifiedName = $row->fee_category->type.'--'.$row->session->session.'--'.$row->class->class.'--'.$row->term->term;
                return $row;
            })
            ->combine('id','modifiedName')
            ->toArray();
    }

    // Todo : Review this code algorithm
    public function createStudentsFeeRecord(Array $data )
    {
        $fee_id = $data['fee_id'];
        $students = $data['student_ids'];
        // create new student_fee entity
        $number_of_students_add = 0;
        foreach ( $students as $student_id ) {
            // check if student has the record
            $recordExists = (bool)$this->StudentFees->find()->where(['fee_id'=>$fee_id,'student_id'=>$student_id])->first();
            if ( $recordExists ) {
                continue;
            }
            $student_fee = $this->StudentFees->newEntity(['fee_id'=>$fee_id,'paid'=>0]);
            $student_fee->student_id = $student_id;
            if ($this->StudentFees->save($student_fee)) {
                $number_of_students_add++;
            }
        }
        // if the number is greater than 0
        if ( $number_of_students_add > 0 ){
            // update the fees details
            $fee = $this->get($data['fee_id']);
            $fee->number_of_students = $fee->number_of_students + $number_of_students_add ;
            $fee->income_amount_expected = (float)$fee->income_amount_expected + $fee->amount * $number_of_students_add;
            $this->save($fee);
        }
        return true;
    }


    public function getFeeDefaultersByFeeId($fee_id)
    {
        return $this->find()
            ->contain([
                'Terms',
                'Classes',
                'Sessions',
                'FeeCategories',
                'StudentFees.Students' => function($q) {
                    return $q->where(['StudentFees.paid'=>0]);
                }])
            ->where(['Fees.id'=>$fee_id])->first();
    }

    public function getFeeCompleteStudentsByFeeId($fee_id)
    {
        return $this->find()
            ->contain([
                'Terms',
                'Classes',
                'Sessions',
                'FeeCategories',
                'StudentFees' => function($q) {
                    return $q->where(['StudentFees.paid'=>1]);
                }])
            ->where(['Fees.id'=>$fee_id])->first();
    }


    public function getStudentWithCompleteFees(Array $queryData )
    {
        $query = $this->StudentFees->find('all')
            ->enableHydration(false)
            ->select(['student_id','fee_id','amount_remaining'])
            ->contain([
                'Students' => function ($q) {
                    return $q->select(['id','first_name','last_name','class_id']);
                },
                'Fees' => function ($q) use ($queryData) {
                    $q->select(['amount','compulsory','term_id','class_id','session_id']);
                    if (!empty($queryData['session_id'])) {
                        $q->where([
                            'Fees.session_id' => $queryData['session_id'],
                        ]);
                    }
                    if (!empty($queryData['class_id'])) {
                        $q->where([
                            'Fees.class_id' => $queryData['class_id'],
                        ]);
                    }
                    if (!empty($queryData['term_id'])) {
                        $q->where([
                            'Fees.term_id' => $queryData['term_id'],
                        ]);
                    }
                    return $q;
                }
            ])
            ->andWhere(['StudentFees.paid'=>1])
            ->orderAsc('Fees.class_id')
            ->groupBy('student_id');
        $completedFeesStudents = $query->toArray();
        $return = [];// initialise a return array
        $compulsoryFeesTotal = $this->getCompulsoryFeesByParameters($queryData);
        foreach ( $completedFeesStudents as $completedFeeStudent_id => $completedFeeDetails)
        {
            $collection = collection($completedFeeDetails);
            $totalAmountPaid = $collection->sumOf(function ($data) {
                return $data['fee']['amount'];
            });
            // check if percentage is specified and include percentage
            if ( $totalAmountPaid >= $compulsoryFeesTotal) {
                $return[] = [
                    'student_id' => $completedFeeStudent_id,
                    'class_id' => $completedFeeDetails[0]['student']['class_id'],
                    'total' => $totalAmountPaid
                ];
            }
        }
        return $return;
    }


    public function getCompulsoryFeesByParameters(Array $data)
    {
        $query = $this->find()
            ->enableHydration(false);
        if ( !empty($data['session_id'])){ // chain this query if session_id is set
            $query->andWhere(['session_id'=>$data['session_id']]);
        }
        if ( !empty($data['class_id'])){ // chain this query if class_id is set
            $query->andWhere(['class_id'=>$data['class_id']]);
        }
        if ( !empty($data['term_id'])){ // chain this query if term_id is set
            $query->andWhere(['term_id'=>$data['term_id']]);
        }
        $query->andWhere(['compulsory'=>1]);
        return $query->sumOf('amount');
    }

    /**
     * @param array $data
     * @return array
     * This function is used to query the fee table to get the
     * fee statistics
     */
    public function queryFeesTable(Array $data )
    {
        $query = $this->find()
            ->enableHydration(false)
            ->contain([
                'StudentFees' => function ($q) {
                    $q->select(['StudentFees.fee_id','StudentFees.paid']);
                    $q->where(['StudentFees.paid'=>0]);
                    return $q;
                },
            ]);
        if ( !empty($data['session_id'])){ // chain this query if session_id is set
            $query->andWhere(['Fees.session_id'=>$data['session_id']]);
        }
        if ( !empty($data['class_id'])){ // chain this query if class_id is set
            $query->andWhere(['Fees.class_id'=>$data['class_id']]);
        }
        if ( !empty($data['term_id'])){ // chain this query if session_id is set
            $query->andWhere(['Fees.term_id'=>$data['term_id']]);
        }
        $result = $query->groupBy('fee_category_id')->toArray();
        $return = [];
        foreach( $result as $fee_category_id => $fees ) {
            $feesCollection = collection($fees);
            $amount = $feesCollection->sumOf(function ($data) {
                return $data['amount'];
            });
            $expectedIncome = $feesCollection->sumOf(function ($data) {
                return $data['income_amount_expected'];
            });
            $amountReceived = $feesCollection->sumOf(function ($data) {
                return $data['amount_earned'];
            });
            $amountRemaining = $expectedIncome - $amountReceived;
            $number_of_students = $feesCollection->sumOf(function ($data) {
                return $data['number_of_students'];
            });
            $number_of_students_remaining = $feesCollection->sumOf(function ($data) {
                return count($data['student_fees']);
            });
            $return[$fee_category_id] = [
                'amount' => $amount,
                'expectedIncome' => $expectedIncome,
                'amountReceived' => $amountReceived,
                'amountRemaining' => $amountRemaining,
                'percentageReceived' => Number::precision($amountReceived/$expectedIncome * 100,2),
                'percentageRemaining' => Number::precision($amountRemaining/$expectedIncome * 100,2),
                'numberOfStudents' => $number_of_students,
                'numberOfStudentsPaid' => $number_of_students - $number_of_students_remaining,
                'numberOfStudentsRemaining' => $number_of_students_remaining
            ];
        }
        return $return;
    }

    /**
     * @return array
     * This function get the fee Categories in this order
     * [ 1 => 'School Fees']
     *
     */
    public function getFeeCategoriesData()
    {
        $feeCategories = $this->FeeCategories->find('all')
            ->combine('id','type')
            ->toArray();
        return $feeCategories;
    }

    public function deleteFee(EntityInterface $fee)
    {
        try {
            if ($this->getConnection()->getDriver() instanceof Sqlite) {
                // check if the fees exists in paid fees
                //throw error
                if ($this->StudentFeePayments->exists(['fee_id' => $fee->id])) {
                    throw new \PDOException;
                } else {
                    $this->StudentFees->deleteAll(['fee_id' => $fee->id]);
                }
            }
            $this->delete($fee);
            return true;
        } catch ( \PDOException $exception) {
            return false;
        }
    }

}
