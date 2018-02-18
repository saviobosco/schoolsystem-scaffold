<?php
namespace FinanceManager\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use FinanceManager\Controller\FeesStatisticsController;

/**
 * FinanceManager\Controller\FeesStatisticsController Test Case
 */
class FeesStatisticsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.fees',
        'plugin.finance_manager.student_fees',
        'plugin.finance_manager.sessions',
        'plugin.finance_manager.terms',
        'plugin.finance_manager.classes',
        'plugin.finance_manager.fee_categories',
        'plugin.finance_manager.users',
    ];

    public function setUp()
    {
        parent::setUp();
        // Set session data
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 'f8b668c2-0de6-4561-9018-f0199c9e8525',
                    'username' => 'testing',
                    'role' => 'superuser',
                    'super_user' => 1
                    // other keys.
                ]
            ]
        ]);
        $this->enableRetainFlashMessages();
        $this->disableErrorHandlerMiddleware();
        $this->enableCsrfToken();
        $this->enableRetainFlashMessages();
    }

    public function testIndex()
    {
        $this->get('/finance-manager/fees-statistics');
        $this->assertResponseOk();
    }

    public function testView()
    {
        $this->get('/finance-manager/fee-stat/1');
        $this->assertResponseOk();
    }

    public function testQuery()
    {
        $this->get('/finance-manager/fees-query?session_id=&class_id=&term_id=');
        $this->assertResponseOk();
    }

}
