<?php
namespace BankSystem\Controller;

use BankSystem\Controller\AppController;

/**
 * Debit Controller
 *
 * @property \BankSystem\Model\Table\AccountHoldersTable $AccountHolders
 * @property \BankSystem\Model\Table\DebitTransactionsTable $DebitTransactions
 */
class DebitController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('BankSystem.AccountHolders');
        $this->loadModel('BankSystem.DebitTransactions');
    }

    public function index()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postData = $this->request->getData();
            $result = $this->AccountHolders->debitAccount($postData);
            if ( isset($result['error']) && !empty($result['error'])) {
                $this->Flash->error(__($result['error']));
            }
            if ($result === true) {
                $this->Flash->success(__('Account was successfully debited'));
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
            $histories = $this->DebitTransactions->getHistory($postData['start_date'],$postData['end_date']);
            $this->set('histories',$histories);
        }
    }
}
