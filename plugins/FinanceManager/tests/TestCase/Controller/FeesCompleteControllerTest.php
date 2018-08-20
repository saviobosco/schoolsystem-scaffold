<?php
namespace FinanceManager\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use FinanceManager\Controller\FeesCompleteController;

/**
 * FinanceManager\Controller\FeesCompleteController Test Case
 */
class FeesCompleteControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.fees',
        'plugin.finance_manager.student_fee_payments',
        'plugin.finance_manager.sessions',
        'plugin.finance_manager.classes',
        'plugin.finance_manager.terms',
        'plugin.finance_manager.students',
        'plugin.finance_manager.users',
        'plugin.finance_manager.fee_categories',
        'plugin.finance_manager.student_fees',
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
                ]
            ]
        ]);
        $this->enableRetainFlashMessages();
        $this->disableErrorHandlerMiddleware();
        $this->enableCsrfToken();
    }

    public function testIndex()
    {
        $this->get('finance-manager/fees-complete?session_id=1&class_id=1&term_id=1');
        $this->assertResponseContains('Iwueze');
    }

}
