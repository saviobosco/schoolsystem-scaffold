<?php
namespace ResultSystem\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ResultSystem\Model\Table\StudentResultPinsTable;

/**
 * ResultSystem\Model\Table\StudentResultPinsTable Test Case
 */
class StudentResultPinsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ResultSystem\Model\Table\StudentResultPinsTable
     */
    public $StudentResultPins;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.student_result_pins',
        'plugin.result_system.students',
        'plugin.result_system.sessions',
        'plugin.result_system.classes',
        'plugin.result_system.blocks',
        'plugin.result_system.class_demarcations',
        'plugin.result_system.student_annual_results',
        'plugin.result_system.student_termly_results',
        'plugin.result_system.student_annual_position_on_class_demarcations',
        'plugin.result_system.student_annual_positions',
        'plugin.result_system.student_annual_subject_position_on_class_demarcations',
        'plugin.result_system.subjects',
        'plugin.result_system.student_annual_subject_position_on_class_demarcations',
        'plugin.result_system.student_annual_subject_positions',
        'plugin.result_system.student_termly_subject_position_on_class_demarcations',
        'plugin.result_system.student_termly_subject_positions',
        'plugin.result_system.terms',
        'plugin.result_system.student_termly_position_on_class_demarcations',
        'plugin.result_system.student_termly_positions',
        'plugin.result_system.student_termly_subject_position_on_class_demarcations',
        'plugin.result_system.student_general_remarks'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StudentResultPins') ? [] : ['className' => 'ResultSystem\Model\Table\StudentResultPinsTable'];
        $this->StudentResultPins = TableRegistry::get('StudentResultPins', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentResultPins);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test savePin method
     *
     * @return void
     */
    public function testSavePin()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test checkPin method
     *
     * @return void
     */
    public function testCheckPin()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test updateStudentPin method
     *
     * @return void
     */
    public function testUpdateStudentPin()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
