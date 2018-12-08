<?php
namespace ResultSystem\Model\Table;

use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Database\Schema\TableSchema;

/**
 * StudentTermlyPositions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Students
 * @property \Cake\ORM\Association\BelongsTo $Classes
 * @property \Cake\ORM\Association\BelongsTo $Terms
 * @property \Cake\ORM\Association\BelongsTo $Sessions
 *
 * @method \ResultSystem\Model\Entity\StudentTermlyPosition get($primaryKey, $options = [])
 * @method \ResultSystem\Model\Entity\StudentTermlyPosition newEntity($data = null, array $options = [])
 * @method \ResultSystem\Model\Entity\StudentTermlyPosition[] newEntities(array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\StudentTermlyPosition|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ResultSystem\Model\Entity\StudentTermlyPosition patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\StudentTermlyPosition[] patchEntities($entities, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\StudentTermlyPosition findOrCreate($search, callable $callback = null)
 */
class StudentTermlyPositionsTable extends Table
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

        $this->setTable('student_termly_positions');
        $this->setDisplayField('id');
        $this->setPrimaryKey(['student_id','term_id','class_id','session_id']);

        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER',
            'className' => 'ResultSystem.Students'
        ]);
        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id',
            'joinType' => 'INNER',
            'className' => 'App.Classes'
        ]);
        $this->belongsTo('Terms', [
            'foreignKey' => 'term_id',
            'joinType' => 'INNER',
            'className' => 'ResultSystem.Terms'
        ]);
        $this->belongsTo('Sessions', [
            'foreignKey' => 'session_id',
            'joinType' => 'INNER',
            'className' => 'App.Sessions'
        ]);
    }

    /**
     * Override this function in order to alter the schema used by this table.
     * This function is only called after fetching the schema out of the database.
     * If you wish to provide your own schema to this table without touching the
     * database, you can override schema() or inject the definitions though that
     * method.
     * @param \Cake\Database\Schema\TableSchema $schema The table definition fetched from database.
     * @return \Cake\Database\Schema\TableSchema the altered schema
     */
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
            ->allowEmpty('total');

        $validator
            ->allowEmpty('average');

        $validator
            ->integer('position')
            ->allowEmpty('position');

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
        $rules->add($rules->existsIn(['class_id'], 'Classes'));
        $rules->add($rules->existsIn(['term_id'], 'Terms'));
        $rules->add($rules->existsIn(['session_id'], 'Sessions'));*/

        return $rules;
    }

    public function beforeSave(Event $event , Entity $entity )
    {
        if ($event->isStopped()) {
            return false;
        }
        if (empty($entity->total)) {
            $entity->total = null;
        }
    }
}
