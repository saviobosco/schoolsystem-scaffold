<?php
namespace FinanceManager\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use FinanceManager\Controller\PaymentTypesController;

/**
 * FinanceManager\Controller\PaymentTypesController Test Case
 */
class PaymentTypesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.payment_types',
        'plugin.finance_manager.users'
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
        $this->get('/finance-manager/payment-types');
        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/finance-manager/payment-types/view/1');
        $this->assertResponseOk();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $postData = [
            'type' => 'Bank Teller'
        ];
        $this->post('/finance-manager/payment-types/add',$postData);
        $this->assertRedirect(['action'=>'index']);
        $this->assertSession('The payment type has been saved.', 'Flash.flash.0.message');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $postData = [
            'type' => 'Bank Teller'
        ];
        $this->post('/finance-manager/payment-types/edit/1',$postData);
        $this->assertRedirect(['action'=>'index']);
        $this->assertSession('The payment type has been saved.', 'Flash.flash.0.message');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->delete('/finance-manager/payment-types/delete/1');
        $this->assertRedirect(['action'=>'index']);
    }
}
