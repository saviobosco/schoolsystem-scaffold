<?php
namespace FinanceManager\Controller;

use FinanceManager\Controller\AppController;

/**
 * FeesStatistics Controller
 * @property \FinanceManager\Model\Table\FeesTable $Fees
 *
 */
class FeesStatisticsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('FinanceManager.Fees');
    }
    public function index( )
    {
        $this->paginate = [
            'contain' => ['FeeCategories', 'Terms', 'Classes', 'Sessions']
        ];
        $fees = $this->paginate($this->Fees);
        $feeCategories = $this->Fees->FeeCategories->find('list', ['limit' => 200]);
        $terms = $this->Fees->Terms->find('list', ['limit' => 200]);
        $classes = $this->Fees->Classes->find('list', ['limit' => 200]);
        $sessions = $this->Fees->Sessions->find('list', ['limit' => 200]);
        $this->set(compact('fees','feeCategories','terms','classes','sessions'));
        $this->set('_serialize', ['fees']);
    }

    public function view( $id = null )
    {
        $fee = $this->Fees->get($id, [
            'contain' => ['FeeCategories', 'Terms', 'Classes', 'Sessions', 'StudentFees']
        ]);
        $this->set('fee', $fee);
        $this->set('_serialize', ['fee']);
    }

    public function query()
    {
        $getQuery = $this->request->getQuery();
        $fees = $this->Fees->queryFeesTable($getQuery);
        $feeCategories = $this->Fees->getFeeCategoriesData();
        $terms = $this->Fees->Terms->find('list')->toArray();
        $classes = $this->Fees->Classes->find('list')->toArray();
        $sessions = $this->Fees->Sessions->find('list')->toArray();
        $this->set(compact('fees','terms','classes','sessions','feeCategories'));
    }

}
