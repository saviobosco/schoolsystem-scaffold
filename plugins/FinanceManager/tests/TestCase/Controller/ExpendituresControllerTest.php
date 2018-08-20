<?php
namespace FinanceManager\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use FinanceManager\Controller\ExpendituresController;

/**
 * FinanceManager\Controller\ExpendituresController Test Case
 */
class ExpendituresControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.expenditures',
        'plugin.finance_manager.expenditure_categories',
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
        $this->get('/finance-manager/expenditures');
        $this->assertResponseOk();
        $this->assertResponseContains('Feeding');
        $this->assertResponseContains('15,000.00');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/finance-manager/expenditures/view/1');
        $this->assertResponseOk();
        $this->assertResponseContains('Feeding');
        $this->assertResponseContains('15,000.00');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $postData = [
            'expenditure_category_id' => '1',
            'amount' => '25000',
            'purpose' => 'Feeding Teachers',
            'date' => '08/20/2018'
        ];
        $this->post('/finance-manager/expenditures/add', $postData);
        $this->assertSession('The expenditure has been saved.', 'Flash.flash.0.message');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $postData = [
            'expenditure_category_id' => '1',
            'amount' => '25000',
            'purpose' => 'Feeding Teachers',
            'date' => '08/20/2018'
        ];
        $this->post('/finance-manager/expenditures/edit/1', $postData);
        $this->assertSession('The expenditure has been saved.', 'Flash.flash.0.message');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->delete('/finance-manager/expenditures/delete/1');
        $this->assertSession('The expenditure has been deleted.', 'Flash.flash.0.message');
    }
}
