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
        'plugin.finance_manager.blocks',
        'plugin.finance_manager.class_demarcations',
        'plugin.finance_manager.student_annual_results',
        'plugin.finance_manager.student_termly_results',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
