<?php
namespace ResultSystem\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Subjects Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Blocks
 * @property \Cake\ORM\Association\HasMany $StudentAnnualResults
 * @property \Cake\ORM\Association\HasMany $StudentAnnualSubjectPositionOnClassDemacations
 * @property \Cake\ORM\Association\HasMany $StudentAnnualSubjectPositions
 * @property \Cake\ORM\Association\HasMany $StudentTermlyResults
 * @property \Cake\ORM\Association\HasMany $StudentTermlySubjectPositionOnClassDemacations
 * @property \Cake\ORM\Association\HasMany $StudentTermlySubjectPositions
 * @property \Cake\ORM\Association\HasMany $SubjectClassAverages
 *
 * @method \ResultSystem\Model\Entity\Subject get($primaryKey, $options = [])
 * @method \ResultSystem\Model\Entity\Subject newEntity($data = null, array $options = [])
 * @method \ResultSystem\Model\Entity\Subject[] newEntities(array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\Subject|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ResultSystem\Model\Entity\Subject patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\Subject[] patchEntities($entities, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\Subject findOrCreate($search, callable $callback = null)
 */
class SubjectsTable extends Table
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

        $this->setTable('subjects');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Blocks', [
            'foreignKey' => 'block_id',
            'joinType' => 'INNER',
            'className' => 'App.Blocks'
        ]);
        $this->hasMany('StudentAnnualResults', [
            'foreignKey' => 'subject_id',
            'className' => 'ResultSystem.StudentAnnualResults'
        ]);
        $this->hasMany('StudentAnnualSubjectPositionOnClassDemarcations', [
            'foreignKey' => 'subject_id',
            'className' => 'ResultSystem.StudentAnnualSubjectPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentAnnualSubjectPositions', [
            'foreignKey' => 'subject_id',
            'className' => 'ResultSystem.StudentAnnualSubjectPositions'
        ]);
        $this->hasMany('StudentTermlyResults', [
            'foreignKey' => 'subject_id',
            'className' => 'ResultSystem.StudentTermlyResults'
        ]);
        $this->hasMany('StudentTermlySubjectPositionOnClassDemarcations', [
            'foreignKey' => 'subject_id',
            'className' => 'ResultSystem.StudentTermlySubjectPositionOnClassDemarcations'
        ]);
        $this->hasMany('StudentTermlySubjectPositions', [
            'foreignKey' => 'subject_id',
            'className' => 'ResultSystem.StudentTermlySubjectPositions'
        ]);
        $this->hasMany('SubjectClassAverages', [
            'foreignKey' => 'subject_id',
            'className' => 'ResultSystem.SubjectClassAverages'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

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
        $rules->add($rules->existsIn(['block_id'], 'Blocks'));

        return $rules;
    }

    public function getSubjectClassAverages($session,$class,$term)
    {
        return $this->SubjectClassAverages->find('all')
            ->where([
                'session_id' => @$session,
                'class_id'    => @$class,
                'term_id'    => @$term
            ])->combine('subject_id','class_average')->toArray();
    }

    public function getAnnualResults($id,$queryData)
    {
        return $this->StudentAnnualResults
            ->find('all')
            ->where(['subject_id' => $id,
                'StudentAnnualResults.session_id' => $queryData['session_id'],
                'StudentAnnualResults.class_id'   => $queryData['class_id'],
            ])
            ->contain([
                'Students' => function ($q){
                    return $q->select(['Students.id','Students.first_name','Students.last_name']);
                }
            ])
            ->enableHydration(false)
            ->toArray();
    }

    public function getAnnualSubjectPositions($id,$queryData)
    {
        return $this->StudentAnnualSubjectPositions->find('all')
            ->where(['subject_id' => $id,
                'session_id' => $queryData['session_id'],
                'class_id'   => $queryData['class_id'],
            ])->combine('student_id','position')->toArray();
    }

    public function getTermlyResults($id,$queryData)
    {
        return $this->StudentTermlyResults->find('all')
            ->where([
                'StudentTermlyResults.subject_id' => $id,
                'StudentTermlyResults.session_id' => $queryData['session_id'],
                'StudentTermlyResults.class_id'   => $queryData['class_id'],
                'StudentTermlyResults.term_id'   => $queryData['term_id'],
            ])
            ->contain([
                'Students' => function ($q){
                    return $q->select(['Students.id','Students.first_name','Students.last_name']);
                }
            ])
            ->enableHydration(false)
            ->toArray();
    }

    public function getTermlySubjectPositions($id,$queryData)
    {
        return $this->StudentTermlySubjectPositions->find('all')
            ->where(['subject_id' => $id,
                'session_id' => $queryData['session_id'],
                'class_id'   => $queryData['class_id'],
                'term_id'   => $queryData['term_id'],
            ])->combine('student_id','position')->toArray();
    }

    public function getTermlyResultWithHydration($id,$queryData)
    {
        return $this->get($id, [
            'contain' => [
                'StudentTermlyResults' => [
                    'conditions' => [
                    'StudentTermlyResults.session_id' => $queryData['session_id'],
                    'StudentTermlyResults.class_id' => $queryData['class_id'],
                    'StudentTermlyResults.term_id' => $queryData['term_id'],
                    ],
                    'Students' => [
                        'fields' => ['id','first_name','last_name']
                    ]
                ]
            ]
        ]);
    }

    public function getAnnualResultWithHydration($id,$queryData)
    {
        return $this->get($id, [
            'contain' => [
                'StudentAnnualResults' => ['conditions' => [
                    'StudentAnnualResults.session_id' => $queryData['session_id'],
                    'StudentAnnualResults.class_id' => $queryData['class_id']
                ]
                ]
            ]
        ]);
    }
}
