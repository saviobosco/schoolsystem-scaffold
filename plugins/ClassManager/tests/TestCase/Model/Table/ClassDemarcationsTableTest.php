<?php
namespace ClassManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ClassManager\Model\Table\ClassDemarcationsTable;

/**
 * ClassManager\Model\Table\ClassDemarcationsTable Test Case
 */
class ClassDemarcationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ClassManager\Model\Table\ClassDemarcationsTable
     */
    public $ClassDemarcations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.class_manager.class_demarcations',
        'plugin.class_manager.classes',
        'plugin.class_manager.blocks',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ClassDemarcations') ? [] : ['className' => ClassDemarcationsTable::class];
        $this->ClassDemarcations = TableRegistry::get('ClassDemarcations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClassDemarcations);

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
