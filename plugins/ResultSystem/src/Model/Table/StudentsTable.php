<?php
namespace ResultSystem\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Students Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Sessions
 * @property \Cake\ORM\Association\BelongsTo $Classes
 * @property \Cake\ORM\Association\HasMany $StudentAnnualResults
 * @property \Cake\ORM\Association\HasMany $StudentPositions
 * @property \Cake\ORM\Association\HasMany $StudentTermlyResults
 * @property \Cake\ORM\Association\HasMany $StudentSubjectPositions
 * @property \Cake\ORM\Association\HasMany $StudentResultPins
 * @property \Cake\ORM\Association\HasMany $StudentGeneralRemarks
 * @property \Cake\ORM\Association\HasMany $StudentPublishResults
 *
 * @method \ResultSystem\Model\Entity\Student get($primaryKey, $options = [])
 * @method \ResultSystem\Model\Entity\Student newEntity($data = null, array $options = [])
 * @method \ResultSystem\Model\Entity\Student[] newEntities(array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\Student|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ResultSystem\Model\Entity\Student patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\Student[] patchEntities($entities, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\Student findOrCreate($search, callable $callback = null)
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

        $this->table('students');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Sessions', [
            'foreignKey' => 'session_id',
            'joinType' => 'INNER',
            'className' => 'App.Sessions'
        ]);
        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id',
            'joinType' => 'INNER',
            'className' => 'ResultSystem.Classes'
        ]);
        $this->hasMany('StudentAnnualResults', [
            'foreignKey' => 'student_id',
            'className' => 'ResultSystem.StudentAnnualResults'
        ]);
        $this->hasMany('StudentPositions', [
            'foreignKey' => 'student_id',
            'className' => 'ResultSystem.StudentPositions'
        ]);
        $this->hasMany('StudentTermlyResults', [
            'foreignKey' => 'student_id',
            'className' => 'ResultSystem.StudentTermlyResults'
        ]);
        $this->hasMany('StudentSubjectPositions', [
            'foreignKey' => 'student_id',
            'className' => 'ResultSystem.StudentSubjectPositions'
        ]);

        $this->hasMany('StudentResultPins',[
            'className' => 'ResultSystem.StudentResultPins',
            'foreignKey' => 'student_id'
        ]);

        $this->hasMany('StudentGeneralRemarks',[
            'className' => 'ResultSystem.StudentGeneralRemarks',
            'foreignKey' => 'student_id',
            'joinType'  => 'INNER'
        ]);

        $this->hasMany('StudentPublishResults',[
            'className' => 'ResultSystem.StudentPublishResults',
            'foreignKey' => 'student_id',
            'joinType'  => 'LEFT JOIN'
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
        $rules->add($rules->existsIn(['session_id'], 'Sessions'));
        $rules->add($rules->existsIn(['class_id'], 'Classes'));

        return $rules;
    }

    public function getStudentSubjectPositions($student_id,$session_id, $class_id, $term_id)
    {
        return $this->StudentSubjectPositions->find()
            ->where([
                'student_id' => $student_id,
                'session_id' => $session_id,
                'class_id' => $class_id,
                'term_id' => $term_id,
            ])->combine('subject_id','position')
            ->toArray();
    }

    public function getStudentGeneralRemark($student_id,$session,$class,$term)
    {
        return $this->StudentGeneralRemarks->find('all')
            ->where([
                'student_id' => $student_id,
                'session_id' => $session,
                'class_id'    =>$class,
                'term_id'    => $term,
            ])->enableHydration(false)->first();
    }

    public function getStudentPosition($student_id,$session_id, $class_id, $term_id)
    {
        return $this->StudentPositions->find('all')
            ->where(['student_id' => $student_id,
                'session_id' => $session_id,
                'class_id' => $class_id,
                'term_id'    => $term_id
            ])->enableHydration(false)
            ->first();
    }

    public function getStudentsWithIdAndNameByClassId($class_id)
    {
        return $this->find('all')->select(['id','first_name','last_name'])->where(['class_id'=>$class_id,'status'=>1])->enableHydration(false)->toArray();
    }

    public function getStudentAnnualResult($id,$queryData)
    {
        return $this->get($id, [
            'fields' => ['id','first_name', 'last_name', 'class_id'],
            'contain' => [
                'Classes' => ['fields' => ['id', 'class']],
                'StudentAnnualResults' => ['conditions' => [
                    'StudentAnnualResults.session_id' => ($queryData['session_id']) ? $queryData['session_id'] : 1,
                    'StudentAnnualResults.class_id' => ($queryData['class_id']) ? $queryData['class_id'] : 1 ,
                ]
                ],
                'StudentGeneralRemarks' => [
                    'conditions' => [
                        'StudentGeneralRemarks.session_id' => ($queryData['session_id']) ? $queryData['session_id'] : 1,
                        'StudentGeneralRemarks.class_id' => ($queryData['class_id']) ? $queryData['class_id'] : 1,
                        'StudentGeneralRemarks.term_id' => ($queryData['term_id']) ? $queryData['term_id'] : 1
                    ]
                ],
                'StudentPositions' =>  [
                    'conditions' => [
                        'StudentPositions.session_id' => $queryData['session_id'],
                        'StudentPositions.class_id' => $queryData['class_id'],
                        'StudentPositions.term_id' => $queryData['term_id']
                    ]
                ],
                'StudentPublishResults' => [
                    'conditions' => [
                        'StudentPublishResults.term_id' => ($queryData['term_id']) ? $queryData['term_id'] : 1,
                        'StudentPublishResults.class_id' => ($queryData['class_id']) ? $queryData['class_id'] : 1,
                        'StudentPublishResults.session_id' => ($queryData['session_id']) ? $queryData['session_id'] : 1
                    ]
                ]
            ]
        ]);
    }

    public function getStudentTermlyResult($id,$queryData)
    {
        return $this->get($id, [
            'fields' => ['id','first_name', 'last_name', 'class_id'],
            'contain' => [
                'StudentTermlyResults' => [
                    'conditions' => [
                        'StudentTermlyResults.session_id' => ($queryData['session_id']) ? $queryData['session_id'] : 1,
                        'StudentTermlyResults.class_id' => ($queryData['class_id']) ? $queryData['class_id'] : 1,
                        'StudentTermlyResults.term_id' => ($queryData['term_id']) ? $queryData['term_id'] : 1
                    ]
                ],
                'StudentGeneralRemarks' => [
                    'conditions' => [
                        'StudentGeneralRemarks.session_id' => ($queryData['session_id']) ? $queryData['session_id'] : 1,
                        'StudentGeneralRemarks.class_id' => ($queryData['class_id']) ? $queryData['class_id'] : 1,
                        'StudentGeneralRemarks.term_id' => ($queryData['term_id']) ? $queryData['term_id'] : 1,
                    ]
                ],
                'StudentPositions' =>  [
                    'conditions' => [
                        'StudentPositions.session_id' => $queryData['session_id'],
                        'StudentPositions.class_id' => $queryData['class_id'],
                        'StudentPositions.term_id' => $queryData['term_id']
                    ]
                ],
                'StudentPublishResults' => [
                    'conditions' => [
                        'StudentPublishResults.term_id' => ($queryData['term_id']) ? $queryData['term_id'] : 1,
                        'StudentPublishResults.class_id' => ($queryData['class_id']) ? $queryData['class_id'] : 1,
                        'StudentPublishResults.session_id' => ($queryData['session_id']) ? $queryData['session_id'] : 1,
                    ]
                ]
            ]
        ]);
    }

    public function getStudentTermlyResultOnly($id,$queryData)
    {
        return $this->StudentTermlyResults
            ->find()
            ->enableHydration(false)
            ->contain(['Subjects' => ['fields' => ['id', 'name']]])
            ->where([
                'StudentTermlyResults.student_id' => $id,
                'StudentTermlyResults.session_id' => @$queryData['session_id'],
                'StudentTermlyResults.class_id' => @$queryData['class_id'],
                'StudentTermlyResults.term_id' => @$queryData['term_id']
            ]);
    }

    public function getStudentAnnualResultOnly($id, $queryData)
    {
        return $this->StudentAnnualResults
            ->find()
            ->enableHydration(false)
            ->contain(['Subjects' => ['fields' => ['id', 'name']]])
            ->where([
                'StudentAnnualResults.student_id' => $id,
                'StudentAnnualResults.session_id' => @$queryData['session_id'],
                'StudentAnnualResults.class_id' => @$queryData['class_id'],
            ]);
    }

    public function getStudentAnnualPromotions($queryData)
    {
        return $this->find('all')
            ->select(['Students.id','Students.first_name','Students.last_name'])
            ->contain([
                'StudentPositions' => function($q) use ($queryData) {
                    return $q->where([
                        'StudentPositions.session_id'=>$queryData['session_id'],
                        'StudentPositions.class_id'=>$queryData['class_id'],
                        'StudentPositions.term_id'=>$queryData['term_id']
                    ]);
                }
            ])
            ->where([
                'Students.status'=>1,
                'Students.class_id'=>$queryData['class_id']
            ])
            ->enableHydration(false)
            ->toArray();
    }

    public function deleteTermlyResults($id, $queryData)
    {
        return $this->StudentTermlyResults->deleteAll([
            'student_id' => $id,
            'session_id' => $queryData['session_id'],
            'class_id' => $queryData['class_id'],
            'term_id' => $queryData['term_id'],
        ]);
    }

    public function deleteTermlyPosition($id, $queryData)
    {
        return $this->StudentPositions->deleteAll([
            'student_id' => $id,
            'session_id' => $queryData['session_id'],
            'class_id' => $queryData['class_id'],
            'term_id' => $queryData['term_id'],
        ]);
    }

    public function deleteTermlySubjectPositions($id, $queryData)
    {
        return $this->StudentSubjectPositions->deleteAll([
            'student_id' => $id,
            'session_id' => $queryData['session_id'],
            'class_id' => $queryData['class_id'],
            'term_id' => $queryData['term_id'],
        ]);
    }
}
