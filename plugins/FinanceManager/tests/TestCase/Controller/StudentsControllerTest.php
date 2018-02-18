<?php
namespace FinanceManager\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use FinanceManager\Controller\StudentsController;

/**
 * FinanceManager\Controller\StudentsController Test Case
 */
class StudentsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.students',
        'plugin.finance_manager.sessions',
        'plugin.finance_manager.classes',
        'plugin.finance_manager.student_fees',
        'plugin.finance_manager.fee_categories',
        'plugin.finance_manager.fees',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/finance-manager/students?class_id=1');
        $this->assertResponseOk();
        $this->assertResponseContains('Omebe');
        $this->assertResponseContains('Johnbosco');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/finance-manager/students/view/1000');
        $this->assertResponseOk();
        $this->assertResponseContains('Omebe Johnbosco');
    }
}
