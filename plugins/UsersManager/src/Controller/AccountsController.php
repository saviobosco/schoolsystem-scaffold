<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 10/5/17
 * Time: 4:18 PM
 */

namespace UsersManager\Controller;

use Cake\Core\Plugin;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use CakeDC\Users\Controller\Traits\LoginTrait;
use CakeDC\Users\Controller\Traits\ProfileTrait;
use CakeDC\Users\Controller\Traits\ReCaptchaTrait;
use CakeDC\Users\Controller\Traits\RegisterTrait;
use CakeDC\Users\Controller\Traits\SimpleCrudTrait;
use CakeDC\Users\Controller\Component\UsersAuthComponent;
use Cake\Network\Exception\NotFoundException;

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

    public function login()
    {
        $event = $this->dispatchEvent(UsersAuthComponent::EVENT_BEFORE_LOGIN);
        if (is_array($event->result)) {
            return $this->_afterIdentifyUser($event->result);
        }
        if ($event->isStopped()) {
            return $this->redirect($event->result);
        }

        $socialLogin = $this->_isSocialLogin();
        $googleAuthenticatorLogin = $this->_isGoogleAuthenticator();

        if ($this->request->is('post')) {
            if (!$this->_checkReCaptcha()) {
                $this->Flash->error(__d('CakeDC/Users', 'Invalid reCaptcha'));

                return;
            }
            $user = $this->Auth->identify();
            if ($user['active'] === false) {
                $this->Flash->error('Account is Unactive!');
                return;
            }
            // check if user is not active
            // and redirect back to login page with error

            return $this->_afterIdentifyUser($user, $socialLogin, $googleAuthenticatorLogin);
        }

        if (!$this->request->is('post') && !$socialLogin) {
            if ($this->Auth->user()) {
                if (!$this->request->getSession()->read('Users.successSocialLogin')) {
                    $msg = __d('CakeDC/Users', 'You are already logged in');
                    $this->Flash->error($msg);
                } else {
                    $this->request->getSession()->delete('Users.successSocialLogin');
                    $this->request->getSession()->delete('Flash');
                }
                $url = $this->Auth->redirectUrl();

                return $this->redirect($url);
            }
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return mixed Redirects on successful edit, renders view otherwise.
     * @throws NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $table = $this->loadModel();
        $tableAlias = $table->alias();
        $entity = $table->get($id, [
            'contain' => []
        ]);
        $this->set($tableAlias, $entity);
        $this->set('tableAlias', $tableAlias);
        $this->set('_serialize', [$tableAlias, 'tableAlias']);
        // if the user is teacher, load the subjects
        if ($entity['role'] === 'teacher') {
            if (Plugin::loaded('SubjectsManager')) {
                $subjectsTable = TableRegistry::get('SubjectsManager.Subjects');
                $subjects = $subjectsTable->query()
                    ->contain(['Blocks'])
                    ->map(function($row) {
                        $row->subject_name = $row->name . ' ('.$row->block->name.') ';
                        return $row;
                    });
                $teachersSubjectTable = TableRegistry::get('TeachersSubjects');
                $teacherSubjects = $teachersSubjectTable->query()
                    ->enableHydration(false)
                    ->where(['teacher_id' => $id])
                    ->extract('subject_id')
                    ->toArray();
                $this->set(compact('subjects','teacherSubjects'));
            }

            if (Plugin::loaded('ClassManager')) {
                $classTable = TableRegistry::get('ClassManager.Classes');
                $classes = $classTable->query()
                    ->find('all');

                $teachersClassesTable = TableRegistry::get('TeachersClasses');
                $teacherClasses = $teachersClassesTable->query()
                    ->enableHydration(false)
                    ->where(['teacher_id' => $id])
                    ->extract('class_id')
                    ->toArray();
                $this->set(compact('classes', 'teacherClasses'));
            }
            $termsTable = TableRegistry::get('Terms');
            $terms = $termsTable->find('list');
            $sessionsTable = TableRegistry::get('Sessions');
            $sessions = $sessionsTable->find('list');
            $this->set(compact('terms', 'sessions'));

            // get teachers permissions
            $teacherPermissionsTable = TableRegistry::get('UsersManager.TeachersSubjectsClassesPermissions');
            //dd($teacherPermissionsTable->getSchema());
            $teacherPermissions = $teacherPermissionsTable->query()
                ->enableHydration(false)
                ->select(['class_id','subjects', 'terms', 'sessions'])
                ->where(['teacher_id' => $id])
                ->indexBy('class_id')
                ->toArray();
            $this->set(compact('teacherPermissions'));
        }
        if (!$this->request->is(['patch', 'post', 'put'])) {
            return;
        }
        $entity = $table->patchEntity($entity, $this->request->getData());
        $singular = Inflector::singularize(Inflector::humanize($tableAlias));
        if ($table->save($entity)) {
            $this->Flash->success(__d('CakeDC/Users', 'The {0} has been saved', $singular));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__d('CakeDC/Users', 'The {0} could not be saved', $singular));
    }
}