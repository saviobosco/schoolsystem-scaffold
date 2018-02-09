<?php
namespace BankSystem\Model\Table;

use Cake\I18n\Date;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DebitTransactions Model
 *
 * @property \BankSystem\Model\Table\AccountHoldersTable|\Cake\ORM\Association\BelongsTo $AccountHolders
 * @property \BankSystem\Model\Table\TransactionLogsTable|\Cake\ORM\Association\HasMany $TransactionLogs
 *
 * @method \BankSystem\Model\Entity\DebitTransaction get($primaryKey, $options = [])
 * @method \BankSystem\Model\Entity\DebitTransaction newEntity($data = null, array $options = [])
 * @method \BankSystem\Model\Entity\DebitTransaction[] newEntities(array $data, array $options = [])
 * @method \BankSystem\Model\Entity\DebitTransaction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \BankSystem\Model\Entity\DebitTransaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \BankSystem\Model\Entity\DebitTransaction[] patchEntities($entities, array $data, array $options = [])
 * @method \BankSystem\Model\Entity\DebitTransaction findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DebitTransactionsTable extends Table
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

        $this->setTable('debit_transactions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('AccountHolders', [
            'foreignKey' => 'account_holder_id',
            'joinType' => 'INNER',
            'className' => 'BankSystem.AccountHolders'
        ]);
        $this->hasMany('TransactionLogs', [
            'foreignKey' => 'debit_transaction_id',
            'className' => 'BankSystem.TransactionLogs'
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
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

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

    public function getHistory($startDate,$endDate)
    {
        $startDate = new Date($startDate);
        $endDate = (new Date($endDate))->addDay();
        $query = $this->find()
            ->where(function ($exp,$q) use ($startDate,$endDate) {
                return $exp ->addCase(
                    [
                        $q->newExpr()->between('created',$startDate,$endDate)
                    ]
                );
            });
        return $query->toArray();
    }
}
