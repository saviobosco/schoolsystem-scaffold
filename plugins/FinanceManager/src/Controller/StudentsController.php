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
        $this->loadModel('Sessions');
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
        $getData = $this->request->getQuery();
        try {
            $student = $this->Students->find()
                ->contain(['Classes','StudentFees.Fees.FeeCategories','StudentFees.StudentFeePayments'])
                ->where(['Students.id'=>$getData['student_id']])
                ->first();
            $sessions = $this->Sessions->find('list', ['limit' => 200])->toArray();
            $classes = $this->Students->Classes->find('list', ['limit' => 200])->toArray();
            $this->loadModel('Terms');
            $terms = $this->Terms->find('list', ['limit' => 200])->toArray();
            $this->set(compact('student','sessions','classes','terms'));
            $this->set('_serialize', ['student']);

        } catch ( RecordNotFoundException $e ) {
            $this->render('/Element/noRecordFound');
        }

    }

    /**
     * @param null $id
     * @return \Cake\Http\Response|null
     * The student activation action handler
     */
    public function activate($id = null)
    {
        $this->request->allowMethod(['post', 'patch','put']);
        $student = $this->Students->get($id);
        $student->status= 1;
        if ($this->Students->save($student)) {
            $this->Flash->success(__('The student has been activated.'));
        } else {
            $this->Flash->error(__('The student could not be activated. Please, try again.'));
        }

        return $this->redirect($this->request->referer());
    }


    public function getStudentFees()
    {
        $getQuery = $this->request->getQuery();
        if (!array_key_exists('student_id',$getQuery) || empty($getQuery['student_id'])) {
            return $this->render('/Element/noRecordFound');
        }

        $student = $this->Students->get($getQuery['student_id'],[
            'contain' => ['Classes']
        ]);

        if ( isset($getQuery['term_id']) OR isset($getQuery['class_id']) OR isset($getQuery['session_id'])) {
            $studentFees = $this->Students->getStudentFeesWithTermClassSession($getQuery['student_id'],$getQuery['term_id'],$getQuery['class_id'],$getQuery['session_id']);
        } else {
            $studentFees = $this->Students->getStudentFees($getQuery['student_id']);
        }

        $sessions = $this->Sessions->find('list', ['limit' => 200])->toArray();
        $classes = $this->Students->Classes->find('list', ['limit' => 200])->toArray();
        $this->loadModel('FinanceManager.Terms');
        $this->loadModel('FinanceManager.PaymentTypes');
        $paymentTypes = $this->PaymentTypes->find('list', ['limit' => 200]);
        $terms = $this->Terms->find('list', ['limit' => 200])->toArray();
        $this->set(compact('student','studentFees','sessions','classes','terms','paymentTypes'));
    }


    public function payFees()
    {
        if ( $this->request->is(['patch', 'post', 'put'])) {
            try {
                //debug($this->request->getData()); exit;
                $this->loadModel('FinanceManager.StudentFeePayments');

                $postData = $this->request->getData();

                $newStudentFeeEntities = $this->StudentFeePayments->newEntities($postData['student_fees']);

                // Process data and get total amount paid
                $studentPaymentDetails = $this->StudentFeePayments->processPaymentData($newStudentFeeEntities);
                if ( empty($studentPaymentDetails['paymentData']) ) {
                    $this->Flash->error(__('No payment amount was entered for payment'));
                    return $this->redirect($this->referer());
                }

                // generate receipt
                $this->loadModel('FinanceManager.Receipts');
                $receiptDetail = $this->Receipts->generateReceipt($postData['student_id'],$studentPaymentDetails['total']);
                // generate and save payment records
                $postData['payment']['receipt_id'] = $receiptDetail->id;
                $postData['payment']['payment_received_by'] = $this->Auth->user('id');
                if (!$this->StudentFeePayments->savePayment($studentPaymentDetails['paymentData'],$receiptDetail,$postData['payment'])) {
                    $this->Flash->error(__('Could not save the payment details please try again.'));
                    // revert the receipt generated
                    return $this->redirect($this->referer());
                }
                return $this->redirect([
                    'plugin'=>'FinanceManager',
                    'controller'=>'Students',
                    'action'=>'paymentReceipt',
                    '?' => [
                        'receipt_id' => $receiptDetail->id,
                    ]
                ]);
            } catch ( \Exception $e ) {
                $this->Flash->error('The following error occurred '.$e->getMessage()) ;
                return $this->redirect($this->referer());
            }

        }
    }


    /**
     * PaymentReceipt Action
     * Displays the receipt after payment
     */
    public function paymentReceipt( )
    {
        //get the student information
        $passedData = $this->request->getQuery();
        // get the receipt information
        $receiptDetails = $this->Students->getReceiptDetails($passedData['receipt_id']);

        $student = $this->Students->get($receiptDetails->student_id,[
            'contain' => ['Classes']
        ]);
        //get Student Arrears
        $arrears = $this->Students->getStudentArrears($receiptDetails->student_id);

        $sessions = $this->Sessions->find('list')->toArray();
        $classes = $this->Students->Classes->find('list')->toArray();
        $this->loadModel('FinanceManager.Terms');
        $terms = $this->Terms->find('list', ['limit' => 200])->toArray();
        $this->set(compact('student','receiptDetails','sessions','classes','terms','arrears'));
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

    public function getStudentBill()
    {
        $getQuery = $this->request->getQuery();
        if (!array_key_exists('student_id',$getQuery) || empty($getQuery['student_id'])) {
            return $this->render('/Element/noRecordFound');
        }

        $student = $this->Students->get($getQuery['student_id'],[
            'contain' => ['Classes']
        ]);

        if ( isset($getQuery['term_id']) OR isset($getQuery['class_id']) OR isset($getQuery['session_id'])) {
            $studentFees = $this->Students->getStudentFeesWithTermClassSession($getQuery['student_id'],$getQuery['term_id'],$getQuery['class_id'],$getQuery['session_id']);
        } else {
            $studentFees = $this->Students->getStudentFees($getQuery['student_id']);
        }

        $sessions = $this->Sessions->find('list')->toArray();
        $classes = $this->Students->Classes->find('list')->toArray();
        $this->loadModel('Terms');
        $this->loadModel('PaymentTypes');
        $this->loadModel('Banks');
        $paymentTypes = $this->PaymentTypes->find('list', ['limit' => 200]);
        $terms = $this->Terms->find('list', ['limit' => 200])->toArray();
        $this->set(compact('student','studentFees','sessions','classes','terms','paymentTypes'));
    }

    // this is an ajax function
    public function getStudentsCountByClassId()
    {
        if ( $this->request->is('ajax') ) {
            $class_id = $this->request->getQuery('class_id');
            $students = $this->Students->find('all')->where(['class_id'=>$class_id,'status'=>1]);
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

    public function studentPaymentRecord()
    {
        $getData = $this->request->getQuery();
        try {
            $student = $this->Students->find()
                ->contain(['Classes','StudentFees.Fees.FeeCategories','StudentFees.StudentFeePayments'])
                ->where(['Students.id'=>$getData['student_id']])
                ->first();


            $sessions = $this->Sessions->find('list', ['limit' => 200])->toArray();
            $classes = $this->Students->Classes->find('list', ['limit' => 200])->toArray();
            $this->loadModel('Terms');
            $terms = $this->Terms->find('list', ['limit' => 200])->toArray();
            $this->set(compact('student','sessions','classes','terms'));
            $this->set('_serialize', ['student']);

        } catch ( RecordNotFoundException $e ) {
            $this->render('/Element/noRecordFound');
        }
    }
}