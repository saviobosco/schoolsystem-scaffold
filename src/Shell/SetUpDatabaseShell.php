<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Migrations\Migrations;

/**
 * SetUpDatabase shell command.
 */
class SetUpDatabaseShell extends Shell
{

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

    public function initialize()
    {
        parent::initialize();
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        // receives an input value which is the sub domain
        // gets the details from the database
        // creates the details
        // sets up the migrations and seed.
    }

    public function setUp($sub_domain = null)
    {
        if(is_null($sub_domain)) {
            return false;
        }
        if (!$this->getDatabase($sub_domain)) {
            return false;
        }
        try {
            $migrations = new Migrations();
            $this->out('Beginning migration');
            $migrate = $migrations->migrate();
            if ($migrate) {
                $this->out('Successfully migrated files');
                $this->out('Executing seed operation...');
                $migrations->seed();
                $this->out('Successfully ran the seed operation.');
                return true;
            }
        } catch (\Exception $exception) {
            $this->out($exception->getMessage());
            return false;
        }
        return false;
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

    public function migrate($sub_domain)
    {
        if(is_null($sub_domain)) {
            return false;
        }
        if (!$this->getDatabase($sub_domain)) {
            return false;
        }
        try {
            $migrations = new Migrations();
            $this->out('Beginning migration');
            $migrate = $migrations->migrate();
            if ($migrate) {
                $this->out('Successfully migrated files');
                return true;
            }
        } catch (\Exception $exception) {
            $this->out($exception->getMessage());
            return false;
        }
    }
}
