<?php
namespace ResultSystem\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ResultSystem\Model\Table\StudentAnnualSubjectPositionsTable;

/**
 * ResultSystem\Model\Table\StudentAnnualSubjectPositionsTable Test Case
 */
class StudentAnnualSubjectPositionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ResultSystem\Model\Table\StudentAnnualSubjectPositionsTable
     */
    public $StudentAnnualSubjectPositions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.student_annual_subject_positions',
        'plugin.result_system.subjects',
        'plugin.result_system.students',
        'plugin.result_system.classes',
        'plugin.result_system.sessions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StudentAnnualSubjectPositions') ? [] : ['className' => 'ResultSystem\Model\Table\StudentAnnualSubjectPositionsTable'];
        $this->StudentAnnualSubjectPositions = TableRegistry::get('StudentAnnualSubjectPositions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentAnnualSubjectPositions);

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
