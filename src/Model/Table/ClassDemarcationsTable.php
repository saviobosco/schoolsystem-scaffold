<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClassDemarcations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Classes
 *
 * @method \App\Model\Entity\ClassDemarcation get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClassDemarcation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ClassDemarcation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClassDemarcation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClassDemarcation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClassDemarcation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClassDemarcation findOrCreate($search, callable $callback = null)
 */
class ClassDemarcationsTable extends Table
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

        $this->table('class_demarcations');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Classes', [
            'foreignKey' => 'class_id',
            'joinType' => 'INNER'
        ]);

        $this->addBehavior('Timestamp');
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

        $validator
            ->integer('capacity','The capacity will only contain Integers .')
            ->requirePresence('capacity', 'create')
            ->notEmpty('capacity');

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

        return $rules;
    }
}
