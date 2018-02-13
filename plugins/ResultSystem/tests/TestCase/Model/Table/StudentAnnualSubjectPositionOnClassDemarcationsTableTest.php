<?php
namespace ResultSystem\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ResultSystem\Model\Table\StudentAnnualSubjectPositionOnClassDemarcationsTable;

/**
 * ResultSystem\Model\Table\StudentAnnualSubjectPositionOnClassDemarcationsTable Test Case
 */
class StudentAnnualSubjectPositionOnClassDemarcationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ResultSystem\Model\Table\StudentAnnualSubjectPositionOnClassDemarcationsTable
     */
    public $StudentAnnualSubjectPositionOnClassDemarcations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.student_annual_subject_position_on_class_demarcations',

    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StudentAnnualSubjectPositionOnClassDemarcations') ? [] : ['className' => 'ResultSystem\Model\Table\StudentAnnualSubjectPositionOnClassDemarcationsTable'];
        $this->StudentAnnualSubjectPositionOnClassDemarcations = TableRegistry::get('StudentAnnualSubjectPositionOnClassDemarcations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentAnnualSubjectPositionOnClassDemarcations);

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
