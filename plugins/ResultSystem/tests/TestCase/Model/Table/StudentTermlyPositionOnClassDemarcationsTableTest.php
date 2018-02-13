<?php
namespace ResultSystem\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ResultSystem\Model\Table\StudentTermlyPositionOnClassDemarcationsTable;

/**
 * ResultSystem\Model\Table\StudentTermlyPositionOnClassDemarcationsTable Test Case
 */
class StudentTermlyPositionOnClassDemarcationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ResultSystem\Model\Table\StudentTermlyPositionOnClassDemarcationsTable
     */
    public $StudentTermlyPositionOnClassDemarcations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.student_termly_position_on_class_demarcations',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StudentTermlyPositionOnClassDemarcations') ? [] : ['className' => 'ResultSystem\Model\Table\StudentTermlyPositionOnClassDemarcationsTable'];
        $this->StudentTermlyPositionOnClassDemarcations = TableRegistry::get('StudentTermlyPositionOnClassDemarcations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentTermlyPositionOnClassDemarcations);

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
