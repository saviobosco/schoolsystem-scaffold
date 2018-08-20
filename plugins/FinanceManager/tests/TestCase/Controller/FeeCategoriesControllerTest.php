<?php
namespace FinanceManager\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use FinanceManager\Controller\FeeCategoriesController;

/**
 * FinanceManager\Controller\FeeCategoriesController Test Case
 */
class FeeCategoriesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.fee_categories',
        'plugin.finance_manager.fees',
        'plugin.finance_manager.sessions',
        'plugin.finance_manager.classes',
        'plugin.finance_manager.terms',
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
                ]
            ]
        ]);
        $this->enableRetainFlashMessages();
        $this->disableErrorHandlerMiddleware();
        $this->enableCsrfToken();
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/finance-manager/fee-categories');
        $this->assertResponseOk();
        $this->assertResponseContains('School Fees');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/finance-manager/fee-categories/view/1');
        $this->assertResponseOk();
        $this->assertResponseContains('School Fees');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $postData = [
            'type' => 'Administrative Fees',
            'description' => 'admin'
        ];
        $this->post('/finance-manager/fee-categories/add', $postData);
        $this->assertRedirect('/finance-manager/fee-categories');
        $this->assertSession('The fee category has been saved.', 'Flash.flash.0.message');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $postData = [
            'type' => 'Admin 2',
            'description' => 'admin'
        ];
        $this->post('/finance-manager/fee-categories/edit/1', $postData);
        $this->assertRedirect('/finance-manager/fee-categories');
        $this->assertSession('The fee category has been saved.', 'Flash.flash.0.message');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->delete('/finance-manager/fee-categories/delete/3');
        $this->assertRedirect('/finance-manager/fee-categories');
        $this->assertSession('The fee category has been deleted.', 'Flash.flash.0.message');
    }

    public function testDeleteFailed()
    {
        $this->delete('/finance-manager/fee-categories/delete/3');
        $this->assertRedirect('/finance-manager/fee-categories');
        $this->assertSession('The fee category has been deleted.', 'Flash.flash.0.message');
    }
}
