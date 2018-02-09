<?php
namespace FinanceManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Terms Model
 *
 * @property \FinanceManager\Model\Table\FeesTable|\Cake\ORM\Association\HasMany $Fees
 *
 * @method \FinanceManager\Model\Entity\Term get($primaryKey, $options = [])
 * @method \FinanceManager\Model\Entity\Term newEntity($data = null, array $options = [])
 * @method \FinanceManager\Model\Entity\Term[] newEntities(array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Term|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \FinanceManager\Model\Entity\Term patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Term[] patchEntities($entities, array $data, array $options = [])
 * @method \FinanceManager\Model\Entity\Term findOrCreate($search, callable $callback = null, $options = [])
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

        $this->setTable('terms');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Fees', [
            'foreignKey' => 'term_id',
            'className' => 'FinanceManager.Fees'
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
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
