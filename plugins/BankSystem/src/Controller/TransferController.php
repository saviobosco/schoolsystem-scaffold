<?php
namespace BankSystem\Controller;

use BankSystem\Controller\AppController;

/**
 * Transfer Controller
 *
 * @property \BankSystem\Model\Table\AccountHoldersTable $AccountHolders
 */
class TransferController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('BankSystem.AccountHolders');
    }


    public function index()
    {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postData = $this->request->getData();
            $result = $this->AccountHolders->transferFunds($postData);
            if ( isset($result['error'])) {
                $this->Flash->error(__($result['error']));
            }
            if ($result === true) {
                $this->Flash->success(__('The transfer was successfully executed'));
            } else {
                $this->Flash->error(__('An error occurred please try again.'));
            }
        }
        $accounts = $this->AccountHolders->getAccounts();
        $this->set(compact('accounts'));
    }
}
