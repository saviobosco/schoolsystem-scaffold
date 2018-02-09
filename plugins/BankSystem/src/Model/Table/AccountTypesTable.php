<?php
namespace BankSystem\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AccountTypes Model
 *
 * @property \BankSystem\Model\Table\AccountHoldersTable|\Cake\ORM\Association\HasMany $AccountHolders
 *
 * @method \BankSystem\Model\Entity\AccountType get($primaryKey, $options = [])
 * @method \BankSystem\Model\Entity\AccountType newEntity($data = null, array $options = [])
 * @method \BankSystem\Model\Entity\AccountType[] newEntities(array $data, array $options = [])
 * @method \BankSystem\Model\Entity\AccountType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \BankSystem\Model\Entity\AccountType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \BankSystem\Model\Entity\AccountType[] patchEntities($entities, array $data, array $options = [])
 * @method \BankSystem\Model\Entity\AccountType findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AccountTypesTable extends Table
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

        $this->setTable('account_types');
        $this->setDisplayField('type');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('AccountHolders', [
            'foreignKey' => 'account_type_id',
            'className' => 'BankSystem.AccountHolders'
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
            ->scalar('type')
            ->allowEmpty('type');

        return $validator;
    }
}
