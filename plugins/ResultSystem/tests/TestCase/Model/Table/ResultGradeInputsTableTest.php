<?php
namespace ResultSystem\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ResultSystem\Model\Table\ResultGradeInputsTable;

/**
 * ResultSystem\Model\Table\ResultGradeInputsTable Test Case
 */
class ResultGradeInputsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ResultSystem\Model\Table\ResultGradeInputsTable
     */
    public $ResultGradeInputs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.result_grade_inputs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ResultGradeInputs') ? [] : ['className' => ResultGradeInputsTable::class];
        $this->ResultGradeInputs = TableRegistry::get('ResultGradeInputs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ResultGradeInputs);

        parent::tearDown();
    }

    public function testGetResultGradeInputs()
    {
        $actual = $this->ResultGradeInputs->getResultGradeInputs();
        $this->assertEquals(2,$actual->count());
    }

    public function testGetValidGradeInputs()
    {
        $expected = [
            'first_test' => 'First Test (10%)',
            'exam' => 'Examination (70%)'
        ];
        $query = $this->ResultGradeInputs->getResultGradeInputs();
        $this->assertEquals($expected,$this->ResultGradeInputs->getValidGradeInputs($query));
    }

    public function testGetValidGradeInputsWithAllData()
    {
        //
        $expected = [
            [
                'id' => 1,
                'main_value' => 'first_test',
                'replacement' => 'First Test',
                'percentage' => '10',
                'output_order' => 1,
                'visibility' => 1
            ],
            [
                'id' => 4,
                'main_value' => 'exam',
                'replacement' => 'Examination',
                'percentage' => '70',
                'output_order' => 4,
                'visibility' => 1
            ]
        ];
        $query = $this->ResultGradeInputs->getResultGradeInputs();
        $actual = $this->ResultGradeInputs->getValidGradeInputsWithAllData($query);
        $this->assertEquals($expected[0]['id'], $actual[0]['id']);
        $this->assertEquals($expected[1]['id'], $actual[1]['id']);
    }
}
