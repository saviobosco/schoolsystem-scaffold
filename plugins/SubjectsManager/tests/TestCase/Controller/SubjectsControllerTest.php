<?php
namespace SubjectsManager\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use SubjectsManager\Controller\SubjectsController;

/**
 * SubjectsManager\Controller\SubjectsController Test Case
 */
class SubjectsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.subjects_manager.subjects',
        'plugin.subjects_manager.blocks',
        'plugin.subjects_manager.classes',
        'plugin.subjects_manager.class_demarcations',
        'plugin.subjects_manager.student_annual_results',
        'plugin.subjects_manager.student_termly_results',
        'plugin.subjects_manager.students',
        'plugin.subjects_manager.sessions',
        'plugin.subjects_manager.session_admitted',
        'plugin.subjects_manager.session_graduated'
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
