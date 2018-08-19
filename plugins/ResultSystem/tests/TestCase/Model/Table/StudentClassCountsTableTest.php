<?php
namespace ResultSystem\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ResultSystem\Model\Table\StudentClassCountsTable;

/**
 * ResultSystem\Model\Table\StudentClassCountsTable Test Case
 */
class StudentClassCountsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ResultSystem\Model\Table\StudentClassCountsTable
     */
    public $StudentClassCounts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.student_class_counts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StudentClassCounts') ? [] : ['className' => 'ResultSystem\Model\Table\StudentClassCountsTable'];
        $this->StudentClassCounts = TableRegistry::get('StudentClassCounts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentClassCounts);

        parent::tearDown();
    }

    public function testGetStudentsClassCount()
    {
        //
        $actualResult = $this->StudentClassCounts->getStudentsClassCount(1, 1, 1);
        $this->assertEquals(1, $actualResult['student_count']);
    }
}
