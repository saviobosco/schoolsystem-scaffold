<?php
namespace FinanceManager\Controller;

use FinanceManager\Controller\AppController;

/**
 * StudentPayments Controller
 *
 * @property \FinanceManager\Model\Table\StudentsTable $Students
 * @property \FinanceManager\Model\Table\StudentFeePaymentsTable $StudentFeePayments
 * @property \FinanceManager\Model\Table\PaymentTypesTable $PaymentTypes
 * @property \FinanceManager\Model\Table\ReceiptsTable $Receipts
 * @property \FinanceManager\Model\Table\PaymentsTable $Payments
 * @property \FinanceManager\Model\Table\TermsTable $Terms
 * @property \FinanceManager\Model\Table\SessionsTable $Sessions
 */
class StudentPaymentsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('FinanceManager.Sessions');
        $this->loadModel('FinanceManager.Students');
        $this->loadModel('FinanceManager.Terms');
        $this->loadModel('FinanceManager.PaymentTypes');
        $this->loadModel('FinanceManager.StudentFeePayments');
    }


    public function payFees()
    {
        if ( $this->request->is(['patch', 'post', 'put'])) {
            $postData = $this->request->getData();
            $postData['payment']['payment_received_by'] = $this->Auth->user('id');
            try {
                $payment = $this->StudentFeePayments->payFees($postData);
                if ( isset($payment['error'])) {
                    $this->Flash->error($payment['error']);
                    return $this->redirect($this->referer());
                }
                return $this->redirect([
                    'action'=>'paymentReceipt',
                    $payment['receipt_id'],
                ]);
            } catch ( \Exception $e ) {
                $this->Flash->error('The following error occurred '.$e->getMessage()) ;
                return $this->redirect($this->referer());
            }
        }
    }

    /**
     * @param null $id
     * PaymentReceipt Action
     * Displays the receipt after payment
     */
    public function paymentReceipt( $id = null )
    {
        // get the receipt information
        $receiptDetails = $this->Students->getReceiptDetails($id);
        //get Student Arrears
        $arrears = $this->Students->getStudentArrears($receiptDetails['student_id']);
        $sessions = $this->Sessions->find('list')->toArray();
        $classes = $this->Students->Classes->find('list')->toArray();
        $terms = $this->Terms->find('list', ['limit' => 200])->toArray();
        $this->set(compact('student','receiptDetails','sessions','classes','terms','arrears'));
    }

    public function studentPaymentRecord($id = null)
    {
        $student = $this->Students->find()
            ->contain(['Classes','StudentFees.Fees.FeeCategories','StudentFees.StudentFeePayments'])
            ->where(['Students.id'=>$id])
            ->enableHydration(false)
            ->first();
        $sessions = $this->Sessions->find('list', ['limit' => 200])->toArray();
        $classes = $this->Students->Classes->find('list', ['limit' => 200])->toArray();
        $terms = $this->Terms->find('list', ['limit' => 200])->toArray();
        $this->set(compact('student','sessions','classes','terms'));
        $this->set('_serialize', ['student']);
    }
}
