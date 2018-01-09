<?php
namespace ResultSystem\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ResultSystem\Model\Table\StudentsTable;

/**
 * ResultSystem\Model\Table\StudentsTable Test Case
 */
class StudentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ResultSystem\Model\Table\StudentsTable
     */
    public $Students;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.students',
        'plugin.result_system.sessions',
        'plugin.result_system.classes',
        'plugin.result_system.class_demacations',
        'plugin.result_system.student_annual_position_on_class_demacations',
        'plugin.result_system.student_annual_positions',
        'plugin.result_system.student_annual_results',
        'plugin.result_system.subjects',
        'plugin.result_system.blocks',
        'plugin.result_system.student_termly_results',
        'plugin.result_system.terms',
        'plugin.result_system.student_annual_subject_position_on_class_demacations',
        'plugin.result_system.student_annual_subject_positions',
        'plugin.result_system.student_termly_position_on_class_demacations',
        'plugin.result_system.student_termly_positions',
        'plugin.result_system.student_termly_subject_position_on_class_demacations',
        'plugin.result_system.student_termly_subject_positions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Students') ? [] : ['className' => 'ResultSystem\Model\Table\StudentsTable'];
        $this->Students = TableRegistry::get('Students', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Students);

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
}
