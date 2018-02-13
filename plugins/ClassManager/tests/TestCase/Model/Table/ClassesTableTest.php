<?php
namespace ClassManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ClassManager\Model\Table\ClassesTable;

/**
 * ClassManager\Model\Table\ClassesTable Test Case
 */
class ClassesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ClassManager\Model\Table\ClassesTable
     */
    public $Classes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('Classes') ? [] : ['className' => ClassesTable::class];
        $this->Classes = TableRegistry::get('Classes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Classes);

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
