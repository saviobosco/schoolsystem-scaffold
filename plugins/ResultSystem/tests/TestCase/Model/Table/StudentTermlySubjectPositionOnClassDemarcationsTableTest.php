<?php
namespace ResultSystem\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ResultSystem\Model\Table\StudentTermlySubjectPositionOnClassDemarcationsTable;

/**
 * ResultSystem\Model\Table\StudentTermlySubjectPositionOnClassDemarcationsTable Test Case
 */
class StudentTermlySubjectPositionOnClassDemarcationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ResultSystem\Model\Table\StudentTermlySubjectPositionOnClassDemarcationsTable
     */
    public $StudentTermlySubjectPositionOnClassDemarcations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.student_termly_subject_position_on_class_demarcations',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StudentTermlySubjectPositionOnClassDemarcations') ? [] : ['className' => 'ResultSystem\Model\Table\StudentTermlySubjectPositionOnClassDemarcationsTable'];
        $this->StudentTermlySubjectPositionOnClassDemarcations = TableRegistry::get('StudentTermlySubjectPositionOnClassDemarcations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentTermlySubjectPositionOnClassDemarcations);

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
