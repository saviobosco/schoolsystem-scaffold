<?php
namespace StudentsManager\Controller;

use Cake\Event\Event;
use Cake\Http\Client;
use StudentsManager\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use UsersManager\Exception\UserExistsException;

/**
 * Students Controller
 *
 * @property \StudentsManager\Model\Table\StudentsTable $Students
 * @property \StudentsManager\Model\Table\StatesTable $States
 * @property \StudentsManager\Model\Table\SessionsTable $Sessions
 * @property \StudentsManager\Model\Table\ReligionsTable $Religions
 */
class StudentsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('StudentsManager.Religions');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['view']);
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'limit' => 1000,
            'maxLimit' => 1000,
            'contain' => ['Classes'],
            'conditions' => [
                'Students.status'   => 1,
            ],
            // Place the result in ascending order according to the class.
            'order' => [
                'class_id' => 'asc'
            ]
        ];
        if ( !empty($this->request->getQuery('class_id'))) {
            $this->paginate = array_merge_recursive($this->paginate,[
                'conditions' => [
                    'Students.class_id' => $this->request->getQuery('class_id')
                ]
            ]);
        }
        $students = $this->paginate($this->Students);
        $sessions = $this->Sessions->find('list',['limit' => 200]);
        $classes = $this->Students->Classes->find('list',['limit' => 200]);
        $this->set(compact('students','sessions','classes'));
        $this->set('_serialize', ['students']);
    }

    /**
     * View method
     *
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        try {
            /**
             * if no argument is specified redirect to the index action
             */
            if (empty($id)) {
                $this->redirect(['action' => 'index']);
            }
            $student = $this->Students->get($id, [
                'contain' => ['Classes' => ['fields' => ['id','class']]
                ]
            ]);
            if ($this->request->accepts('application/json')) {
                return $this->response->withStringBody(json_encode($student));
            }
            $religions = $this->Religions->find('list')->toArray();
            $this->set(compact('student','religions'));
            $this->set('_serialize', ['student']);

        } catch ( RecordNotFoundException $exception ) {
            if ($this->request->accepts('application/json')) {
                return $this->response->withStatus(404, 'Resource Not Found');
            }
            $this->render('/Element/Error/studentRecordNotFound');
        }

    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $student = $this->Students->newEntity();
        if ($this->request->is('post')) {
            try {
                $student = $this->Students->patchEntity($student, $this->request->getData());
                $savedStudent = $this->Students->addStudent($student);
                if ($savedStudent) {
                    $this->Flash->success(__('The student has been saved.'));
                    $this->Flash->set('Last student id:'.$savedStudent->id);
                } else {
                    $this->Flash->error(__('The student could not be saved. Please, try again.'));
                }
            } catch (UserExistsException $exception) {
                $this->Flash->error(__('A User with the Admission No as username already exists!'));
            }
            if (isset($savedStudent) and $savedStudent !== false) {
                if ( $this->request->getData('return_here')) {
                    if (isset($savedStudent) and $savedStudent !== false) {
                        return $this->redirect(['action' => 'add']);
                    }
                }
                return $this->redirect(['action' => 'index']);
            }
        }
        $sessions = $this->Sessions->find('list');
        $classes = $this->Students->Classes->find('list');
        $religions = $this->Religions->find('list');
        $states = $this->States->find('list');
        $this->set(compact('student', 'sessions', 'classes','states','religions'));
        $this->set('_serialize', ['student']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        try {
            /**
             * if no argument is specified redirect to the index action
             */
            if (empty($id)) {
                $this->redirect(['action' => 'index']);
            }
            $student = $this->Students->get($id);

            if ($this->request->is(['patch', 'post', 'put'])) {
                $student = $this->Students->patchEntity($student, $this->request->getData());
                if ( $this->Students->save($student) ) {
                    $this->Flash->success(__('The student has been saved.'));
                } else {
                    $this->Flash->error(__('The student could not be saved. Please, try again.'));
                }
            }
            $states = $this->States->find('list');
            $religions = $this->Religions->find('list');
            $classes = $this->Students->Classes->find('list');
            $classDemarcations = $this->Students->ClassDemarcations->find('list');
            $this->set(compact('student', 'sessions', 'classes', 'classDemarcations','states','religions'));
            $this->set('_serialize', ['student']);

        } catch ( RecordNotFoundException $e ) {
            $this->render('/Element/Error/studentRecordNotFound');
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (empty($id)) {
            $this->redirect(['action' => 'index']);
            $this->Flash->error('Please Specify the student id and try again.');

        } else {
            try {
                $this->request->allowMethod(['post', 'delete']);
                $student = $this->Students->get($id);
                if ($this->Students->delete($student)) {
                    $this->Flash->success(__('The student has been deleted.'));
                } else {
                    $this->Flash->error(__('The student could not be deleted. Please, try again.'));
                }
            } catch ( \Exception $e ){
                $this->Flash->error($e->getMessage());
            }
            return $this->redirect(['action' => 'index']);
        }
    }

    public function unActiveStudents()
    {
        $this->paginate = [
            'fields' => ['Students.id','Students.first_name','Students.last_name','Students.gender','Students.class_id'],
            'limit' => 1000,
            'maxLimit' => 1000,
            'contain' => ['Classes'],
            'conditions' => [
                'Students.status'   => 0,
            ],
            // Place the result in ascending order according to the class.
            'order' => [
                'class_id' => 'asc'
            ]
        ];
        if ( $class_id = $this->request->getQuery('class_id') ) {
            $this->paginate = array_merge_recursive($this->paginate,[
                'conditions' => [
                'Students.class_id' => $this->request->getQuery('class_id')
            ]]);
        }
        $unActiveStudents = $this->paginate($this->Students);
        $classes = $this->Students->Classes->find('list')->toArray();
        $this->set(compact('unActiveStudents','classes'));
    }

    /**
     * @param null $id
     * @return \Cake\Http\Response|null
     * This function is used to activate a student Account
     */
    public function activate($id = null )
    {
        try {
            $student = $this->Students->get($id);
            if ($this->Students->activateStudent($student) ) {
                $this->Flash->success(__('The student has been activated'));
            } else {
                $this->Flash->success(__('The student could not be activated!'));
            }
            return $this->redirect($this->referer());
        } catch ( RecordNotFoundException $e ) {
            $this->Flash->error(__('No Student Record was found!'));
            return $this->redirect($this->referer());
        }
    }

    /**
     * @param null $id
     * @return \Cake\Http\Response|null
     * This function is used to deactivate a student Account
     */
    public function deactivate($id = null)
    {
        try {
            $student = $this->Students->get($id);
            if ($this->Students->deactivateStudent($student) ) {
                $this->Flash->success(__('The student has been deactivated!'));
            } else {
                $this->Flash->success(__('The student could not be deactivated!'));
            }
            return $this->redirect($this->referer());
        } catch ( RecordNotFoundException $e ) {
            $this->Flash->error(__('No Student Record was found!'));
            return $this->redirect($this->referer());
        }
    }

    public function pushData()
    {
        $this->loadModel('ClassManager.Classes');
        $this->loadModel('Sessions');
        $this->loadModel('ResultSystem.Terms');
        $classes = $this->Classes->find('all')->toArray();
        $sessions = $this->Sessions->find('all')->toArray();
        $terms = $this->Terms->find('all')->toArray();
        $student = $this->Students->find('all')->where(['id' => '001'])
            /*->contain([
                'StudentTermlyResults',
            ])*/->first();
        $http = new Client();
        $data = ['student' => $student,
            'classes' => $classes,
            'terms' => $terms,
            'sessions' => $sessions,
        ];
        $response = $http->post('http://localhost/SchoolSystem2/test-json/create',
            json_encode($data),
            ['type'=>'json']
        );
        dd($response->body());
    }

    public function changeAdmissionNumber()
    {
        $postData = $this->request->getData();
        if (empty($postData['new_admission_number'])) {
            $this->Flash->error('New admission number cannot be empty!');
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            try {
                $this->Students->query()
                    ->update()
                    ->set(['id' => $postData['new_admission_number']])
                    ->where(['id' => $postData['old_admission_number']])
                    ->execute();
                $this->Flash->success('Admission Number was successfully changed');
                return $this->redirect(['action' => 'edit', $postData['new_admission_number']]);
            } catch ( \Exception $exception) {
                $this->Flash->error($exception->getMessage());
            }
        }
        return $this->redirect($this->referer());
    }
}

