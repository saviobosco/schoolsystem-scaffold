<?php
namespace ResultSystem\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ResultSystem\Model\Table\StudentPublishResultsTable;

/**
 * ResultSystem\Model\Table\StudentPublishResultsTable Test Case
 */
class StudentPublishResultsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ResultSystem\Model\Table\StudentPublishResultsTable
     */
    public $StudentPublishResults;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.student_publish_results',
        'plugin.result_system.students',
        'plugin.result_system.sessions',
        'plugin.result_system.classes',
        'plugin.result_system.terms',

    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StudentPublishResults') ? [] : ['className' => StudentPublishResultsTable::class];
        $this->StudentPublishResults = TableRegistry::get('StudentPublishResults', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentPublishResults);

        parent::tearDown();
    }

    /**
     * Test getStudentResultPublishStatus method
     *
     * @return void
     */
    public function testGetStudentResultPublishStatus()
    {
        $expected = [
            'id' => 1,
            'student_id' => '001',
            'status' => 1,
            'class_id' => 1,
            'term_id' => 1,
            'session_id' => 1
        ];
        $this->assertEquals($expected,$this->StudentPublishResults->getStudentResultPublishStatus('001',1,1,1));
    }

    /**
     * Test publishResults method
     *
     * @return void
     */
    public function testPublishResults()
    {
        $postData = [
            0 => [
                'status' => '1',
                'student_id' => '001',
                'class_id' => '1',
                'session_id' => '1',
                'term_id' => '1'
            ]
        ];
        $queryData = [
            'term_id' => 1,
            'class_id' => 1,
            'session_id' => 1
        ];
        $this->assertEquals(true,$this->StudentPublishResults->publishResults($postData,$queryData));
    }
}
