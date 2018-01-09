<?php
namespace StudentsManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use StudentsManager\Model\Table\SessionsTable;

/**
 * StudentsManager\Model\Table\SessionsTable Test Case
 */
class SessionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \StudentsManager\Model\Table\SessionsTable
     */
    public $Sessions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.students_manager.sessions',
        'plugin.students_manager.fees',
        'plugin.students_manager.result_remarks',
        'plugin.students_manager.student_annual_position_on_class_demarcations',
        'plugin.students_manager.student_annual_positions',
        'plugin.students_manager.student_annual_results',
        'plugin.students_manager.student_annual_subject_position_on_class_demarcations',
        'plugin.students_manager.student_annual_subject_positions',
        'plugin.students_manager.student_class_counts',
        'plugin.students_manager.student_general_remarks',
        'plugin.students_manager.student_publish_results',
        'plugin.students_manager.student_result_pins',
        'plugin.students_manager.student_termly_position_on_class_demarcations',
        'plugin.students_manager.student_termly_positions',
        'plugin.students_manager.student_termly_results',
        'plugin.students_manager.student_termly_subject_position_on_class_demarcations',
        'plugin.students_manager.student_termly_subject_positions',
        'plugin.students_manager.students_affective_disposition_scores',
        'plugin.students_manager.students_psychomotor_skill_scores',
        'plugin.students_manager.subject_class_averages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Sessions') ? [] : ['className' => SessionsTable::class];
        $this->Sessions = TableRegistry::get('Sessions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Sessions);

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
}
