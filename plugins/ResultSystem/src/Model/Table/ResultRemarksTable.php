<?php
namespace ResultSystem\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ResultRemarks Model
 *
 * @property \ClassManager\Model\Table\ClassesTable|\Cake\ORM\Association\BelongsTo $Classes
 * @property \App\Model\Table\SessionsTable|\Cake\ORM\Association\BelongsTo $Sessions
 *
 * @method \ResultSystem\Model\Entity\ResultRemark get($primaryKey, $options = [])
 * @method \ResultSystem\Model\Entity\ResultRemark newEntity($data = null, array $options = [])
 * @method \ResultSystem\Model\Entity\ResultRemark[] newEntities(array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\ResultRemark|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ResultSystem\Model\Entity\ResultRemark patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\ResultRemark[] patchEntities($entities, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\ResultRemark findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ResultRemarksTable extends Table
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

        $this->setTable('result_remarks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ResultRemarkInputs', [
            'className' => 'ResultSystem.ResultRemarkInputs',
            'foreignKey' => 'result_remark_input_main_value',
            'bindingKey' => 'main_value'
        ]);

        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id',
            'joinType' => 'INNER',
            'className' => 'ClassManager.Classes'
        ]);
        $this->belongsTo('Sessions', [
            'foreignKey' => 'session_id',
            'joinType' => 'INNER',
            'className' => 'App.Sessions'
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
            ->requirePresence('result_remark_input_main_value', 'create')
            ->notEmpty('result_remark_input_main_value');

        $validator
            ->scalar('full_name')
            ->allowEmpty('full_name');

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
        $rules->add($rules->existsIn(['session_id'], 'Sessions'));

        return $rules;
    }

    public function getResultRemarkFullNameWithPassedDetails($session,$class)
    {
        return $this->find('all')
            ->where([
                'session_id' => $session,
                'class_id' => $class,
            ])->combine('result_remark_input_main_value','full_name')->toArray();
    }
}
