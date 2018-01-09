<?php
namespace StudentsManager\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use StudentsManager\Controller\StudentsController;

/**
 * StudentsManager\Controller\StudentsController Test Case
 */
class StudentsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.students_manager.students',
        'plugin.students_manager.sessions',
        'plugin.students_manager.session_admitted',
        'plugin.students_manager.classes',
        'plugin.students_manager.blocks',
        'plugin.students_manager.class_demarcations',
        'plugin.students_manager.student_annual_results',
        'plugin.students_manager.student_termly_results',
        'plugin.students_manager.session_graduated'
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
