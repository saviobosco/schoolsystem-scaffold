<?php
namespace BankSystem\Controller;

use BankSystem\Controller\AppController;

/**
 * AccountHolders Controller
 *
 * @property \BankSystem\Model\Table\AccountHoldersTable $AccountHolders
 *
 * @method \BankSystem\Model\Entity\AccountHolder[] paginate($object = null, array $settings = [])
 */
class AccountHoldersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['AccountTypes','EWallets','Students']
        ];
        $accountHolders = $this->paginate($this->AccountHolders);

        $this->set(compact('accountHolders'));
        $this->set('_serialize', ['accountHolders']);
    }

    /**
     * View method
     *
     * @param string|null $id Account Holder id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $accountHolder = $this->AccountHolders->get($id, [
            'contain' => ['AccountTypes']
        ]);

        $this->set('accountHolder', $accountHolder);
        $this->set('_serialize', ['accountHolder']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $accountHolder = $this->AccountHolders->newEntity();
        if ($this->request->is('post')) {
            $accountHolder = $this->AccountHolders->patchEntity($accountHolder, $this->request->getData());
            if ($this->AccountHolders->save($accountHolder)) {
                $this->Flash->success(__('The account holder has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The account holder could not be saved. Please, try again.'));
        }
        $students = $this->AccountHolders->getStudents();
        $accountTypes = $this->AccountHolders->AccountTypes->find('list', ['limit' => 200]);
        $this->set(compact('accountHolder', 'accountTypes','students'));
        $this->set('_serialize', ['accountHolder']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Account Holder id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $accountHolder = $this->AccountHolders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $accountHolder = $this->AccountHolders->patchEntity($accountHolder, $this->request->getData());
            if ($this->AccountHolders->save($accountHolder)) {
                $this->Flash->success(__('The account holder has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The account holder could not be saved. Please, try again.'));
        }
        $accountTypes = $this->AccountHolders->AccountTypes->find('list', ['limit' => 200]);
        $this->set(compact('accountHolder', 'accountTypes'));
        $this->set('_serialize', ['accountHolder']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Account Holder id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $accountHolder = $this->AccountHolders->get($id);
        if ($this->AccountHolders->delete($accountHolder)) {
            $this->Flash->success(__('The account holder has been deleted.'));
        } else {
            $this->Flash->error(__('The account holder could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
