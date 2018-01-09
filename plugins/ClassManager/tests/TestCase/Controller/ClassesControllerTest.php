<?php
namespace ClassManager\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use ClassManager\Controller\ClassesController;

/**
 * ClassManager\Controller\ClassesController Test Case
 */
class ClassesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.class_manager.classes',
        'plugin.class_manager.blocks',
        'plugin.class_manager.class_demarcations',
        'plugin.class_manager.student_annual_results',
        'plugin.class_manager.student_termly_results',
        'plugin.class_manager.students',
        'plugin.class_manager.sessions',
        'plugin.class_manager.session_admitted',
        'plugin.class_manager.session_graduated'
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
