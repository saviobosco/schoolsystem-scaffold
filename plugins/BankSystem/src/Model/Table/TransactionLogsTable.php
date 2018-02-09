<?php
namespace BankSystem\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TransactionLogs Model
 *
 * @property \BankSystem\Model\Table\CreditTransactionsTable|\Cake\ORM\Association\BelongsTo $CreditTransactions
 * @property \BankSystem\Model\Table\DebitTransactionsTable|\Cake\ORM\Association\BelongsTo $DebitTransactions
 * @property \BankSystem\Model\Table\AccountHoldersTable|\Cake\ORM\Association\BelongsTo $AccountHolders
 *
 * @method \BankSystem\Model\Entity\TransactionLog get($primaryKey, $options = [])
 * @method \BankSystem\Model\Entity\TransactionLog newEntity($data = null, array $options = [])
 * @method \BankSystem\Model\Entity\TransactionLog[] newEntities(array $data, array $options = [])
 * @method \BankSystem\Model\Entity\TransactionLog|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \BankSystem\Model\Entity\TransactionLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \BankSystem\Model\Entity\TransactionLog[] patchEntities($entities, array $data, array $options = [])
 * @method \BankSystem\Model\Entity\TransactionLog findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TransactionLogsTable extends Table
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

        $this->setTable('transaction_logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('Muffin/Footprint.Footprint', [
            'events' => [
                'Model.beforeSave' => [
                    'created_by' => 'new',
                    'modified_by' => 'always'
                ]
            ],
        ]);

        $this->belongsTo('CreditTransactions', [
            'foreignKey' => 'credit_transaction_id',
            'className' => 'BankSystem.CreditTransactions'
        ]);
        $this->belongsTo('DebitTransactions', [
            'foreignKey' => 'debit_transaction_id',
            'className' => 'BankSystem.DebitTransactions'
        ]);

        $this->belongsTo('AccountHolders', [
            'foreignKey' => 'account_holder_id',
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
            ->scalar('description')
            ->allowEmpty('description');

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
        $rules->add($rules->existsIn(['credit_transaction_id'], 'CreditTransactions'));
        $rules->add($rules->existsIn(['debit_transaction_id'], 'DebitTransactions'));
        $rules->add($rules->existsIn(['account_holder_id'], 'AccountHolders'));

        return $rules;
    }
}
