<?php
namespace ResultSystem\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Database\Schema\TableSchema;

/**
 * StudentAnnualResults Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Students
 * @property \Cake\ORM\Association\BelongsTo $Subjects
 * @property \Cake\ORM\Association\BelongsTo $Classes
 * @property \Cake\ORM\Association\BelongsTo $Sessions
 *
 * @method \ResultSystem\Model\Entity\StudentAnnualResult get($primaryKey, $options = [])
 * @method \ResultSystem\Model\Entity\StudentAnnualResult newEntity($data = null, array $options = [])
 * @method \ResultSystem\Model\Entity\StudentAnnualResult[] newEntities(array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\StudentAnnualResult|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ResultSystem\Model\Entity\StudentAnnualResult patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\StudentAnnualResult[] patchEntities($entities, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\StudentAnnualResult findOrCreate($search, callable $callback = null)
 */
class StudentAnnualResultsTable extends Table
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

        $this->setTable('student_annual_results');
        $this->setDisplayField('id');
        $this->setPrimaryKey(['student_id','subject_id','class_id','session_id']);

        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER',
            'className' => 'App.Students'
        ]);
        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id',
            'joinType' => 'INNER',
            'className' => 'App.Subjects'
        ]);
        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id',
            'joinType' => 'INNER',
            'className' => 'App.Classes'
        ]);
        $this->belongsTo('Sessions', [
            'foreignKey' => 'session_id',
            'joinType' => 'INNER',
            'className' => 'App.Sessions'
        ]);
    }

    protected function _initializeSchema(TableSchema $schema)
    {
        // total is type float in database but converted to string here
        //So as to Group the students results based on their total
        // eg . 80.9 > 80.
        $schema->setColumnType('total', 'string');
        return $schema;
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
            ->allowEmpty('first_term');

        $validator
            ->allowEmpty('second_term');

        $validator
            ->allowEmpty('third_term');

        $validator
            ->allowEmpty('total');

        $validator
            ->allowEmpty('average');

        $validator
            ->allowEmpty('remark');

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
        /*$rules->add($rules->existsIn(['student_id'], 'Students'));
        $rules->add($rules->existsIn(['subject_id'], 'Subjects'));
        $rules->add($rules->existsIn(['class_id'], 'Classes'));
        $rules->add($rules->existsIn(['session_id'], 'Sessions'));*/

        return $rules;
    }
}
