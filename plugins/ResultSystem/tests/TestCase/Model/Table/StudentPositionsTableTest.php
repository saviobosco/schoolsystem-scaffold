<?php
namespace ResultSystem\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ResultSystem\Model\Table\StudentPositionsTable;

/**
 * ResultSystem\Model\Table\StudentPositionsTable Test Case
 */
class StudentPositionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ResultSystem\Model\Table\StudentPositionsTable
     */
    public $StudentPositions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.student_positions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StudentPositions') ? [] : ['className' => StudentPositionsTable::class];
        $this->StudentPositions = TableRegistry::get('StudentPositions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentPositions);

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
