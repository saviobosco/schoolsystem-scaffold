<?php
namespace StudentsManager\Controller;

use Cake\Event\Event;
use Cake\Http\Client;
use Cake\ORM\Query;
use StudentsManager\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use UsersManager\Exception\UserExistsException;

/**
 * Students Controller
 *
 * @property \StudentsManager\Model\Table\StudentsTable $Students
 * @property \StudentsManager\Model\Table\StatesTable $States
 * @property \StudentsManager\Model\Table\SessionsTable $Sessions
 * @property \App\Model\Table\ReligionsTable $Religions
 * @property \App\Model\Table\NationalitiesTable $Nationalities
 * @property \App\Model\Table\MedicalIssuesTable $MedicalIssues
 * @property \App\Model\Table\StudentTypesTable $StudentTypes
 */
class StudentsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('App.Religions');
        $this->loadModel('App.MedicalIssues');
        $this->loadModel('App.Nationalities');
        $this->loadModel('App.StudentTypes');
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
        $getQuery = $this->request->getQuery();
        $StudentsQuery = $this->Students->searchStudentWithCriteria($getQuery);

        if ($StudentsQuery instanceof Query) {
            $students = $this->paginate($StudentsQuery);
        } else {
            $students = $StudentsQuery;
        }
        $classes = $this->Students->Classes->find('list');
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
     * Registration method
     *
     * @return \Cake\Network\Response|void
     */
    public function add()
    {
        $student = $this->Students->newEntity();
        if ($this->request->is(['post'])) {
            $postData = $this->request->getData();
            $student = $this->Students->patchEntity($student, $postData);
            if (isset($student['photo']) && is_array($student['photo'])) {
                $photo_destination = $this->Students->uploadStudentPhoto($postData['photo'], $student->id);
                if ($photo_destination) {
                    $student['photo'] = $photo_destination;
                } else {
                    $student['photo'] = null;
                }
            }
            try {
                $savedStudent = $this->Students->addStudent($student);
                if ($savedStudent) {
                    $this->Flash->success(__('The student has been saved.'));
                    $this->Flash->set('Last student id:'.$savedStudent->id);
                    $this->redirect($this->referer());
                } else {
                    $this->Flash->error(__('The student could not be saved. Please, try again.'));
                }
            } catch (UserExistsException $exception) {
                $this->Flash->error(__('A User with the Admission No as username already exists!'));
            } catch (\Exception $exception) {
                $this->Flash->error($exception->getMessage());
            }
        }
        $sessions = $this->Sessions->find('list',['keyField' => 'session', 'valueField' => 'session']);
        $classes = $this->Students->Classes->find('list');
        $states = $this->States->find('list');
        $religions = $this->Religions->find('list');
        $nationalities = $this->Nationalities->find('list');
        $default_nationality = $this->Nationalities->find()->select('id')->where('default_selection', 1)->first()['id'];
        $default_religion = $this->Religions->find()->select('id')->where('default_selection', 1)->first()['id'];
        $medicalIssues = $this->MedicalIssues->find('list');
        $bloodGroups = $this->Students->getBloodGroups();
        $genotypes = $this->Students->getGenotypes();
        $sponsorRelationships = $this->Students->getSponsorRelations();
        $studentTypes = $this->StudentTypes->find('list');
        $default_student_type = $this->StudentTypes->find()->select('id')->where('default_selection', 1)->first()['id'];
        $this->set(compact('student', 'sessions', 'classes','states', 'religions', 'studentTypes', 'default_student_type',
            'nationalities','medicalIssues', 'bloodGroups', 'genotypes',
            'default_nationality', 'default_religion', 'sponsorRelationships'));
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
                $postData = $this->request->getData();
                $student = $this->Students->patchEntity($student, $postData);
                if (isset($student['photo']) && is_array($student['photo'])) {
                    $photo_destination = $this->Students->uploadStudentPhoto($postData['photo'], $student->id);
                    if ($photo_destination) {
                        $student['photo'] = $photo_destination;
                    } else {
                        $student['photo'] = null;
                    }
                }
                if ( $this->Students->save($student) ) {
                    $this->Flash->success(__('The student has been saved.'));
                } else {
                    $this->Flash->error(__('The student could not be saved. Please, try again.'));
                }
            }
            $sessions = $this->Sessions->find('list',['keyField' => 'session', 'valueField' => 'session']);
            $classes = $this->Students->Classes->find('list');
            $states = $this->States->find('list');
            $religions = $this->Religions->find('list');
            $nationalities = $this->Nationalities->find('list');
            $default_nationality = $this->Nationalities->find()->select('id')->where('default_selection', 1)->first()['id'];
            $default_religion = $this->Religions->find()->select('id')->where('default_selection', 1)->first()['id'];
            $medicalIssues = $this->MedicalIssues->find('list');
            $bloodGroups = $this->Students->getBloodGroups();
            $genotypes = $this->Students->getGenotypes();
            $sponsorRelationships = $this->Students->getSponsorRelations();
            $studentTypes = $this->StudentTypes->find('list');
            $default_student_type = $this->StudentTypes->find()->select('id')->where('default_selection', 1)->first()['id'];
            $this->set(compact('student', 'sessions', 'classes','states', 'religions', 'studentTypes', 'default_student_type',
                'nationalities','medicalIssues', 'bloodGroups', 'genotypes',
                'default_nationality', 'default_religion', 'sponsorRelationships'));
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

