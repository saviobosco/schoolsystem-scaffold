<?php
namespace FinanceManager\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use FinanceManager\Controller\StudentFeesController;

/**
 * FinanceManager\Controller\StudentFeesController Test Case
 */
class StudentFeesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.student_fees',
        'plugin.finance_manager.students',
        'plugin.finance_manager.classes',
        'plugin.finance_manager.fees',
        'plugin.finance_manager.fee_categories',
        'plugin.finance_manager.student_fee_payments',
        'plugin.finance_manager.receipts',
        'plugin.finance_manager.payments',
        'plugin.finance_manager.payment_types',
        'plugin.finance_manager.users',
        'plugin.finance_manager.incomes',
        'plugin.finance_manager.terms',
        'plugin.finance_manager.sessions',
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

    /**
     * Test getStudentFees method
     *
     * @return void
     */
    public function testGetStudentFees()
    {
        $this->get('/finance-manager/pay-fees/001');
        $this->assertResponseOk();
        $this->assertResponseContains('Omebe');
    }

    /**
     * Test getStudentBill method
     *
     * @return void
     */
    public function testGetStudentBill()
    {
        $this->get('/finance-manager/get-student-bills/001');
        $this->assertResponseOk();
        $this->assertResponseContains('Omebe');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $postData = [
            'fee_category_id' => '1',
            'amount' => '3000',
            'purpose' => 'Damaged the school Bus'
        ];
        $this->post('/finance-manager/student-fees/add/001',$postData);
        $this->assertSession('Student Fee was successfully added.', 'Flash.flash.0.message');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->delete('/finance-manager/student-fees/delete/1');
        $this->assertRedirect();
    }
}
