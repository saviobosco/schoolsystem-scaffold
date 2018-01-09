<?php
namespace StudentsManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use StudentsManager\Model\Table\StudentsTable;

/**
 * StudentsManager\Model\Table\StudentsTable Test Case
 */
class StudentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \StudentsManager\Model\Table\StudentsTable
     */
    public $Students;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.students_manager.students',
        'plugin.students_manager.sessions',
        'plugin.students_manager.classes',
        'plugin.students_manager.class_demarcations',
        'plugin.students_manager.session_admitteds',
        'plugin.students_manager.graduated_sessions',
        'plugin.students_manager.states',
        'plugin.students_manager.student_annual_position_on_class_demarcations',
        'plugin.students_manager.student_annual_positions',
        'plugin.students_manager.student_annual_results',
        'plugin.students_manager.student_annual_subject_position_on_class_demarcations',
        'plugin.students_manager.student_annual_subject_positions',
        'plugin.students_manager.student_general_remarks',
        'plugin.students_manager.student_publish_results',
        'plugin.students_manager.student_result_pins',
        'plugin.students_manager.student_termly_position_on_class_demarcations',
        'plugin.students_manager.student_termly_positions',
        'plugin.students_manager.student_termly_results',
        'plugin.students_manager.student_termly_subject_position_on_class_demarcations',
        'plugin.students_manager.student_termly_subject_positions',
        'plugin.students_manager.students_affective_disposition_scores',
        'plugin.students_manager.students_psychomotor_skill_scores'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Students') ? [] : ['className' => 'StudentsManager\Model\Table\StudentsTable'];
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
