<?php
namespace SkillsGradingSystem\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use SkillsGradingSystem\Model\Table\StudentsPsychomotorSkillScoresTable;

/**
 * SkillsGradingSystem\Model\Table\StudentsPsychomotorSkillScoresTable Test Case
 */
class StudentsPsychomotorSkillScoresTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \SkillsGradingSystem\Model\Table\StudentsPsychomotorSkillScoresTable
     */
    public $StudentsPsychomotorSkillScores;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.skills_grading_system.students_psychomotor_skill_scores',
        'plugin.skills_grading_system.students',
        'plugin.skills_grading_system.sessions',
        'plugin.skills_grading_system.classes',
        'plugin.skills_grading_system.class_demarcations',
        'plugin.skills_grading_system.students_affective_disposition_scores',
        'plugin.skills_grading_system.psychomotors',
        'plugin.skills_grading_system.terms'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StudentsPsychomotorSkillScores') ? [] : ['className' => 'SkillsGradingSystem\Model\Table\StudentsPsychomotorSkillScoresTable'];
        $this->StudentsPsychomotorSkillScores = TableRegistry::get('StudentsPsychomotorSkillScores', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentsPsychomotorSkillScores);

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
