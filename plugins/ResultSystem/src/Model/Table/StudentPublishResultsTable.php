<?php
namespace ResultSystem\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StudentPublishResults Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Students
 * @property \Cake\ORM\Association\BelongsTo $Classes
 * @property \Cake\ORM\Association\BelongsTo $Terms
 * @property \Cake\ORM\Association\BelongsTo $Sessions
 *
 * @method \ResultSystem\Model\Entity\StudentPublishResult get($primaryKey, $options = [])
 * @method \ResultSystem\Model\Entity\StudentPublishResult newEntity($data = null, array $options = [])
 * @method \ResultSystem\Model\Entity\StudentPublishResult[] newEntities(array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\StudentPublishResult|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ResultSystem\Model\Entity\StudentPublishResult patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\StudentPublishResult[] patchEntities($entities, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\StudentPublishResult findOrCreate($search, callable $callback = null)
 */
class StudentPublishResultsTable extends Table
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

        $this->setTable('student_publish_results');
        $this->setDisplayField('id');
        $this->setPrimaryKey(['student_id','session_id','class_id','term_id']);

        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER',
            'className' => 'ResultSystem.Students'
        ]);
        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id',
            'joinType' => 'INNER',
            'className' => 'ResultSystem.Classes'
        ]);
        $this->belongsTo('Terms', [
            'foreignKey' => 'term_id',
            'joinType' => 'INNER',
            'className' => 'ResultSystem.Terms'
        ]);
        $this->belongsTo('Sessions', [
            'foreignKey' => 'session_id',
            'joinType' => 'INNER',
            'className' => 'ResultSystem.Sessions'
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
        $rules->add($rules->existsIn(['class_id'], 'Classes'));
        $rules->add($rules->existsIn(['term_id'], 'Terms'));
        $rules->add($rules->existsIn(['session_id'], 'Sessions'));

        return $rules;
    }

    public function getStudentResultPublishStatus($student_id,$session,$class,$term)
    {
        return $this->find('all')
            ->where([
                'student_id' => $student_id ,
                'session_id' => $session,
                'class_id' => $class,
                'term_id' => $term
            ])->enableHydration(false)->first();
    }

    /**
     * @param $postData
     * @param $queryData
     * @return int|null
     * This function is used to publish mass results with one action
     */
    public function publishResults($postData,$queryData)
    {
        $resultPublishes = $this->find('all')->where([
            'term_id' => $queryData['term_id'],
            'class_id' => $queryData['class_id'],
            'session_id' => $queryData['session_id'],
        ])->toArray();
        $resultPublishes = $this->patchEntities($resultPublishes,$postData);
        if ( $this->saveMany($resultPublishes)) {
            return true;
        }
        return false;
    }
}
