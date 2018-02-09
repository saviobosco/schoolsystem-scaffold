<?php
namespace TimesTable\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TermTimeTables Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Terms
 * @property \Cake\ORM\Association\BelongsTo $Sessions
 *
 * @method \TimesTable\Model\Entity\TermTimeTable get($primaryKey, $options = [])
 * @method \TimesTable\Model\Entity\TermTimeTable newEntity($data = null, array $options = [])
 * @method \TimesTable\Model\Entity\TermTimeTable[] newEntities(array $data, array $options = [])
 * @method \TimesTable\Model\Entity\TermTimeTable|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \TimesTable\Model\Entity\TermTimeTable patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \TimesTable\Model\Entity\TermTimeTable[] patchEntities($entities, array $data, array $options = [])
 * @method \TimesTable\Model\Entity\TermTimeTable findOrCreate($search, callable $callback = null)
 */
class TermTimeTablesTable extends Table
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

        $this->table('term_time_tables');
        $this->displayField('id');
        $this->primaryKey('id');

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
            ->date('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmpty('start_date');

        $validator
            ->date('end_date')
            ->requirePresence('end_date', 'create')
            ->notEmpty('end_date');

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
        $rules->add($rules->existsIn(['term_id'], 'Terms'));
        $rules->add($rules->existsIn(['session_id'], 'Sessions'));

        return $rules;
    }
}
