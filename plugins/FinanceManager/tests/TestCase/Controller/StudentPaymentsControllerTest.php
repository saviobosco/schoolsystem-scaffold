<?php
namespace FinanceManager\Test\TestCase\Controller;

use Cake\Event\EventList;
use Cake\Event\EventManager;
use Cake\TestSuite\IntegrationTestCase;
use FinanceManager\Controller\StudentPaymentsController;
use FinanceManager\Model\Table\StudentFeePaymentsTable;

/**
 * FinanceManager\Controller\StudentPaymentsController Test Case
 */
class StudentPaymentsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.users',
        'plugin.finance_manager.student_fee_payments',
        'plugin.finance_manager.student_fees',
        'plugin.finance_manager.fees',
        'plugin.finance_manager.sessions',
        'plugin.finance_manager.classes',
        'plugin.finance_manager.terms',
        'plugin.finance_manager.payments',
        'plugin.finance_manager.payment_types',
        'plugin.finance_manager.receipts',
        'plugin.finance_manager.students',
        'plugin.finance_manager.incomes',
        'plugin.finance_manager.fee_categories',
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
        EventManager::instance()->setEventList(new EventList());
        $this->disableErrorHandlerMiddleware();
        $this->enableCsrfToken();
        $this->enableRetainFlashMessages();
    }

    /**
     * Test payFees method
     *
     * @return void
     */
    public function testPayFees()
    {
        $postData = [
            'student_id' => '1005',
            'student_fees' => [
                (int) 0 => [
                    'amount_to_pay' => '25000',
                    'fee_id' => '1',
                    'fee_category_id' => '1',
                    'amount_paid' => '25000',
                    'student_fee_id' => '1'
                ],
                (int) 1 => [
                    'amount_to_pay' => '2000',
                    'fee_id' => '',
                    'fee_category_id' => '2',
                    'amount_paid' => '1000',
                    'student_fee_id' => '2'
                ]
            ],
            'payment' => [
                'payment_made_by' => 'student',
                'payment_type_id' => '1',
            ],
            'generate_receipt' => 'two'
        ];
        $this->post('/finance-manager/pay-fees/1000',$postData);
        $this->assertRedirect('/finance-manager/payment-receipt/2');
        $this->assertEventFired(StudentFeePaymentsTable::EVENT_AFTER_EACH_FEE_PAYMENT, EventManager::instance());
        $this->assertEventFired(StudentFeePaymentsTable::EVENT_AFTER_FEES_PAYMENT, EventManager::instance());
    }

    /**
     * Test paymentReceipt method
     *
     * @return void
     */
    public function testPaymentReceipt()
    {
        $this->get('/finance-manager/payment-receipt/1');
        $this->assertResponseOk();
    }

    /**
     * Test studentPaymentRecord method
     *
     * @return void
     */
    public function testStudentPaymentRecord()
    {
        $this->get('/finance-manager/payment-records/1000');
        $this->assertResponseOk();
        $this->assertResponseContains('Omebe');
    }
}
