<?php
namespace SkillsGradingSystem\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use SkillsGradingSystem\Model\Table\AffectiveDispositionsTable;

/**
 * SkillsGradingSystem\Model\Table\AffectiveDispositionsTable Test Case
 */
class AffectiveDispositionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \SkillsGradingSystem\Model\Table\AffectiveDispositionsTable
     */
    public $AffectiveDispositions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.skills_grading_system.affective_dispositions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AffectiveDispositions') ? [] : ['className' => 'SkillsGradingSystem\Model\Table\AffectiveDispositionsTable'];
        $this->AffectiveDispositions = TableRegistry::get('AffectiveDispositions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AffectiveDispositions);

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
