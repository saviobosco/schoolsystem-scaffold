<?php
namespace FinanceManager\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;
use FinanceManager\Controller\AppController;

/**
 * StudentFees Controller
 * @property \FinanceManager\Model\Table\StudentsTable $Students
 * @property \FinanceManager\Model\Table\PaymentTypesTable $PaymentTypes
 * @property \FinanceManager\Model\Table\ReceiptsTable $Receipts
 * @property \FinanceManager\Model\Table\TermsTable $Terms
 * @property \FinanceManager\Model\Table\SessionsTable $Sessions
 * @property \FinanceManager\Model\Table\StudentFeesTable $StudentFees
 */
class StudentFeesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('FinanceManager.Students');
        $this->loadModel('FinanceManager.StudentFees');
        $this->loadModel('FinanceManager.Sessions');
        $this->loadModel('FinanceManager.Terms');
        $this->loadModel('FinanceManager.PaymentTypes');
    }

    public function getStudentFees($id = null)
    {
        $getQuery = $this->request->getQuery();
        $student = $this->Students->get($id,[
            'contain' => ['Classes']
        ]);
        $studentFees = $this->Students->getStudentFees($id,$getQuery);
        $sessions = $this->Sessions->find('list', ['limit' => 200])->toArray();
        $classes = $this->Students->Classes->find('list', ['limit' => 200])->toArray();
        $paymentTypes = $this->PaymentTypes->find('list', ['limit' => 200]);
        $terms = $this->Terms->find('list', ['limit' => 200])->toArray();
        $this->set(compact('student','studentFees','sessions','classes','terms','paymentTypes', 'receipts'));
        //$this->render('get_student_fees2');
    }

    public function getStudentBill($id = null)
    {
        $getQuery = $this->request->getQuery();
        try {
            $student = $this->Students->get($id,[
                'contain' => ['Classes']
            ]);
            $studentFees = $this->Students->getStudentFees($id,$getQuery);
            $sessions = $this->Sessions->find('list')->toArray();
            $classes = $this->Students->Classes->find('list')->toArray();
            $terms = $this->Terms->find('list', ['limit' => 200])->toArray();
            $this->set(compact('student','studentFees','sessions','classes','terms','paymentTypes'));
        } catch ( RecordNotFoundException $e) {
            return $this->render('/Element/noRecordFound');
        }
    }

    /**
     * @param null $id
     * @return \Cake\Http\Response
     * This function is used to add a special fee for a student.
     */
    public function add($id = null)
    {
        try {
            $student = $this->Students->get($id,[
                'contain' => ['Classes']
            ]);
            if ( $this->request->is(['patch','put','post'])) {
                $student_fee = $this->StudentFees->newEntity($this->request->getData());
                $student_fee->student_id = $student->id;
                $student_fee->paid = 0;
                if ($this->StudentFees->save($student_fee)) {
                    $this->Flash->success(__('Student Fee was successfully added.'));
                }else {
                    $this->Flash->error(__('Student Fee could not be added.'));
                }
            }
            $feeCategories = $this->StudentFees->Fees->FeeCategories->find('list')->toArray();
            $this->set(compact('student','feeCategories'));
        } catch ( RecordNotFoundException $e) {
            return $this->render('/Element/noRecordFound');
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Student Fee id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        try {
            $studentFee = $this->StudentFees->get($id);
            if ($this->StudentFees->deleteStudentFee($studentFee)) {
                $this->Flash->success(__('The student fee has been deleted.'));
            } else {
                $this->Flash->error(__('The student fee could not be deleted. Please, try again.'));
            }
        } catch ( \PDOException $e ) {
            $this->Flash->error(__($e->getMessage()));
        }
        return $this->redirect($this->request->referer());
    }


    public function processPayment()
    {
        dd($this->request->getData());
    }
}
