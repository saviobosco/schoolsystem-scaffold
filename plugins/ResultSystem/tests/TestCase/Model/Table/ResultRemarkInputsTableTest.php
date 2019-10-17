<?php
namespace ResultSystem\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ResultSystem\Model\Table\ResultRemarkInputsTable;

/**
 * ResultSystem\Model\Table\ResultRemarkInputsTable Test Case
 */
class ResultRemarkInputsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ResultSystem\Model\Table\ResultRemarkInputsTable
     */
    public $ResultRemarkInputs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.result_remark_inputs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ResultRemarkInputs') ? [] : ['className' => ResultRemarkInputsTable::class];
        $this->ResultRemarkInputs = TableRegistry::get('ResultRemarkInputs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ResultRemarkInputs);

        parent::tearDown();
    }

    public function testGetValidRemarkInputs()
    {
        $this->assertArrayHasKey('remark_1', $this->ResultRemarkInputs->getValidRemarkInputs(1));
    }

}
