<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 1/31/18
 * Time: 12:57 PM
 */

namespace App\Middleware;


use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Settings\Core\Setting;
use Zend\Diactoros\Response\RedirectResponse;
use Cake\Routing\Router;
use Cake\Core\Plugin;

class MultiTenancyMiddleware
{
    public function __invoke(ServerRequestInterface $request,ResponseInterface $response, $next)
    {
        // check if request has subdomain
        $subDomain = $request->subdomains();
        if (count($subDomain) >= 1 && strtolower($subDomain[0]) !== 'www' ) { // check if sub domain is not in the array
            $schoolAccountDetail = $this->getSchoolAccountDetails($subDomain[0]);
            if ( $schoolAccountDetail) {
                $dataSource = [
                    'default' => [
                        'className' => 'Cake\Database\Connection',
                        'driver' => 'Cake\Database\Driver\Mysql',
                        'persistent' => false,
                        'host' => $schoolAccountDetail['database_host'],
                        //'port' => 'non_standard_port_number',
                        'username' => $schoolAccountDetail['database_username'],
                        'password' => $schoolAccountDetail['database_password'],
                        'database' => $schoolAccountDetail['database_name'],
                        'encoding' => 'utf8',
                        'timezone' => 'UTC',
                        'flags' => [],
                        'cacheMetadata' => true,
                        'log' => false,
                        'quoteIdentifiers' => false,
                        'url' => env('DATABASE_URL', null),
                    ]
                ];
                ConnectionManager::drop('default');
                ConnectionManager::setConfig($dataSource);
                try {
                    // test if database exists and take account now.

                } catch (\PDOException $pdoException) {

                }
                // setup up config
                Configure::write('sub_domain',$schoolAccountDetail['sub_domain']);
                if (Setting::read('Account_Type_Settings.allow_student_account')) {
                    Plugin::load('StudentAccount', ['bootstrap' => false, 'routes' => true]);
                }
            }
        }
        return $next($request,$response);
    }

    /**
     * @param $subDomain
     * @return mixed
     * This function is used to get the sub domain details
     * the details is first checked in the cache, if found returned else
     * get from database and return
     * Todo : improve , Not to save null values in the database.
     */
    public function getSchoolAccountDetails($subDomain)
    {
        return Cache::remember($subDomain, function () use ($subDomain) {
            $schoolAccountsTable = TableRegistry::get('SchoolAccounts');
            // check if sub domain exists
            $schoolAccountDetails = $schoolAccountsTable->find('all')
                ->where(['sub_domain'=>$subDomain])
                ->enableHydration(false)
                ->first();
            return $schoolAccountDetails;
        });
    }
}