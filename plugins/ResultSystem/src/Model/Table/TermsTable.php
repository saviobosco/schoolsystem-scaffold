<?php
namespace ResultSystem\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Terms Model
 *
 * @property \Cake\ORM\Association\HasMany $StudentTermlyResults
 *
 * @method \ResultSystem\Model\Entity\Term get($primaryKey, $options = [])
 * @method \ResultSystem\Model\Entity\Term newEntity($data = null, array $options = [])
 * @method \ResultSystem\Model\Entity\Term[] newEntities(array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\Term|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \ResultSystem\Model\Entity\Term patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\Term[] patchEntities($entities, array $data, array $options = [])
 * @method \ResultSystem\Model\Entity\Term findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TermsTable extends Table
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

        $this->table('terms');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('StudentTermlyResults', [
            'foreignKey' => 'term_id',
            'className' => 'ResultSystem.StudentTermlyResults'
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
}
