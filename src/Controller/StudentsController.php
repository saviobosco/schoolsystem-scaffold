<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Controller\Traits\SearchParameterTrait;
use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * Students Controller
 *
 * @property \App\Model\Table\StudentsTable $Students
 * @property \App\Model\Table\StatesTable $States
 */
class StudentsController extends AppController
{

    use SearchParameterTrait;

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('States');
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        if ( empty($this->request->query['class_id'])) {
            $this->paginate = [
                'limit' => 1000,
                'maxLimit' => 1000,
                'contain' => ['Sessions', 'Classes'],
                /*'conditions' => [
                    'Students.status'   => 1,
                    'Students.graduated'   => 0
                ],*/
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
                'contain' => ['Sessions', 'Classes'],
                'conditions' => [
                   // 'Students.status'   => 1,
                   // 'Students.graduated'   => 0,
                    'Students.class_id' => $this->_getDefaultValue($this->request->query['class_id'],1)
                ]
            ];
        }
        $students = $this->paginate($this->Students);
        $sessions = $this->Students->Sessions->find('list',['limit' => 200]);
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
                'contain' => ['Sessions', 'Classes','SessionAdmitted']
            ]);
            $this->set('student', $student);
            $this->set('_serialize', ['student']);

        } catch ( RecordNotFoundException $e ) {
            $this->render('/Element/Error/recordnotfound');
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
            $student = $this->Students->patchEntity($student, $this->request->data);

            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student has been saved.'));

                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('The student could not be saved. Please, try again.'));
            }
        }
        $sessions = $this->Students->Sessions->find('list', ['limit' => 200]);
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
                $student = $this->Students->patchEntity($student, $this->request->data);
                if ( $this->Students->save($student) ) {
                    $this->Flash->success(__('The student has been saved.'));

                    //return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The student could not be saved. Please, try again.'));
                }
            }
            $states = $this->States->find('list');
            $sessions = $this->Students->Sessions->find('list', ['limit' => 200]);
            $classes = $this->Students->Classes->find('list', ['limit' => 200]);
            $classDemarcations = $this->Students->ClassDemarcations->find('list', ['limit' => 200]);
            $this->set(compact('student', 'sessions', 'classes', 'classDemarcations','states'));
            $this->set('_serialize', ['student']);

        } catch ( RecordNotFoundException $e ) {
            $this->Flash->error('Record Not found');
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
            $this->Flash->error('Please Specify the student Id was not specified. Try again');

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

    /**
     *  The function take now argument .
     * It returns the graduated students
     */
    public function graduatedStudents()
    {
        // get the graduated Students .
        $graduatedStudents = $this->Students->find('GraduatedStudents');
        $this->set(compact('graduatedStudents'));
    }

    public function unActiveStudents()
    {
        $unActiveStudents = $this->Students->findUnActiveStudents();
        $this->set(compact('unActiveStudents'));
    }
}
