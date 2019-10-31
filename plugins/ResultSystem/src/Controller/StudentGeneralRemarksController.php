<?php
namespace ResultSystem\Controller;

use ResultSystem\Controller\AppController;

/**
 * StudentGeneralRemarks Controller
 *
 * @property \ResultSystem\Model\Table\StudentGeneralRemarksTable $StudentGeneralRemarks
 * @property \ResultSystem\Model\Table\SessionsTable $Sessions
 * @property \ResultSystem\Model\Table\ClassesTable $Classes
 * @property \ResultSystem\Model\Table\TermsTable $Terms
 * @property \ResultSystem\Model\Table\StudentsTable $Students
 * @property \ResultSystem\Model\Table\ResultRemarkInputsTable $ResultRemarkInputs
 */
class StudentGeneralRemarksController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('ResultSystem.Students');
        $this->loadModel('ResultSystem.Classes');
        $this->loadModel('ResultSystem.Sessions');
        $this->loadModel('ResultSystem.Terms');
        $this->loadModel('ResultSystem.ResultRemarkInputs');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $classes = $this->Classes->find('list')->toArray();
        $sessions = $this->Sessions->find('list')->toArray();
        $terms = $this->Terms->find('list')->toArray();
        $this->set(compact('classes', 'sessions', 'terms'));
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $studentGeneralRemark = $this->StudentGeneralRemarks->newEntity();
        if ($this->request->is(['post', 'put'])) {
            $studentGeneralRemark = $this->StudentGeneralRemarks->patchEntity($studentGeneralRemark, $this->request->getData());
            if ($this->StudentGeneralRemarks->save($studentGeneralRemark)) {
                $this->response = $this->response->withStatus(200);
                //$this->Flash->success(__('The student general remark has been saved.'));
            } else {
                $this->response = $this->response->withStatus(500);
                //$this->Flash->error(__('The student general remark could not be saved. Please, try again.'));
            }
        }
    }


    public function getStudents()
    {
        $students = $this->Students->query()
            ->select(['id' => 'id', 'name' => "concat(first_name,' ', last_name)"])
            ->where(['class_id' => $this->request->getQuery('class_id')])
            ->combine('id', 'name')
            ->toArray();
        $this->set(compact('students'));
    }

    public function getGeneralRemarkView()
    {
        $queryData = $this->request->getQuery();
        if (isset($queryData['term_id']) && 4 === (int)$queryData['term_id']) {
            $student = $this->Students->find()
                ->select(['id', 'first_name', 'last_name'])
                ->where(['id' => $queryData['student_id']])
                ->contain([
                    'StudentAnnualResults' => [
                        'fields' => ['first_term', 'second_term', 'third_term', 'average', 'subject_id', 'student_id',
                            'session_id', 'class_id'],
                        'conditions' => [
                            'StudentAnnualResults.session_id' => $queryData['session_id'],
                            'StudentAnnualResults.class_id' => $queryData['class_id'],
                        ],
                        'Subjects' => ['fields' => ['id', 'name']]
                    ],
                ])
                ->first();
        } else {
            $student = $this->Students->find()
                ->select(['id', 'first_name', 'last_name'])
                ->where(['id' => $queryData['student_id']])
                ->contain([
                    'StudentTermlyResults' => [
                        'fields' => ['total', 'grade','subject_id', 'student_id',
                            'session_id', 'class_id', 'term_id'],
                        'conditions' => [
                            'StudentTermlyResults.session_id' => $queryData['session_id'],
                            'StudentTermlyResults.class_id' => $queryData['class_id'],
                            'StudentTermlyResults.term_id' => $queryData['term_id'],
                        ],
                        'Subjects' => ['fields' => ['id', 'name']]
                    ],
                ])
                ->first();
        }

        $remarkInputs = $this->ResultRemarkInputs->getValidRemarkInputs($queryData['session_id']);
        $studentGeneralRemark = $this->Students->StudentGeneralRemarks
            ->query()
            ->where([
                'session_id' => $queryData['session_id'],
                'class_id' => $queryData['class_id'],
                'term_id' => $queryData['term_id'],
                'student_id' => $queryData['student_id'],
            ])->first();
        $this->set(compact('studentResults', 'student', 'studentGeneralRemark', 'remarkInputs'));
    }
}
