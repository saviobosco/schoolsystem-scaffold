<?php
namespace ResultSystem\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ResultSystem\Model\Table\StudentTermlySubjectPositionsTable;

/**
 * ResultSystem\Model\Table\StudentTermlySubjectPositionsTable Test Case
 */
class StudentTermlySubjectPositionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ResultSystem\Model\Table\StudentTermlySubjectPositionsTable
     */
    public $StudentTermlySubjectPositions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.student_termly_subject_positions',
        'plugin.result_system.subjects',
        'plugin.result_system.students',
        'plugin.result_system.classes',
        'plugin.result_system.terms',
        'plugin.result_system.student_termly_results',
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
        $config = TableRegistry::exists('StudentTermlySubjectPositions') ? [] : ['className' => 'ResultSystem\Model\Table\StudentTermlySubjectPositionsTable'];
        $this->StudentTermlySubjectPositions = TableRegistry::get('StudentTermlySubjectPositions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentTermlySubjectPositions);

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
