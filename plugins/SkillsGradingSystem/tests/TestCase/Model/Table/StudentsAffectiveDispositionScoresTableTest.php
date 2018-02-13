<?php
namespace SkillsGradingSystem\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use SkillsGradingSystem\Model\Table\StudentsAffectiveDispositionScoresTable;

/**
 * SkillsGradingSystem\Model\Table\StudentsAffectiveDispositionScoresTable Test Case
 */
class StudentsAffectiveDispositionScoresTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \SkillsGradingSystem\Model\Table\StudentsAffectiveDispositionScoresTable
     */
    public $StudentsAffectiveDispositionScores;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.skills_grading_system.students_affective_disposition_scores',
        'plugin.skills_grading_system.students',
        'plugin.skills_grading_system.sessions',
        'plugin.skills_grading_system.classes',
        'plugin.skills_grading_system.students_psychomotor_skill_scores',
        'plugin.skills_grading_system.terms',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StudentsAffectiveDispositionScores') ? [] : ['className' => 'SkillsGradingSystem\Model\Table\StudentsAffectiveDispositionScoresTable'];
        $this->StudentsAffectiveDispositionScores = TableRegistry::get('StudentsAffectiveDispositionScores', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentsAffectiveDispositionScores);

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
