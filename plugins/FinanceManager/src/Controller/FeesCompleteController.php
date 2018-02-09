<?php
namespace FinanceManager\Controller;

use FinanceManager\Controller\AppController;

/**
 * FeesComplete Controller
 * @property \FinanceManager\Model\Table\FeesTable $Fees
 */
class FeesCompleteController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('FinanceManager.Fees');
    }

    public function view($id = null )
    {
        $fee = $this->Fees->getFeeCompleteStudentsByFeeId($id);
        $this->set('fee', $fee);
        $this->set('_serialize', ['fee']);
    }

    public function index()
    {
        $getQuery = $this->request->getQuery();
        $feeCompleteStudents = null;
        $compulsoryFees = null;
        if ( isset($getQuery['session_id']) OR isset($getQuery['class_id']) OR isset($getQuery['term_id']) ) {
            $feeCompleteStudents = $this->Fees->getStudentWithCompleteFees($getQuery);
            $students = $this->Fees->getStudentsData();
            $compulsoryFees = $this->Fees->getCompulsoryFeesByParameters($getQuery);
        }
        $terms = $this->Fees->Terms->find('list')->toArray();
        $classes = $this->Fees->Classes->find('list')->toArray();
        $sessions = $this->Fees->Sessions->find('list')->toArray();
        $this->set(compact('feeCompleteStudents','terms','classes','sessions','students','compulsoryFees'));
    }
}
