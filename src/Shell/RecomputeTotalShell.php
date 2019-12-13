<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use GradingSystem\Model\Entity\GradeableTrait;
use Cake\Datasource\ConnectionManager;

/**
 * RecomputeTotal shell command.
 */
class RecomputeTotalShell extends Shell
{
    use GradeableTrait;
    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {

    }

    private function getDatabase($name)
    {
        $schoolAccountDetail = $this->getSchoolAccountDetails($name);
        if (!$schoolAccountDetail) {
            return false;
        }
        $dataSource = [
            'default' => [
                'className' => 'Cake\Database\Connection',
                'driver' => 'Cake\Database\Driver\Mysql',
                'persistent' => false,
                'host' => $schoolAccountDetail['database_host'],
                'username' => $schoolAccountDetail['database_username'],
                'password' => $schoolAccountDetail['database_password'],
                'database' => $schoolAccountDetail['database_name'],
                'encoding' => 'utf8',
                'timezone' => 'UTC',
                'cacheMetadata' => true,
                'log' => false,
                'quoteIdentifiers' => false,
            ]
        ];
        ConnectionManager::drop('default');
        ConnectionManager::setConfig($dataSource);
        return true;
    }


    private function getSchoolAccountDetails($subDomain)
    {
        $schoolAccountsTable = TableRegistry::get('SchoolAccounts');
        // check if sub domain exists
        return $schoolAccountsTable->find('all')
            ->where(['sub_domain'=>$subDomain])
            ->enableHydration(false)
            ->first();
    }



    public function computeTotal($sub_domain, $session_id)
    {
        if(is_null($sub_domain)) {
            $this->out('Sub domain is required');
            return false;
        }
        if (is_null($session_id)) {
            $this->out('Missing required parameter session id');
            return false;
        }

        if (!$this->getDatabase($sub_domain)) {
            return false;
        }
        $resultGradingTable = TableRegistry::get('GradingSystem.ResultGradingSystems');
        $studentTermlyResultsTable = TableRegistry::get('ResultSystem.StudentTermlyResults');
        $resultGradeInputsTable = TableRegistry::get('ResultSystem.ResultGradeInputs');
        $gradeInputs = $resultGradeInputsTable->getValidGradeInputs($resultGradeInputsTable->getResultGradeInputs($session_id));

        $studentTermlyResults = $studentTermlyResultsTable->query()
            ->where(['session_id' => $session_id])
            ->all();

        foreach($studentTermlyResults as $studentTermlyResult) {
            $total = 0;
            foreach($gradeInputs as $gradeKey => $gradeValue){
                $total += (float)$studentTermlyResult->{$gradeKey};
            }
            $studentTermlyResult->total = $total;

            // gets the grade from the table
            $resultGradingTableQuery = $resultGradingTable->find('all')->all();

            $grades = $resultGradingTableQuery->combine('score','grade')->toArray();
            if (!empty($grades)) {
                $studentTermlyResult->grade = $this->calculateGrade($studentTermlyResult->total,$grades); // if null notify the admin of the issue;
                $remarks = $resultGradingTableQuery->combine('grade','remark')->toArray();
                $studentTermlyResult->remark = isset($remarks[$studentTermlyResult->grade]) ? $remarks[$studentTermlyResult->grade] : null;
            }

            $studentTermlyResultsTable->save($studentTermlyResult);
        }

    }
}
