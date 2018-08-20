<?php
namespace FinanceManager\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use FinanceManager\Controller\ExpenditureCategoriesController;

/**
 * FinanceManager\Controller\ExpenditureCategoriesController Test Case
 */
class ExpenditureCategoriesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.expenditure_categories',
        'plugin.finance_manager.expenditures',
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
        $this->get('/finance-manager/expenditure-categories');
        $this->assertResponseOk();
        $this->assertResponseContains('Feeding');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/finance-manager/expenditure-categories/view/1');
        $this->assertResponseOk();
        $this->assertResponseContains('Feeding');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $postData = [
            'type' => 'Diesel',
            'description' => 'for diesel'
        ];
        $this->post('/finance-manager/expenditure-categories/add', $postData);
        $this->assertSession('The expenditure category has been saved.', 'Flash.flash.0.message');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $postData = [
            'type' => 'Diesel',
            'description' => 'for diesel'
        ];
        $this->post('/finance-manager/expenditure-categories/edit/1', $postData);
        $this->assertSession('The expenditure category has been saved.', 'Flash.flash.0.message');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->delete('/finance-manager/expenditure-categories/delete/2');
        $this->assertSession('The expenditure category has been deleted.', 'Flash.flash.0.message');
    }

    public function testDeleteFailed()
    {
        $this->delete('/finance-manager/expenditure-categories/delete/1');
        $this->assertSession('The expenditure category could not be deleted. Please, try again.', 'Flash.flash.0.message');
    }
}
