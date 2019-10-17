<?php
namespace ResultSystem\Test\TestCase\Model\Table;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ResultSystem\Model\Table\SubjectsTable;

/**
 * ResultSystem\Model\Table\SubjectsTable Test Case
 */
class SubjectsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ResultSystem\Model\Table\SubjectsTable
     */
    public $Subjects;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.subjects',
        'plugin.result_system.classes',
        'plugin.result_system.student_annual_results',
        'plugin.result_system.student_termly_results',
        'plugin.result_system.students',
        'plugin.result_system.sessions',
        'plugin.result_system.student_subject_positions',
        'plugin.result_system.terms',
        'plugin.result_system.student_subject_positions',
        'plugin.result_system.subject_class_averages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Subjects') ? [] : ['className' => SubjectsTable::class];
        $this->Subjects = TableRegistry::get('Subjects', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Subjects);

        parent::tearDown();
    }

    /**
     * Test getSubjectClassAverages method
     *
     * @return void
     */
    public function testGetSubjectClassAverages()
    {
        $expected = [1 => 50];
        $this->assertEquals($expected,$this->Subjects->getSubjectClassAverages(1, 1, 1));
    }

    /**
     * Test getAnnualResults method
     *
     * @return void
     */
    public function testGetAnnualResults()
    {
        $expected = [
            0 => [
                'id' => 1,
                'student_id' => '001',
                'subject_id' => 1,
                'first_term' => 92,
                'second_term' => null,
                'third_term' => null,
                'total' => 92.0,
                'average' => 1,
                'remark' => '',
                'class_id' => 1,
                'session_id' => 1,
                'grade' => '',
                'student' => [
                    'id' => '001',
                    'first_name' => 'Omebe',
                    'last_name' => 'Johnbosco'
                ]
            ]
        ];
        $this->assertArraySubset($expected,$this->Subjects->getAnnualResults(1, ['class_id'=>1, 'session_id'=>1]));
    }

    /**
     * Test getTermlyResults method
     *
     * @return void
     */
    public function testGetTermlyResults()
    {
        $expected = [
            0 => [
                'id' => 1,
                'student_id' => '001',
                'subject_id' => 1,
                'first_test' => 9,
                'second_test' => 8,
                'third_test' => 10,
                'exam' => 65,
                'total' => 92,
                'grade' => null,
                'remark' => null,
                'principal_comment' => null,
                'head_teacher_comment' => null,
                'class_id' => 1,
                'term_id' => 1,
                'session_id' => 1,
                'student' => [
                    'id' => '001',
                    'first_name' => 'Omebe',
                    'last_name' => 'Johnbosco'
                ]
            ]
        ];

        $this->assertArraySubset($expected,$this->Subjects->getTermlyResults(1, ['class_id'=>1, 'session_id'=>1, 'term_id'=>1]));
    }

    /**
     * Test getTermlySubjectPositions method
     *
     * @return void
     */
    public function testGetSubjectPositions()
    {
        $expected = ['001' => 1];
        $this->assertEquals($expected,$this->Subjects->getSubjectPositions(1, ['class_id'=>1, 'session_id'=>1, 'term_id'=>1]));
    }

    /**
     * Test getTermlyResultWithHydration method
     *
     * @return void
     */
    public function testGetTermlyResultWithHydration()
    {
        $this->assertInstanceOf(Entity::class,$this->Subjects->getTermlyResultWithHydration(1,['class_id'=>1,'session_id'=>1,'term_id'=>1]));
    }

    /**
     * Test getAnnualResultWithHydration method
     *
     * @return void
     */
    public function testGetAnnualResultWithHydration()
    {
        $this->assertInstanceOf(Entity::class,$this->Subjects->getAnnualResultWithHydration(1,['class_id'=>1,'session_id'=>1]));
    }
}
