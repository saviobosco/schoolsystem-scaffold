<?php
namespace BankSystem\Controller;

use BankSystem\Controller\AppController;
/**
 * Credit Controller
 *
 * @property \BankSystem\Model\Table\AccountHoldersTable $AccountHolders
 * @property \BankSystem\Model\Table\CreditTransactionsTable $CreditTransactions
 */
class CreditController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('BankSystem.AccountHolders');
        $this->loadModel('BankSystem.CreditTransactions');
    }
    public function index()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postData = $this->request->getData();
            if ($this->AccountHolders->creditAccount($postData)) {
                $this->Flash->success(__('Account was successfully credit with {0}',$postData['amount']));
            }else {
                $this->Flash->error(__('Account could not be credited. Please try again.'));
            }
        }
        $accounts = $this->AccountHolders->getAccounts();
        $this->set(compact('accounts'));
    }

    public function history()
    {
        if( $this->request->is('post')) {
            $postData = $this->request->getData();
            // get the transactions using submitted dates
            $histories = $this->CreditTransactions->getHistory($postData['start_date'],$postData['end_date']);
            $this->set('histories',$histories);
        }
    }
}
