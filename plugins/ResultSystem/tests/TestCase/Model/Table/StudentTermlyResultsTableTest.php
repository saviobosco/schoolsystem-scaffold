<?php
namespace ResultSystem\Test\TestCase\Model\Table;

use Cake\Event\EventList;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ResultSystem\Model\Table\StudentTermlyResultsTable;

/**
 * ResultSystem\Model\Table\StudentTermlyResultsTable Test Case
 */
class StudentTermlyResultsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ResultSystem\Model\Table\StudentTermlyResultsTable
     */
    public $StudentTermlyResults;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.student_termly_results',
        'plugin.result_system.students',
        'plugin.result_system.sessions',
        'plugin.result_system.classes',
        'plugin.result_system.subjects',
        'plugin.result_system.student_annual_results',
        'plugin.result_system.terms',
        'plugin.result_system.result_grade_inputs',
        'plugin.grading_system.result_grading_systems'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StudentTermlyResults') ? [] : ['className' => StudentTermlyResultsTable::class];
        $this->StudentTermlyResults = TableRegistry::get('StudentTermlyResults', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentTermlyResults);

        parent::tearDown();
    }

    /**
     * Test saveResult method
     *
     * @return void
     */
    public function testSaveResult()
    {
        $passData = [];
        $passData[] = new Entity(['id' => 10,
            'student_id' => '001',
            'subject_id' => 1,
            'first_test' => 9,
            'second_test' => 8,
            'third_test' => 10,
            'exam' => 65,
            'class_id' => 1,
            'term_id' => 1,
            'session_id' => 1]);
        $passData[] = new Entity(['id' => 11,
            'student_id' => '005',
            'subject_id' => 1,
            'first_test' => 9,
            'second_test' => 8,
            'third_test' => 10,
            'exam' => 65,
            'class_id' => 1,
            'term_id' => 1,
            'session_id' => 1]);
        $expected = ['error'=>[0=>'005']];
        $this->assertEquals($expected,$this->StudentTermlyResults->saveResult($passData));
    }


}
