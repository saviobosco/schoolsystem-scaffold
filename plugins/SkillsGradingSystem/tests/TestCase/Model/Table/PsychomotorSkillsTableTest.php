<?php
namespace SkillsGradingSystem\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use SkillsGradingSystem\Model\Table\PsychomotorSkillsTable;

/**
 * SkillsGradingSystem\Model\Table\PsychomotorSkillsTable Test Case
 */
class PsychomotorSkillsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \SkillsGradingSystem\Model\Table\PsychomotorSkillsTable
     */
    public $PsychomotorSkills;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.skills_grading_system.psychomotor_skills'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PsychomotorSkills') ? [] : ['className' => 'SkillsGradingSystem\Model\Table\PsychomotorSkillsTable'];
        $this->PsychomotorSkills = TableRegistry::get('PsychomotorSkills', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PsychomotorSkills);

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
