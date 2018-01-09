<?php
namespace StudentsManager\Controller;

use StudentsManager\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
/**
 * Students Controller
 *
 * @property \StudentsManager\Model\Table\StudentsTable $Students
 * @property \StudentsManager\Model\Table\StatesTable $States
 * @property \StudentsManager\Model\Table\SessionsTable $Sessions
 */
class StudentsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('StudentsManager.States');
        $this->loadModel('StudentsManager.Sessions');
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        if ( empty($this->request->getQuery('class_id'))) {
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
        }
        else {
            $this->paginate = [
                'limit' => 1000,
                'maxLimit' => 1000,
                'contain' => ['Classes'],
                'conditions' => [
                    'Students.status'   => 1,
                    'Students.class_id' => $this->request->getQuery('class_id')
                ]
            ];
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
                'contain' => ['Classes']
            ]);
            $this->set('student', $student);
            $this->set('_serialize', ['student']);

        } catch ( RecordNotFoundException $e ) {
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
            $student = $this->Students->patchEntity($student, $this->request->getData());

            if ($this->Students->addStudent($student)) {
                $this->Flash->success(__('The student has been saved.'));
                if ( $this->request->getData('return_here')) {
                    return $this->redirect(['action' => 'add']);
                }
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The student could not be saved. Please, try again.'));
            }
        }
        $sessions = $this->Sessions->find('list', ['limit' => 200]);
        $classes = $this->Students->Classes->find('list', ['limit' => 200]);
        $classDemarcations = $this->Students->ClassDemarcations->find('list', ['limit' => 200]);
        $states = $this->States->find('list');
        $this->set(compact('student', 'sessions', 'classes', 'classDemarcations','states'));
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
            $student = $this->Students->get($id, [
                'contain' => []
            ]);

            if ($this->request->is(['patch', 'post', 'put'])) {
                $student = $this->Students->patchEntity($student, $this->request->getData());
                if ( $this->Students->save($student) ) {
                    $this->Flash->success(__('The student has been saved.'));

                    //return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The student could not be saved. Please, try again.'));
                }
            }
            $states = $this->States->find('list');
            $sessions = $this->Sessions->find('list', ['limit' => 200]);
            $classes = $this->Students->Classes->find('list', ['limit' => 200]);
            $classDemarcations = $this->Students->ClassDemarcations->find('list', ['limit' => 200]);
            $this->set(compact('student', 'sessions', 'classes', 'classDemarcations','states'));
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
            $this->request->allowMethod(['post', 'delete']);
            $student = $this->Students->get($id);
            if ($this->Students->delete($student)) {
                $this->Flash->success(__('The student has been deleted.'));
            } else {
                $this->Flash->error(__('The student could not be deleted. Please, try again.'));
            }

            return $this->redirect(['action' => 'index']);
        }
    }

    public function unActiveStudents()
    {
        if ( empty($this->request->getQuery('class_id'))) {
            $this->paginate = [
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
        }
        else {
            $this->paginate = [
                'limit' => 1000,
                'maxLimit' => 1000,
                'contain' => ['Classes'],
                'conditions' => [
                    'Students.status'   => 0,
                    'Students.class_id' => $this->request->getQuery('class_id')
                ]
            ];
        }
        $unActiveStudents = $this->paginate($this->Students);
        $classes = $this->Students->Classes->find('list',['limit' => 200]);
        $this->set(compact('unActiveStudents','classes'));
    }

    /**
     * @param id
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
            $this->redirect(['action' => 'index']);
        } catch ( RecordNotFoundException $e ) {
            $this->Flash->error(__('No Student Record was found!'));
            $this->redirect(['action' => 'index']);
        }
    }

    /**
     * @param id
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
            $this->redirect(['action' => 'index']);
        } catch ( RecordNotFoundException $e ) {
            $this->Flash->error(__('No Student Record was found!'));
            $this->redirect(['action' => 'index']);
        }
    }

    /**
     * This function is used to email a student parents or guardian
     */
    public function emailStudentParents()
    {

    }

    /**
     * This function is used to send an sms to the student's guardian
     */
    public function sendSms()
    {

    }

    public function changeClass()
    {
        $students = null;

        if (!empty($this->request->getQuery('class_id'))) {
            $this->paginate = [
                'limit' => 1000,
                'maxLimit' => 1000,
                'contain' => ['Classes'],
                'conditions' => [
                    'Students.status'   => 1,
                    'Students.class_id' => $this->request->getQuery('class_id')
                ],
            ];
            $students = $this->paginate($this->Students);
        }
        $sessions = $this->Sessions->find('list',['limit' => 200]);
        $classes = $this->Students->Classes->find('list',['limit' => 200]);
        $this->set(compact('students','sessions','classes'));
        $this->set('_serialize', ['students']);

        if ( $this->request->is(['patch', 'post', 'put']) ) {
            // get postData
            $postData = $this->request->getData();
            if ( empty($postData['change_class_id'])) {
                $this->Flash->error(__('Please select a class to change students to .... '));
                return;
            }
            if ( empty($postData['student_ids'])) {
                $this->Flash->error(__('No Student was selected. Please select a student(s)'));
                return;
            }
            $returnData = $this->Students->changeStudentsClass($postData['change_class_id'],$postData['student_ids']);
            if ($returnData['success'] ) {
                $this->Flash->success(__('The selected students class was successfully changed'));
                return $this->redirect($this->request->referer());
            } else {
                $this->Flash->error(__('The specified class and current class are the same.'));
            }
        }
    }
}

