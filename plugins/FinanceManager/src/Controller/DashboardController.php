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
            if (empty($postData)) {
                $this->set('message','Please Select an input value');
                $this->render('/Element/incomeStatistics/error','ajax');
                return;
            }
            try {
                if ($postData['query'] === 'custom') {
                    $startDate = new Date($postData['start_date']);
                    $endDate = new Date($postData['end_date']);
                    $incomes = $this->Incomes->getIncomeWithDateRange($startDate,$endDate);
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
                        $this->render('/Element/incomeStatistics/no_value','ajax');
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
                    $endDate = new Date($postData['end_date']);
                    if ($postData['arrange_by_expenditure_categories'] == 1) {
                        $expenditures = $this->Expenditures->getExpenditureWithDateRangeArrangedByExpenditureCat($startDate,$endDate);
                        $expenditureTypes = $this->Expenditures->ExpenditureCategories->find('list')->toArray();
                    } else {
                        $expenditures = $this->Expenditures->getExpenditureWithDateRange($startDate,$endDate);
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
            $this->set(compact('expenditures','startDate','endDate','expenditureTypes'));
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

    public function settings()
    {
        //Setting::write('Application.school_motto', '');

        $dir = new Folder(WWW_ROOT.'img');
        $file = $dir->find('image-banner.png', true);

        $this->loadModel('Settings.Configurations');
        $this->prefixes = Configure::read('Settings.Prefixes');

        $key = 'Application';

        //$prefix = Hash::get($this->prefixes, ucfirst($key));
        $settings = $this->Configurations->find('all')->where([
            'name LIKE' => $key . '%',
            'editable' => 1,
        ])->order(['weight', 'id']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $settings = $this->Configurations->patchEntities($settings, $this->request->data);

            foreach ($settings as $setting) {
                //$this->Flash->success('The settings has been saved.');
                if (!$this->Configurations->save($setting)) {
                    $this->Flash->error('The settings could not be saved. Please, try again.');
                }
            }
            $this->Flash->success('The settings has been saved.');
            Setting::clear(true);
            Setting::autoLoad();
            //return $this->redirect([]);
        }
        $this->set(compact('prefix', 'settings','file'));

    }

    public function about()
    {

    }

    public function help()
    {

    }


    public function uploadBannerImage()
    {
        try {
            if ( $this->request->is(['patch', 'post', 'put'])) {
                // check if upload
                //debug($this->request->data); exit;
                if (empty($this->request->getData('banner')['name'])) {
                    $this->Flash->error(__('No file selected.'));
                    return $this->redirect($this->request->referer());
                }
                $imageDetails = pathinfo($this->request->getData('banner')['name']);

                if ($imageDetails['extension'] !== 'png') {
                    $this->Flash->error(__('Image must be a .png file .'));
                    return $this->redirect($this->request->referer());
                }
                // check if folder is writable
                //if ( (new Folder(WWW_ROOT.'img')))
                $file = new File(WWW_ROOT.'img/image-banner.png');
                if ( $file->exists() ) {
                    $file->delete();
                }
                if ( move_uploaded_file($this->request->getData('banner')['tmp_name'], WWW_ROOT.'img/image-banner.png') ) {
                    $this->Flash->success(__('File was successfully uploaded'));
                    return $this->redirect(['action'=>'settings']);
                } else {
                    $this->Flash->error(__('An Error occurred uploading this image. Please try again.'));
                    return $this->redirect(['action'=>'settings']);
                }
            }

        } catch (\Exception $e ) {
            $this->Flash->success(__('An Error occurred uploading this image. Please try again.'));
            return $this->redirect(['action'=>'settings']);
        }
    }

    public function registerApplication()
    {

    }
}