<?php
namespace StudentAccount\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;
use StudentAccount\Controller\AppController;

/**
 * Login Controller
 *
 *
 * @method \StudentAccount\Model\Entity\Student[] paginate($object = null, array $settings = [])
 * @property \ResultSystem\Model\Table\StudentsTable $Students
 */
class LoginController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('StudentAccount.Students');
        $this->Auth->allow();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

    }

    public function login()
    {
        $postData = $this->request->getData();

        if ($this->request->is('post')) {
            // find the user with that admission number
            try {
                $student = $this->Students->find('all')->where(['id' => $postData['admission_number']])->enableHydration(false)->firstOrFail();
                $this->Auth->setUser($student);
                return $this->redirect($this->Auth->redirectUrl());
            } catch ( RecordNotFoundException $exception) {
                $this->Flash->error('Student not found!');
                return $this->redirect($this->referer());
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
