<?php
namespace GradingSystem\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use GradingSystem\Model\Table\ResultGradingSystemsTable;

/**
 * GradingSystem\Model\Table\ResultGradingSystemsTable Test Case
 */
class ResultGradingSystemsTableTest extends TestCase
{

    // including the gradable trait for testing

    /**
     * Test subject
     *
     * @var \GradingSystem\Model\Table\ResultGradingSystemsTable
     */
    public $ResultGradingSystems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('ResultGradingSystems') ? [] : ['className' => 'GradingSystem\Model\Table\ResultGradingSystemsTable'];
        $this->ResultGradingSystems = TableRegistry::get('ResultGradingSystems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ResultGradingSystems);

        parent::tearDown();
    }


    public function testGetGrades()
    {
        $grade = $this->ResultGradingSystems->getGrades();
        $this->assertCount(4,$grade,'Numbers are not equal');
        $expected = [
            '75 - 100' => 'A',
            '55 - 74' => 'B',
            '45 - 54' => 'P',
            '0 - 45' => 'F'
        ];
        $this->assertEquals($expected, $grade);
    }

    public function testCalculateGrade()
    {
        $totals = [100,75,74.55,55,54.5,43];
        $grades = [
            '75 - 100' => 'A',
            '55 - 74' => 'B',
            '45 - 54' => 'P',
            '0 - 45' => 'F'
        ];
        $this->assertEquals('A',$this->ResultGradingSystems->calculateGrade($totals[0],$grades));
        $this->assertEquals('A',$this->ResultGradingSystems->calculateGrade($totals[1],$grades));
        $this->assertEquals('B',$this->ResultGradingSystems->calculateGrade($totals[2],$grades));
        $this->assertEquals('B',$this->ResultGradingSystems->calculateGrade($totals[3],$grades));
        $this->assertEquals('P',$this->ResultGradingSystems->calculateGrade($totals[4],$grades));
        $this->assertEquals('F',$this->ResultGradingSystems->calculateGrade($totals[5],$grades));
    }
}
