<?php
namespace ClassManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ClassManager\Model\Table\BlocksTable;

/**
 * ClassManager\Model\Table\BlocksTable Test Case
 */
class BlocksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ClassManager\Model\Table\BlocksTable
     */
    public $Blocks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.class_manager.blocks',
        'plugin.class_manager.classes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Blocks') ? [] : ['className' => BlocksTable::class];
        $this->Blocks = TableRegistry::get('Blocks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Blocks);

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
