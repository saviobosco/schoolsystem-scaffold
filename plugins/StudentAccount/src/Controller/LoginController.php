<?php
namespace StudentAccount\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\I18n\Time;
use StudentAccount\Controller\AppController;

/**
 * Login Controller
 *
 *
 * @method \StudentAccount\Model\Entity\Student[] paginate($object = null, array $settings = [])
 * @property \StudentAccount\Model\Table\StudentLoginsTable $StudentLogins
 */
class LoginController extends AppController
{

    public function initialize()
    {

        parent::initialize();
        $this->loadModel('StudentAccount.StudentLogins');
        $this->Auth->allow();
    }



    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('login');

    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                if ($user['status'] == 0) {
                    $this->Flash->error(__('Account is Unactive. Please contact the School Authority'));
                    return $this->redirect($this->referer());
                }
                // Updating the last seen
                $authUser = $this->StudentLogins->get($user['id'],
                    ['contain' => [
                        'Students' => [
                            'fields' => [
                            'id', 'first_name', 'last_name', 'photo','class_id'
                        ]
                        ]
                    ]
                    ]);
                $authUser->last_seen = Time::now();
                $this->StudentLogins->save($authUser);
                $this->Auth->setUser($authUser->toArray());
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Flash->error(__('Invalid username or password, try again'));
            }
        }
        return $this->redirect($this->referer());
    }

    public function logout()
    {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }
}
