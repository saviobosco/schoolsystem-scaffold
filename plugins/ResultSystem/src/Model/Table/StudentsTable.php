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
 * @property \Cake\ORM\Association\BelongsTo $ClassDemarcations
 * @property \Cake\ORM\Association\HasMany $StudentAnnualPositionOnClassDemarcations
 * @property \Cake\ORM\Association\HasMany $StudentAnnualPositions
 * @property \Cake\ORM\Association\HasMany $StudentAnnualResults
 * @property \Cake\ORM\Association\HasMany $StudentAnnualSubjectPositionOnClassDemarcations
 * @property \Cake\ORM\Association\HasMany $StudentAnnualSubjectPositions
 * @property \Cake\ORM\Association\HasMany $StudentTermlyPositionOnClassDemarcations
 * @property \Cake\ORM\Association\HasMany $StudentTermlyPositions
 * @property \Cake\ORM\Association\HasMany $StudentTermlyResults
 * @property \Cake\ORM\Association\HasMany $StudentTermlySubjectPositionOnClassDemarcations
 * @property \Cake\ORM\Association\HasMany $StudentTermlySubjectPositions
 * @property \Cake\ORM\Association\HasMany $StudentResultPins
 * @property \Cake\ORM\Association\HasMany $StudentGeneralRemarks
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
        $this->belongsTo('ClassDemarcations', [
            'foreignKey' => 'class_demarcation_id',
            'joinType' => 'INNER',
            'className' => 'App.ClassDemarcations'
        ]);
        $this->hasMany('StudentAnnualPositionOnClassDemarcations', [
            'foreignKey' => 'student_id',
            'className' => 'ResultSystem.StudentAnnualPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentAnnualPositions', [
            'foreignKey' => 'student_id',
            'className' => 'ResultSystem.StudentAnnualPositions'
        ]);
        $this->hasMany('StudentAnnualResults', [
            'foreignKey' => 'student_id',
            'className' => 'ResultSystem.StudentAnnualResults'
        ]);
        $this->hasMany('StudentAnnualSubjectPositionOnClassDemarcations', [
            'foreignKey' => 'student_id',
            'className' => 'ResultSystem.StudentAnnualSubjectPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentAnnualSubjectPositions', [
            'foreignKey' => 'student_id',
            'className' => 'ResultSystem.StudentAnnualSubjectPositions'
        ]);
        $this->hasMany('StudentTermlyPositionOnClassDemarcations', [
            'foreignKey' => 'student_id',
            'className' => 'ResultSystem.StudentTermlyPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentTermlyPositions', [
            'foreignKey' => 'student_id',
            'className' => 'ResultSystem.StudentTermlyPositions'
        ]);
        $this->hasMany('StudentTermlyResults', [
            'foreignKey' => 'student_id',
            'className' => 'ResultSystem.StudentTermlyResults'
        ]);
        $this->hasMany('StudentTermlySubjectPositionOnClassDemarcations', [
            'foreignKey' => 'student_id',
            'className' => 'ResultSystem.StudentTermlySubjectPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentTermlySubjectPositions', [
            'foreignKey' => 'student_id',
            'className' => 'ResultSystem.StudentTermlySubjectPositions'
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
        $rules->add($rules->existsIn(['class_demarcation_id'], 'ClassDemarcations'));

        return $rules;
    }

    public function getStudentAnnualSubjectPositions($student_id,$session,$class)
    {
        return $this->StudentAnnualSubjectPositions->find()
            ->where(['student_id' => $student_id,
                'session_id' => @$session,
                'class_id' => @$class,
            ])->combine('subject_id','position')->toArray();
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

    public function getStudentTermlyPosition($student_id,$session,$class,$term)
    {
        return $this->StudentTermlyPositions->find('all')
            ->where(['student_id' => $student_id,
                'session_id' => @$session,
                'class_id' => @$class,
                'term_id'    => @$term
            ])->enableHydration(false)->first();
    }

    public function getStudentTermlySubjectPositions($student_id,$session,$class,$term)
    {
        return $this->StudentTermlySubjectPositions->find('all')
            ->where(['student_id' => $student_id,
                'session_id' => @$session,
                'class_id' => @$class,
                'term_id'    => @$term
            ])->combine('subject_id','position')->toArray();
    }

    public function getStudentsWithIdAndNameByClassId($class_id)
    {
        return $this->find('all')->select(['id','first_name','last_name'])->where(['class_id'=>$class_id,'status'=>1])->enableHydration(false)->toArray();
    }

    public function getStudentAnnualResult($id,$queryData)
    {
        return $this->get($id, [
            'contain' => [
                'Classes',
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
                'StudentAnnualPositions' =>  [
                    'conditions' => [
                        'StudentAnnualPositions.session_id' => ($queryData['session_id']) ? $queryData['session_id'] : 1,
                        'StudentAnnualPositions.class_id' => ($queryData['class_id']) ? $queryData['class_id'] : 1
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
            'contain' => [
                'Classes',
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
                'StudentTermlyPositions' =>  [
                    'conditions' => [
                        'StudentTermlyPositions.session_id' => ($queryData['session_id']) ? $queryData['session_id'] : 1,
                        'StudentTermlyPositions.class_id' => ($queryData['class_id']) ? $queryData['class_id'] : 1,
                        'StudentTermlyPositions.term_id' => ($queryData['term_id']) ? $queryData['term_id'] : 1
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
            ->where([
                'StudentTermlyResults.student_id' => $id,
                'StudentTermlyResults.session_id' => @$queryData['session_id'],
                'StudentTermlyResults.class_id' => @$queryData['class_id'],
                'StudentTermlyResults.term_id' => @$queryData['term_id']
            ])
            ->toArray();
    }

    public function getStudentAnnualResultOnly($id, $queryData)
    {
        return $this->StudentAnnualResults
            ->find()
            ->enableHydration(false)
            ->where([
                'StudentAnnualResults.student_id' => $id,
                'StudentAnnualResults.session_id' => @$queryData['session_id'],
                'StudentAnnualResults.class_id' => @$queryData['class_id'],
            ])
            ->toArray();
    }

    public function getStudentAnnualPosition($id,$queryData)
    {
        return $this->StudentAnnualPositions->find('all')
            ->where(['student_id' => $id,
                'session_id' => @$queryData['session_id'],
                'class_id' => @$queryData['class_id'],
            ])->enableHydration(false)->first();
    }

    public function getStudentAnnualPromotions($queryData)
    {
        return $this->find('all')
            ->select(['Students.id','Students.first_name','Students.last_name'])
            ->contain([
                'StudentAnnualPositions' => function($q) use ($queryData) {
                    return $q->where(['StudentAnnualPositions.session_id'=>$queryData['session_id'],'StudentAnnualPositions.class_id'=>$queryData['class_id']]);
                }
            ])
            ->where(['Students.status'=>1,'Students.class_id'=>$queryData['class_id']])
            ->enableHydration(false)->toArray();
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
        return $this->StudentTermlyPositions->deleteAll([
            'student_id' => $id,
            'session_id' => $queryData['session_id'],
            'class_id' => $queryData['class_id'],
            'term_id' => $queryData['term_id'],
        ]);
    }

    public function deleteTermlySubjectPositions($id, $queryData)
    {
        return $this->StudentTermlySubjectPositions->deleteAll([
            'student_id' => $id,
            'session_id' => $queryData['session_id'],
            'class_id' => $queryData['class_id'],
            'term_id' => $queryData['term_id'],
        ]);
    }
}
