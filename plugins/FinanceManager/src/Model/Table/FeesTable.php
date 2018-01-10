<?php
namespace FinanceManager\Model\Table;

use Cake\Datasource\EntityInterface;
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
            'className' => 'FinanceManager.StudentFees'
        ]);

        $this->belongsTo('CreatedByUser',[
            'className' => 'Accounts',
            'foreignKey' => 'created_by'
        ]);

        $this->belongsTo('ModifiedByUser',[
            'className' => 'Accounts',
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
     * @return \App\Model\Entity\Fee|bool
     * This function creates the fee and returns the fee entity details
     */
    public function createFee(EntityInterface $fee)
    {
        return $this->save($fee);
    }

    public function checkIfFeeExistingForTermClassSession(EntityInterface $fee)
    {
        $query = $this->find('all')->where([
            'fee_category_id'=>$fee->fee_category_id,
            'class_id'=>$fee->class_id,
            'session_id' => $fee->session_id,
            ($fee->term_id ) ? 'term_id = '.$fee->term_id : 'term_id IS NULL' // checks if the $fee->term_id is set else return the else statement.
        ])->toArray();
        //debug($query); exit;
        if (!empty($query)) {
            return true ;
        }
        return false;
    }



    /**
     * @param $fee_id
     * @param $class_id
     * @return bool
     * This function is suspended for now
     * Todo : Come back and complete
     */
    public function createStudentsFeeRecordByClass($fee_id,$class_id)
    {
        $studentsTable = TableRegistry::get('Students');

        // find all student under that fees class and session
        $students = $studentsTable->find('all')
            ->select(['id','class_id','status'])
            ->where(['class_id'=>$class_id,'status' =>1])->enableHydration(false);

        // iterate through the result set and create their respective fees
        if ( $students ) {
            //Initialize the student fees table
            $studentFeesTable = TableRegistry::get('StudentFees');
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

    // Todo : Review this algorithm later
    public function createNewFee( EntityInterface $fee)
    {
        try {
            // check if the fee exists
            $query = $this->find('all')->where([
                'fee_category_id'=>$fee->fee_category_id,
                'class_id'=>$fee->class_id,
                'session_id' => $fee->session_id,
                ($fee->term_id ) ? 'term_id => '.$fee->term_id : 'term_id IS NULL' // checks if the $fee->term_id is set else return the else statement.
            ])->toArray();
            //debug($query); exit;
            if ( !empty($query)) {
                return ' Fees already exists ';
            }

            // save the fee
            $fee = $this->save($fee);
            if ($fee) {
                $this->createStudentsFeeRecordByClass($fee->id,$fee->class_id);
                return true;
            }
            return false;
        } catch ( \Exception $e ) {
            return $e->getTraceAsString();
        }

    }

    public function getFeeDefaulters(Array $data )
    {
        $query = $this->StudentFees->find('all')
            ->enableHydration(false)
            ->contain([
                'Fees',
                'Students' => function ($q) {
                    return $q->select(['id','first_name','last_name']);
                }]);
        if ( !empty($data['session_id']) ) {
            $query->contain(['Fees'=> function ($q) use ($data) {
                return $q->where([
                    'Fees.session_id' => $data['session_id'],
                ]);
            }]);
        }
        if ( !empty($data['class_id']) ) {
            $query->contain(['Fees'=> function ($q) use ($data) {
                return $q->where([
                    'Fees.class_id' => $data['class_id'],
                ]);
            }]);
        }
        if ( !empty($data['term_id']) ) {
            $query->contain(['Fees'=> function ($q) use ($data) {
                return $q->where([
                    'Fees.term_id' => $data['term_id'],
                ]);
            }]);
        }

        $data = $query->where(['paid'=>0])
            ->groupBy('student_id')
            ->toArray();

        return $data;

    }

    public function getStudentsData()
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
                    return $q->where(['paid'=>1]);
                }])
            ->where(['Fees.id'=>$fee_id])->first();
    }


    public function getStudentWithCompleteFees(Array $data )
    {
        $query = $this->StudentFees->find('all')
            ->enableHydration(false)
            ->contain([
                'Fees',
                'Students' => function ($q) {
                    return $q->select(['id','first_name','last_name']);
                }]);
        if ( !empty($data['session_id']) ) {
            $query->contain(['Fees'=> function ($q) use ($data) {
                return $q->where([
                    'Fees.session_id' => $data['session_id'],
                ]);
            }]);
        }
        if ( !empty($data['class_id']) ) {
            $query->contain(['Fees'=> function ($q) use ($data) {
                return $q->where([
                    'Fees.class_id' => $data['class_id'],
                ]);
            }]);
        }
        if ( !empty($data['term_id']) ) {
            $query->contain(['Fees'=> function ($q) use ($data) {
                return $q->where([
                    'Fees.term_id' => $data['term_id'],
                ]);
            }]);
        }

        $data = $query->where(['paid'=>1])
            ->groupBy('student_id')
            ->toArray();

        return $data;
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

        if ( !empty($data['term_id'])){ // chain this query if session_id is set
            $query->andWhere(['term_id'=>$data['term_id']]);
        }
        $query->andWhere(['compulsory'=>1]);
        return $query->toArray();
    }


    public function queryFeesTable(Array $data )
    {
        $query = $this->find()
            ->contain([
                'StudentFees' => function ($q) {
                    return $q->where(['StudentFees.paid'=>0]);
                },
            ])->enableHydration(false);

        if ( !empty($data['session_id'])){ // chain this query if session_id is set
            $query->andWhere(['Fees.session_id'=>$data['session_id']]);
        }

        if ( !empty($data['class_id'])){ // chain this query if class_id is set
            $query->andWhere(['Fees.class_id'=>$data['class_id']]);
        }

        if ( !empty($data['term_id'])){ // chain this query if session_id is set
            $query->andWhere(['Fees.term_id'=>$data['term_id']]);
        }

        return $query->groupBy('fee_category_id')->toArray();

    }

    public function getFeeCategoriesData()
    {
        $feeCategories = $this->FeeCategories->find('all')
            ->combine('id','type')
            ->toArray();
        return $feeCategories;
    }

    public function deleteFee(EntityInterface $fee)
    {
        // check if fee exist in student_fee_payments
        if ( (bool)$this->StudentFees->StudentFeePayments->find()->where(['fee_id'=>$fee->id])->first()) {
            // Throw PdoException
            throw new \PDOException;
        }
        $this->delete($fee);
        return true;
    }

}
