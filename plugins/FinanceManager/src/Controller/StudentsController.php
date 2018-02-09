<?php
namespace FinanceManager\Controller;

use FinanceManager\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * Students Controller
 *
 * @property \FinanceManager\Model\Table\StudentsTable $Students
 * @property \FinanceManager\Model\Table\StudentFeePaymentsTable $StudentFeePayments
 * @property \FinanceManager\Model\Table\PaymentTypesTable $PaymentTypes
 * @property \FinanceManager\Model\Table\ReceiptsTable $Receipts
 * @property \FinanceManager\Model\Table\PaymentsTable $Payments
 * @property \FinanceManager\Model\Table\TermsTable $Terms
 * @property \FinanceManager\Model\Table\SessionsTable $Sessions
 *
 * @method \FinanceManager\Model\Entity\Student[] paginate($object = null, array $settings = [])
 */
class StudentsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('FinanceManager.Sessions');
        $this->loadModel('FinanceManager.Terms');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
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
        $classes = $this->Students->Classes->find('list',['limit' => 200]);
        $this->set(compact('students','sessions','classes'));
        $this->set('_serialize', ['students']);
    }

    public function unActiveStudents()
    {
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
        if ( !empty($this->request->getQuery('class_id'))) {
            $this->paginate = array_merge_recursive($this->paginate,[
                'conditions' => [
                    'Students.class_id' => $this->request->getQuery('class_id')
                ]
            ]);
        }
        $students = $this->paginate($this->Students);
        $classes = $this->Students->Classes->find('list',['limit' => 200]);
        $this->set(compact('students','sessions','classes'));
        $this->set('_serialize', ['students']);
    }

    /**
     * View method
     *
     * @param string|null $id Student id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        try {
            $student = $this->Students->find()
                ->contain(['Classes'])
                ->where(['Students.id'=>$id])
                ->first();
            $studentFees = $this->Students->getStudentFees($id);
            $sessions = $this->Sessions->find('list', ['limit' => 200])->toArray();
            $classes = $this->Students->Classes->find('list', ['limit' => 200])->toArray();
            $terms = $this->Terms->find('list', ['limit' => 200])->toArray();
            $this->set(compact('student','studentFees','sessions','classes','terms'));
            $this->set('_serialize', ['student']);
        } catch ( RecordNotFoundException $e ) {
            $this->render('/Element/noRecordFound');
        }

    }

    public function getStudentByAjax()
    {
        if ( $this->request->is('ajax') ) {
            $student_id = $this->request->getQuery('id');
            $students = $this->Students->getStudentsWithId($student_id);
            $this->set('students',$students);
            $this->render('/Element/get_student_ajax_return','ajax');
        }
    }

    // this is an ajax function
    public function getStudentsCountByClassId()
    {
        if ( $this->request->is('ajax')) {
            $queryData = $this->request->getQuery();
            if (0 === (int)$queryData['class_id']) {
                $students = $this->Students->find('all')->where(['status'=>1]);
            }else {
                $students = $this->Students->find('all')->where(['class_id'=>$queryData['class_id'],'status'=>1]);
            }
            $this->response->body($students->count());
            return $this->response;
        }
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