<?php
namespace SkillsGradingSystem\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use SkillsGradingSystem\Model\Table\StudentsTable;

/**
 * SkillsGradingSystem\Model\Table\StudentsTable Test Case
 */
class StudentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \SkillsGradingSystem\Model\Table\StudentsTable
     */
    public $Students;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.skills_grading_system.students',
        'plugin.skills_grading_system.sessions',
        'plugin.skills_grading_system.classes',
        'plugin.skills_grading_system.class_demacations',
        'plugin.skills_grading_system.student_annual_position_on_class_demacations',
        'plugin.skills_grading_system.student_annual_positions',
        'plugin.skills_grading_system.student_annual_results',
        'plugin.skills_grading_system.student_annual_subject_position_on_class_demacations',
        'plugin.skills_grading_system.student_annual_subject_positions',
        'plugin.skills_grading_system.student_termly_position_on_class_demacations',
        'plugin.skills_grading_system.student_termly_positions',
        'plugin.skills_grading_system.student_termly_results',
        'plugin.skills_grading_system.student_termly_subject_position_on_class_demacations',
        'plugin.skills_grading_system.student_termly_subject_positions',
        'plugin.skills_grading_system.students_affective_disposition_scores',
        'plugin.skills_grading_system.students_psychomotor_skill_scores'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Students') ? [] : ['className' => 'SkillsGradingSystem\Model\Table\StudentsTable'];
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
