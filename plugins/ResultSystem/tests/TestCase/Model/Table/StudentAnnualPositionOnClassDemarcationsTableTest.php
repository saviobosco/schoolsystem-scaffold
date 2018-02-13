<?php
namespace ResultSystem\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ResultSystem\Model\Table\StudentAnnualPositionOnClassDemarcationsTable;

/**
 * ResultSystem\Model\Table\StudentAnnualPositionOnClassDemarcationsTable Test Case
 */
class StudentAnnualPositionOnClassDemarcationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ResultSystem\Model\Table\StudentAnnualPositionOnClassDemarcationsTable
     */
    public $StudentAnnualPositionOnClassDemarcations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.student_annual_position_on_class_demarcations',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StudentAnnualPositionOnClassDemarcations') ? [] : ['className' => 'ResultSystem\Model\Table\StudentAnnualPositionOnClassDemarcationsTable'];
        $this->StudentAnnualPositionOnClassDemarcations = TableRegistry::get('StudentAnnualPositionOnClassDemarcations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentAnnualPositionOnClassDemarcations);

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
