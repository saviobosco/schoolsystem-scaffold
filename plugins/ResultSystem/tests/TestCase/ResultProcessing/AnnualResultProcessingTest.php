<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 8/18/18
 * Time: 1:11 PM
 */

namespace TestCase\ResultProcessing;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use ResultSystem\ResultProcessing\AnnualResultProcessing;

class AnnualResultProcessingTest extends IntegrationTestCase
{

    /**
     * Test subject
     *
     * @var \ResultSystem\ResultProcessing\AnnualResultProcessing
     */
    public $annualResultProcessing ;
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.students',
        'plugin.result_system.sessions',
        'plugin.result_system.classes',
        'plugin.result_system.subjects',
        'plugin.result_system.terms',
        'plugin.result_system.student_annual_results',
        'plugin.result_system.student_positions',
        'plugin.result_system.student_subject_positions',
        'plugin.grading_system.result_grading_systems',
    ];

    public function setUp()
    {
        parent::setUp();
        $this->annualResultProcessing = new AnnualResultProcessing();
    }

    public function tearDown()
    {
        unset($this->annualResultProcessing);
        parent::tearDown();
    }

    /** @test */
    public function testCalculateAnnualTotals()
    {
        $return = $this->annualResultProcessing->calculateAnnualTotals(1, 1, 1);
        $this->assertNull($return);
        $annualResultTable = TableRegistry::get('ResultSystem.StudentAnnualResults');
        $firstRow = $annualResultTable->find()->first();
        $this->assertEquals('A', $firstRow['grade']);
        $this->assertEquals('Distinction', $firstRow['remark']);
    }

    public function testCalculateAnnualTotalsWillDeleteDanglingRecord()
    {
        $annualResultTable = TableRegistry::get('ResultSystem.StudentAnnualResults');
        $newRecord = $annualResultTable->newEntity(
            [
                'id' => 10,
                'student_id' => '001',
                'subject_id' => 4,
                'first_term' => null,
                'second_term' => null,
                'third_term' => null,
                'total' => null,
                'average' => 1,
                'class_id' => 1,
                'session_id' => 1,
            ]
        );
        $annualResultTable->save($newRecord);
        $danglingRow = $annualResultTable->find()->enableHydration(false)->where(['id' => 10])->first();
        $this->assertEquals($newRecord['student_id'],$danglingRow['student_id']);
        $this->annualResultProcessing->calculateAnnualTotals(1, 1, 1);
        $this->assertNull($annualResultTable->find()->enableHydration(false)->where(['id' => 10])->first()['id']);
    }

    /** @test */
    public function testCalculateAnnualPosition()
    {
        $return = $this->annualResultProcessing->calculateAnnualPosition(1, 1, 1);
        $this->assertEquals(true, $return);
        $annualPositionsTable = TableRegistry::get('ResultSystem.StudentPositions');
        $annualPositions = $annualPositionsTable->find()->enableHydration(false)->combine('student_id','position')->toArray();
        $this->assertEquals($annualPositions['001'], 2);
        $this->assertEquals($annualPositions['002'], 1);
    }

    public function testCalculateStudentAnnualSubjectPosition()
    {
        $this->annualResultProcessing->calculateStudentAnnualSubjectPosition(1, 1, 1);
        $annualSubjectPositionsTable = TableRegistry::get('ResultSystem.StudentSubjectPositions');
        $annualSubjectPositions = $annualSubjectPositionsTable->find()->combine('student_id','position','subject_id')->toArray();
        $expected = [
            1 => [
                '001' => 1,
                '003' => 2,
                '002' => 3
            ],
        ];
        $this->assertArraySubset($expected, $annualSubjectPositions);
    }
}