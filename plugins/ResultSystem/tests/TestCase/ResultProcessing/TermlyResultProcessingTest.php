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
use ResultSystem\ResultProcessing\TermlyResultProcessing;

class TermlyResultProcessingTest extends IntegrationTestCase
{

    /**
     * Test subject
     *
     * @var \ResultSystem\ResultProcessing\TermlyResultProcessing
     */
    public $termlyResultProcessing ;
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
        'plugin.result_system.student_termly_results',
        'plugin.result_system.student_annual_results',
        'plugin.result_system.student_result_pins',
        'plugin.result_system.student_termly_positions',
        'plugin.result_system.student_termly_subject_positions',
        'plugin.result_system.student_termly_subject_position_on_class_demarcations',
        'plugin.result_system.subject_class_averages',
        'plugin.grading_system.result_grading_systems',
        'plugin.result_system.result_grade_inputs',
    ];

    public function setUp()
    {
        parent::setUp();
        $this->termlyResultProcessing = new TermlyResultProcessing();
    }

    public function tearDown()
    {
        unset($this->termlyResultProcessing);
        parent::tearDown();
    }

    /** @test */
    public function testCalculateTermlyTotalAndAverage()
    {
        $returnData = $this->termlyResultProcessing->calculateTermlyTotalAndAverage(1, 1, 1, 3);
        $this->assertNull($returnData);
    }

    /** @test */
    public function testCalculateTermlyTotalAndAverageFailedCauseExtraSubject()
    {
        $termlyResultTable = TableRegistry::get('ResultSystem.StudentTermlyResults');
        $newRecord = $termlyResultTable->newEntity(
            [
                'id' => 10,
                'student_id' => '001',
                'subject_id' => 4,
                'first_test' => 9,
                'second_test' => 8,
                'third_test' => 10,
                'exam' => 65,
                'total' => 92,
                'class_id' => 1,
                'term_id' => 1,
                'session_id' => 1
            ]
        );
        $termlyResultTable->save($newRecord);
        $returnData = $this->termlyResultProcessing->calculateTermlyTotalAndAverage(1, 1, 1, 3);
        $this->assertArrayHasKey('subjectCountIssues',$returnData);
    }

    /** @test */
    public function testCalculateTermlyPosition()
    {
        $return = $this->termlyResultProcessing->calculateTermlyPosition(1, 1, 1);
        $this->assertEquals(true, $return);
        $termlyPositionTable = TableRegistry::get('ResultSystem.StudentTermlyPositions');
        $termlyPositions = $termlyPositionTable->find()
            ->select(['student_id','position'])
            ->combine('student_id','position')
            ->toArray();
        $this->assertEquals($termlyPositions['002'], 1);
        $this->assertEquals($termlyPositions['001'], 2);
        $this->assertEquals($termlyPositions['003'], 3);
    }

    public function testCalculateTermlyPositionFailed()
    {
        $termlyPositionTable = TableRegistry::get('ResultSystem.StudentTermlyPositions');
        $termlyPositionTable->deleteAll(['class_id' => 1,'session_id' => 1,'term_id' => 1]);
        $return = $this->termlyResultProcessing->calculateTermlyPosition(1, 1, 1);
        $this->assertEquals(false, $return);
    }

    public function testCalculateStudentTermlySubjectPosition()
    {
        $this->termlyResultProcessing->calculateStudentTermlySubjectPosition(1, 1, 1);
        $termlySubjectPositionsTable = TableRegistry::get('ResultSystem.StudentTermlySubjectPositions');
        $termlySubjectPositions = $termlySubjectPositionsTable->find()
            ->enableHydration(false)
            ->select(['student_id','position','subject_id'])
            ->combine('student_id','position','subject_id')
            ->toArray();
        $expected = [
            1 => [
                '001' => 1,
                '003' => 2,
                '002' => 3
            ]
        ];
        $this->assertArraySubset($expected,$termlySubjectPositions);
    }

    public function testCalculateSubjectClassAverage()
    {
        $return = $this->termlyResultProcessing->calculateSubjectClassAverage(1, 1, 1);
        $this->assertEquals(true, $return);
        $subjectClassAverageTable = TableRegistry::get('ResultSystem.SubjectClassAverages');
        $subjectClassAverages = $subjectClassAverageTable->find('all')
            ->enableHydration(false)
            ->where([
                'class_id' => 1,
                'session_id' => 1,
                'term_id' => 1,
            ])
            ->combine('student_count','class_average','subject_id')
            ->toArray();
        $expected = [
            1 => [
                3 => 72.33
            ],
        ];
        $this->assertArraySubset($expected, $subjectClassAverages);
    }
}