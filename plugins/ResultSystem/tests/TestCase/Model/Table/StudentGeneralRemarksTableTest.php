<?php
namespace ResultSystem\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ResultSystem\Model\Table\StudentGeneralRemarksTable;

/**
 * ResultSystem\Model\Table\StudentGeneralRemarksTable Test Case
 */
class StudentGeneralRemarksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ResultSystem\Model\Table\StudentGeneralRemarksTable
     */
    public $StudentGeneralRemarks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.student_general_remarks',
        'plugin.result_system.students',
        'plugin.result_system.sessions',
        'plugin.result_system.classes',
        'plugin.result_system.blocks',
        'plugin.result_system.class_demarcations',
        'plugin.result_system.student_annual_position_on_class_demarcations',
        'plugin.result_system.student_annual_subject_position_on_class_demarcations',
        'plugin.result_system.subjects',
        'plugin.result_system.student_annual_results',
        'plugin.result_system.student_annual_subject_positions',
        'plugin.result_system.student_termly_results',
        'plugin.result_system.terms',
        'plugin.result_system.student_termly_subject_position_on_class_demarcations',
        'plugin.result_system.student_termly_subject_positions',
        'plugin.result_system.subject_class_averages',
        'plugin.result_system.student_termly_position_on_class_demarcations',
        'plugin.result_system.fees',
        'plugin.result_system.student_annual_positions',
        'plugin.result_system.student_class_counts',
        'plugin.result_system.student_publish_results',
        'plugin.result_system.student_result_pins',
        'plugin.result_system.student_termly_positions',
        'plugin.result_system.students_affective_disposition_scores',
        'plugin.result_system.students_psychomotor_skill_scores'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StudentGeneralRemarks') ? [] : ['className' => StudentGeneralRemarksTable::class];
        $this->StudentGeneralRemarks = TableRegistry::get('StudentGeneralRemarks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentGeneralRemarks);

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
