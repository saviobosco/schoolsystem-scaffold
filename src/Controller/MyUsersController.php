<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/5/16
 * Time: 5:57 PM
 */

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\MyUsersTable;
use Cake\Event\Event;
use CakeDC\Users\Controller\Traits\LoginTrait;
use CakeDC\Users\Controller\Traits\ProfileTrait;
use CakeDC\Users\Controller\Traits\ReCaptchaTrait;
use CakeDC\Users\Controller\Traits\RegisterTrait;
use CakeDC\Users\Controller\Traits\SimpleCrudTrait;
/**
 * MyUsers Controller
 *
 * @property \App\Model\Table\StudentsTable $MyUsers
 */
class MyUsersController extends AppController
{
    use LoginTrait;
    use ProfileTrait;
    use ReCaptchaTrait;
    use RegisterTrait;
    use SimpleCrudTrait;

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('MyUsers');
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['logout']);
        $this->Auth->deny(['register']);
    }


    public function teachers()
    {
        $this->paginate = [
            'conditions' => [
                'MyUsers.role'   => 'teacher',
            ],
        ];
        $users = $this->paginate($this->MyUsers);

        $title = 'All Admins';
        $this->set(compact('users','schools','title'));
        $this->set('_serialize', ['users']);
    }

    public function students()
    {
        $this->paginate = [
            'conditions' => [
                'MyUsers.role'   => 'student',
            ],
        ];
        $users = $this->paginate($this->MyUsers);

        $title = 'All Admins';
        $this->set(compact('users','schools','title'));
        $this->set('_serialize', ['users']);
    }

    public function parents()
    {
        $this->paginate = [
            'conditions' => [
                'MyUsers.role'   => 'parent',
            ],
        ];
        $users = $this->paginate($this->MyUsers);

        $title = 'All Admins';
        $this->set(compact('users','schools','title'));
        $this->set('_serialize', ['users']);
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
        $user = $this->MyUsers->get($id);
        if ($this->MyUsers->delete($user)) {
            $this->Flash->success(__('The Admin has been deleted.'));
        } else {
            $this->Flash->error(__('The Admin could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}