<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 10/5/17
 * Time: 4:18 PM
 */

namespace UsersManager\Controller;

use Cake\Event\Event;
use CakeDC\Users\Controller\Traits\LoginTrait;
use CakeDC\Users\Controller\Traits\ProfileTrait;
use CakeDC\Users\Controller\Traits\ReCaptchaTrait;
use CakeDC\Users\Controller\Traits\RegisterTrait;
use CakeDC\Users\Controller\Traits\SimpleCrudTrait;

/**
 * MyUsers Controller
 *
 * @property \UsersManager\Model\Table\AccountsTable $Accounts
 */
class AccountsController extends AppController
{
    use LoginTrait;
    use ProfileTrait;
    use ReCaptchaTrait;
    use RegisterTrait;
    use SimpleCrudTrait;

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('UsersManager.Accounts');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow([
            'logout',
            'requestResetPassword',
            'changePassword',
        ]);
        $this->Auth->deny(['register']);

        if ( $this->request->getParam('action') === 'login') {
            $this->viewBuilder()->setLayout('login');
        }
    }

    /**
     * Add method
     *
     * @return mixed Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $entity = $this->Accounts->newEntity();
        $this->set('account', $entity);
        $this->set('_serialize', ['account']);
        if (!$this->request->is('post')) {
            return;
        }
        $entity = $this->Accounts->patchEntity($entity, $this->request->getData());
        //debug($entity); exit;
        if ($this->Accounts->save($entity)) {
            $this->Flash->success(__('The {0} was successfully created','account'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The {0} could not be created', 'account'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Accounts->get($id);
        if ($this->Accounts->delete($user)) {
            $this->Flash->success(__('The Admin has been deleted.'));
        } else {
            $this->Flash->error(__('The Admin could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function desktop()
    {

    }
}