<?php
namespace ClassManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ClassManager\Model\Table\StudentsTable;

/**
 * ClassManager\Model\Table\StudentsTable Test Case
 */
class StudentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ClassManager\Model\Table\StudentsTable
     */
    public $Students;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.class_manager.students',
        'plugin.class_manager.sessions',
        'plugin.class_manager.classes',
        'plugin.class_manager.blocks',
        'plugin.class_manager.class_demarcations',
        'plugin.class_manager.student_annual_position_on_class_demarcations',
        'plugin.class_manager.student_annual_positions',
        'plugin.class_manager.student_annual_results',
        'plugin.class_manager.student_annual_subject_position_on_class_demarcations',
        'plugin.class_manager.student_annual_subject_positions',
        'plugin.class_manager.student_class_counts',
        'plugin.class_manager.student_general_remarks',
        'plugin.class_manager.student_publish_results',
        'plugin.class_manager.student_result_pins',
        'plugin.class_manager.student_termly_position_on_class_demarcations',
        'plugin.class_manager.student_termly_positions',
        'plugin.class_manager.student_termly_results',
        'plugin.class_manager.student_termly_subject_position_on_class_demarcations',
        'plugin.class_manager.student_termly_subject_positions',
        'plugin.class_manager.students_affective_disposition_scores',
        'plugin.class_manager.students_psychomotor_skill_scores',
        'plugin.class_manager.subject_class_averages',
        'plugin.class_manager.session_admitteds',
        'plugin.class_manager.graduated_sessions',
        'plugin.class_manager.states'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Students') ? [] : ['className' => StudentsTable::class];
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
