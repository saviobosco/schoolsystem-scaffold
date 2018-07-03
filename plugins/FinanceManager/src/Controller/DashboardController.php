<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 10/21/17
 * Time: 1:31 PM
 */

namespace FinanceManager\Controller;
use Cake\Core\Configure;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\Utility\Hash;
use Settings\Core\Setting;

/**
 * Class DashboardController
 * @package App\Controller
 *
 * @property \FinanceManager\Model\Table\IncomesTable $Incomes
 * @property \FinanceManager\Model\Table\ExpendituresTable $Expenditures
 * @property \FinanceManager\Model\Table\FeeCategoriesTable $FeeCategories
 * @property \Settings\Model\Table\ConfigurationsTable $Configurations
 */

class DashboardController extends AppController
{
    public function index()
    {

        // get fee income ordered by fee category
        $this->loadModel('FinanceManager.FeeCategories');
        $incomeSources = $this->FeeCategories->find('IncomeByFeeCategories');

        $this->set(compact('incomeSources'));
    }

    public function incomeStatistics()
    {

    }


    public function ajaxGetIncomeStatistics()
    {
        // load the income Table
        $this->loadModel('FinanceManager.Incomes');

        if ( $this->request->is('ajax')) {
            $postData = $this->request->getData();
            if (empty($postData['query'])) {
                $this->set('message','Please Select an input value');
                $this->render('/Element/incomeStatistics/error','ajax');
                return;
            }
            try {
                if ($postData['query'] === 'custom') {
                    $startDate = new Date($postData['start_date']);
                    $endDate = new Time($postData['end_date']);
                    $incomes = $this->Incomes->getIncomeWithDateRange($startDate,$endDate->addHours(23)->addMinutes(59));
                    if ( $postData['contain_fee_categories'] == 1 ) {
                        $this->loadModel('FinanceManager.FeeCategories');
                        $feeCategoriesIncome = $this->FeeCategories->getIncomeByFeeCategoriesWithDateRange($startDate,$endDate);
                    }
                } else {
                    $incomes = $this->Incomes->getIncomeWithPassedValue($postData);
                    if ( $postData['contain_fee_categories'] == 1 ) {
                        $this->loadModel('FinanceManager.FeeCategories');
                        $feeCategoriesIncome = $this->FeeCategories->getIncomeByFeeCategories($postData);
                    }
                }
                $this->set(compact('incomes','startDate','endDate','feeCategoriesIncome'));
                switch($postData['query']) {
                    case 'week':
                        $this->render('/Element/incomeStatistics/ajax_return_for_week','ajax');
                        break;
                    case 'month':
                        $this->render('/Element/incomeStatistics/ajax_return_for_month','ajax');
                        break;
                    case 'year':
                        $this->render('/Element/incomeStatistics/ajax_return_for_year','ajax');
                        break;
                    case 'custom':
                        $this->render('/Element/incomeStatistics/ajax_return_for_custom','ajax');
                        break;
                    default:
                        $this->set('message',__('An Error Occurred. The system can not complete your request.'));
                        $this->render('/Element/incomeStatistics/error','ajax');
                }
            } catch ( \PDOException $e ) {
                if (strpos($e->getMessage(),'General error: 1 no such function:') ) {
                    $this->set('message',__('This application version does not support this operation'));
                    $this->render('/Element/incomeStatistics/error','ajax');
                    return;
                }
            }
        }

    }

    public function expenditureStatistics()
    {

    }

    public function ajaxGetExpenditureStatistics()
    {
        // load the income Table
        $this->loadModel('FinanceManager.Expenditures');

        if ( $this->request->is('ajax')) {
            $postData = $this->request->getData();
            if (empty($postData)) {
                $this->set('message','Please Select an input value');
                $this->render('/Element/expenditureStatistics/error','ajax');
                return;
            }
            try {
                if ($postData['query'] === 'custom') {
                    $startDate = new Date($postData['start_date']);
                    $endDate = new Time($postData['end_date']);
                    $this->set(compact('startDate','endDate'));
                    if ($postData['arrange_by_expenditure_categories'] == 1) {
                        $expenditures = $this->Expenditures->getExpenditureWithDateRangeArrangedByExpenditureCat($startDate,$endDate->addHours(23)->addMinutes(59));
                        $expenditureTypes = $this->Expenditures->ExpenditureCategories->find('list')->toArray();
                    } else {
                        $expenditures = $this->Expenditures->getExpenditureWithDateRange($startDate,$endDate
                        );
                    }
                } else {
                    if ( $postData['arrange_by_expenditure_categories'] == 1) {
                        $expenditures = $this->Expenditures->getExpenditureWithPassedValueArrangedByExpenditureCat($postData);
                        $expenditureTypes = $this->Expenditures->ExpenditureCategories->find('list')->toArray();
                    } else {
                        $expenditures = $this->Expenditures->getExpenditureWithPassedValue($postData);
                    }
                }
            } catch ( \PDOException $e ) {
                if (strpos($e->getMessage(),'General error: 1 no such function:') ) {
                    $this->set('message',__('This application version does not support this operation'));
                    $this->render('/Element/expenditureStatistics/error','ajax');
                    return;
                }
            }
            $this->set(compact('expenditures','expenditureTypes'));
            switch($postData['query']) {
                case 'week':
                    $this->render('/Element/expenditureStatistics/ajax_return_for_week','ajax');
                    break;
                case 'month':
                    $this->render('/Element/expenditureStatistics/ajax_return_for_month','ajax');
                    break;
                case 'year':
                    $this->render('/Element/expenditureStatistics/ajax_return_for_year','ajax');
                    break;
                case 'custom':
                    $this->render('/Element/expenditureStatistics/ajax_return_for_custom','ajax');
                    break;
                default:
                    $this->render('/Element/expenditureStatistics/no_value','ajax');
            }
        }

    }

    public function home()
    {

    }
}