<?php
namespace BankSystem\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EWallets Model
 *
 * @property \BankSystem\Model\Table\AccountHoldersTable|\Cake\ORM\Association\BelongsTo $AccountHolders
 *
 * @method \BankSystem\Model\Entity\EWallet get($primaryKey, $options = [])
 * @method \BankSystem\Model\Entity\EWallet newEntity($data = null, array $options = [])
 * @method \BankSystem\Model\Entity\EWallet[] newEntities(array $data, array $options = [])
 * @method \BankSystem\Model\Entity\EWallet|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \BankSystem\Model\Entity\EWallet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \BankSystem\Model\Entity\EWallet[] patchEntities($entities, array $data, array $options = [])
 * @method \BankSystem\Model\Entity\EWallet findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EWalletsTable extends Table
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

        $this->setTable('e_wallets');
        $this->setDisplayField('account_holder_id');
        $this->setPrimaryKey('account_holder_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('AccountHolders', [
            'foreignKey' => 'account_holder_id',
            'joinType' => 'INNER',
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
        $rules->add($rules->existsIn(['account_holder_id'], 'AccountHolders'));

        return $rules;
    }
}
