<?php
namespace BankSystem\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * AccountHolders Model
 *
 * @property \BankSystem\Model\Table\AccountTypesTable|\Cake\ORM\Association\BelongsTo $AccountTypes
 * @property \BankSystem\Model\Table\AccountTypesTable|\Cake\ORM\Association\hasOne $Students
 * @property \BankSystem\Model\Table\AccountTypesTable|\Cake\ORM\Association\hasOne $EWallets
 *
 * @method \BankSystem\Model\Entity\AccountHolder get($primaryKey, $options = [])
 * @method \BankSystem\Model\Entity\AccountHolder newEntity($data = null, array $options = [])
 * @method \BankSystem\Model\Entity\AccountHolder[] newEntities(array $data, array $options = [])
 * @method \BankSystem\Model\Entity\AccountHolder|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \BankSystem\Model\Entity\AccountHolder patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \BankSystem\Model\Entity\AccountHolder[] patchEntities($entities, array $data, array $options = [])
 * @method \BankSystem\Model\Entity\AccountHolder findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AccountHoldersTable extends Table
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

        $this->setTable('account_holders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('AccountTypes', [
            'foreignKey' => 'account_type_id',
            'className' => 'BankSystem.AccountTypes'
        ]);

        $this->hasOne('Students',[
            'foreignKey' => 'id',
            'bindingKey' => 'student_id',
            'className' => 'BankSystem.Students'
        ]);

        $this->hasOne('EWallets',[
            'foreignKey' => 'account_holder_id',
            'className' => 'BankSystem.EWallets'
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
            ->scalar('first_name');

        $validator
            ->scalar('last_name');

        $validator
            ->integer('account_number')
            ->allowEmpty('account_number');

        $validator
            ->integer('status');

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
        $rules->add($rules->existsIn(['account_type_id'], 'AccountTypes'));
        return $rules;
    }

    public function getStudents()
    {
        return $this->Students->find('all')
            ->where(['status'=>1])
            ->map(function( $row){
                $row->selectData = $row->first_name.' '.$row->last_name;
                return $row;
            })->combine('id','selectData')->toArray();
    }

    public function getAccounts()
    {
        return $this->find('all')->contain(['Students'=>function($q){
            $q->select(['id','first_name','last_name']);
            $q->where(['Students.status'=>1]);
            return $q;
        }])
            ->map(function($row){
                if ( !is_null($row->student_id)) {
                    $row->selectData = $row->student->first_name.' '.$row->student->last_name;
                }else {
                   $row->selectData = $row->first_name.' '.$row->last_name;
                }
                return $row;
            })->combine('id','selectData')->toArray();
    }

    public function creditAccount($postData)
    {
        $eWallet  = $this->getAccountEWallet($postData['account_holder_id']);
        $eWallet = $this->creditMoneyToEWallet($eWallet,$postData['amount']);
        if ( $eWallet) {
            // log to credit transactions
            $creditTransaction = $this->logToCreditTransactions($eWallet,$postData['amount']);
            if ( $creditTransaction ) {
                // log to transactionLogs table
                if ($this->logTransactionDetailsToTransactionLog($creditTransaction,$postData['purpose'],'credit') ) {
                    return true;
                }
            }
        }
        return false;
    }

    public function debitAccount($postData)
    {
        $return = null;
        $eWallet  = $this->getAccountEWallet($postData['account_holder_id']);
        // check if the money is withdrawal first
        if ( (int)$postData['amount'] > (int)$eWallet->amount ) {
            $return['error'] = 'Amount specified is greater than amount in the account.';
            return $return;
        }
        $eWallet = $this->debitMoneyFromEWallet($eWallet,$postData['amount']);

        if ( $eWallet) {
            // log to credit transactions
            $debitTransaction = $this->logToDebitTransactions($eWallet,$postData['amount']);
            if ( $debitTransaction ) {
                // log to transactionLogs table
                if ($this->logTransactionDetailsToTransactionLog($debitTransaction,$postData['purpose'],'debit') ) {
                    $return = true;
                    return $return;
                }
            }
        }
        return false;
    }

    public function debitMoneyFromEWallet(EntityInterface $EWallet, $amount )
    {
        $EWallet->amount -= $amount ;

        return $this->EWallets->save($EWallet);
    }

    public function getAccountEWallet($account_holder_id)
    {
        return $this->EWallets->findOrCreate(['account_holder_id'=>$account_holder_id]);
    }

    public function creditMoneyToEWallet(EntityInterface $EWallet, $amount )
    {
        // credit EWallet
        $EWallet->amount += $amount ;
        return $this->EWallets->save($EWallet);
    }

    public function logToCreditTransactions(EntityInterface $eWallet,$amount)
    {
        // log details to credit transactions log table
        $creditTransactionsTable = TableRegistry::get('BankSystem.CreditTransactions');
        $creditTransaction = $creditTransactionsTable->newEntity([
            'account_holder_id' => $eWallet->account_holder_id,
            'amount' => $amount,
        ]);
        return $creditTransactionsTable->save($creditTransaction);
    }

    public function logToDebitTransactions(EntityInterface $EWallet,$amount )
    {
        // log details to debit transactions log table
        $debitTransactionsTable = TableRegistry::get('BankSystem.DebitTransactions');
        $debitTransaction = $debitTransactionsTable->newEntity([
            'account_holder_id' => $EWallet->account_holder_id,
            'amount' => $amount,
        ]);
        return $debitTransactionsTable->save($debitTransaction);
    }

    public function logTransactionDetailsToTransactionLog(EntityInterface $entity,$description,$type )
    {
        $transactionLogsTable = TableRegistry::get('BankSystem.TransactionLogs');
        $transactionLog = $transactionLogsTable->newEntity();
        // using a switch case statement
        switch ($type ) {
            case 'credit' :
                // execute credit log commands
                $newData = [
                    'account_holder_id' => $entity->account_holder_id,
                    'credit_transaction_id'=>$entity->id,
                    'description' => $description
                ];
                $transactionLog = $transactionLogsTable->patchEntity($transactionLog,$newData);
                break;
            case 'debit' :
                // execute debit log commands
                $newData = [
                    'account_holder_id' => $entity->account_holder_id,
                    'debit_transaction_id'=>$entity->id,
                    'description' => $description
                ];
                $transactionLog = $transactionLogsTable->patchEntity($transactionLog,$newData);
                break;
            default :
                return false;
            // saving the transaction
        }
        return $transactionLogsTable->save($transactionLog);
    }

    public function transferFunds($postData)
    {
        $return = null;
        $debitData = [
            'account_holder_id' => $postData['sender_holder_id'],
            'amount' => $postData['amount'],
            'purpose' => $postData['purpose']
        ];
        // begin transaction funds transfer
        $debitResult = $this->debitAccount($debitData);
        if ( isset($debitResult['error'])) {
            $return['error'] = $debitResult['error']; // the amount specified is greater that what is in the account
            return $return;
        }
        if ( $debitResult !== true) {
            return $return = false;
        }
        $creditData = [
            'account_holder_id' => $postData['receiver_holder_id'],
            'amount' => $postData['amount'],
            'purpose' => $postData['purpose']
        ];
        $creditResult = $this->creditAccount($creditData);
        if ( $creditResult !== true) {
            return $return = false;
        }
        return $return = true;
    }
}
