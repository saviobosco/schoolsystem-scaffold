<?php
namespace ResultSystem\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ResultSystem\Model\Table\StudentSubjectPositionsTable;

/**
 * ResultSystem\Model\Table\StudentSubjectPositionsTable Test Case
 */
class StudentSubjectPositionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ResultSystem\Model\Table\StudentSubjectPositionsTable
     */
    public $StudentSubjectPositions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.student_subject_positions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StudentSubjectPositions') ? [] : ['className' => StudentSubjectPositionsTable::class];
        $this->StudentSubjectPositions = TableRegistry::get('StudentSubjectPositions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentSubjectPositions);

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
