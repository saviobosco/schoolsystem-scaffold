<?php
namespace FinanceManager\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use FinanceManager\Controller\ReceiptsController;

/**
 * FinanceManager\Controller\ReceiptsController Test Case
 */
class ReceiptsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.receipts',
        'plugin.finance_manager.users',
        'plugin.finance_manager.students',
        'plugin.finance_manager.student_fee_payments',
        'plugin.finance_manager.student_fees',
        'plugin.finance_manager.fees',
        'plugin.finance_manager.fee_categories',
        'plugin.finance_manager.payments',
        'plugin.finance_manager.payment_types',
        'plugin.finance_manager.classes',
        'plugin.finance_manager.sessions',
        'plugin.finance_manager.terms',
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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/finance-manager/receipts');
        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/finance-manager/receipts/view/1');
        $this->assertResponseOk();
        $this->assertResponseContains('20,000.00');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $postData = [
            'student_id' => '1000',
            'payment' => [
                'payment_made_by' => 'Mr. Parent',
                'payment_type_id' => '1'
            ]
        ];
        $this->post('/finance-manager/receipts/edit/1',$postData);
        $this->assertRedirect(['action'=>'index']);
        $this->assertSession('The receipt has been saved.', 'Flash.flash.0.message');

    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->delete('/finance-manager/receipts/delete/1');
        $this->assertRedirect();
    }
}
