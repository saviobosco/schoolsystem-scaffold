<?php
namespace FinanceManager\Controller;

use FinanceManager\Controller\AppController;

/**
 * FeesDefaulters Controller
 * @property \FinanceManager\Model\Table\FeesTable $Fees
 *
 */
class FeesDefaultersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('FinanceManager.Fees');
    }

    public function index()
    {
        $getQuery = $this->request->getQuery();
        $feeDefaulters = null;
        if ( isset($getQuery['session_id']) OR isset($getQuery['class_id']) OR isset($getQuery['term_id']) ) {
            $feeDefaulters = $this->Fees->getFeeDefaulters($getQuery);
            $students = $this->Fees->getStudentsData();
        }
        $compulsoryFees = $this->Fees->getCompulsoryFeesByParameters($getQuery);

        $terms = $this->Fees->Terms->find('list')->toArray();
        $classes = $this->Fees->Classes->find('list')->toArray();
        $sessions = $this->Fees->Sessions->find('list')->toArray();
        $this->set(compact('feeDefaulters','terms','classes','sessions','students','compulsoryFees'));
    }

    public  function view($id = null )
    {
        $fee = $this->Fees->getFeeDefaultersByFeeId($id);
        $this->set('fee', $fee);
        $this->set('_serialize', ['fee']);
    }
}
