<?php
namespace ResultSystem\Test\TestCase\Model\Table;

use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ResultSystem\Model\Table\StudentsTable;

/**
 * ResultSystem\Model\Table\StudentsTable Test Case
 */
class StudentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ResultSystem\Model\Table\StudentsTable
     */
    public $Students;

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
        'plugin.result_system.student_annual_results',
        'plugin.result_system.student_subject_positions',
        'plugin.result_system.student_termly_results',
        'plugin.result_system.terms',
        'plugin.result_system.subject_class_averages',
        'plugin.result_system.student_class_counts',
        'plugin.result_system.student_general_remarks',
        'plugin.result_system.student_publish_results',
        'plugin.result_system.student_positions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Students') ? [] : ['className' => StudentsTable::class];
        $this->Students = TableRegistry::get('Students', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Students);

        parent::tearDown();
    }

    /**
     * Test getStudentAnnualSubjectPositions method
     *
     * @return void
     */
    public function testGetStudentSubjectPositions()
    {
        $expected = [
            1 => 1
        ];
        $this->assertEquals($expected,$this->Students->getStudentSubjectPositions('001', 1, 1, 1));
    }

    /**
     * Test getStudentGeneralRemark method
     *
     * @return void
     */
    public function testGetStudentGeneralRemark()
    {
        $expected = [
            'id' => 1,
            'student_id' => '001',
            'remark_1' => 'He is a good Student',
            'remark_2' => 'Yes He is',
            'remark_3'=> null,
            'remark_4'=> null,
            'remark_5'=> null,
            'remark_6'=> null,
            'class_id' => 1,
            'term_id' => 1,
            'session_id' => 1
        ];
        $this->assertEquals($expected,$this->Students->getStudentGeneralRemark('001', 1, 1, 1));
    }

    /**
     * Test getStudentTermlyPosition method
     *
     * @return void
     */
    public function testGetStudentPosition()
    {
        $expected = [
            'id' => 1,
            'student_id' => '001',
            'total' => '80',
            'average' => 2,
            'grade' => null,
            'position' => 1,
            'class_id' => 1,
            'term_id' => 1,
            'session_id' => 1
        ];
        $this->assertEquals($expected,$this->Students->getStudentPosition('001',1,1,1));
    }

    /**
     * Test getStudentsWithIdAndNameByClassId method
     *
     * @return void
     */
    public function testGetStudentsWithIdAndNameByClassId()
    {
        $expected =[
            [
                'id' => '001',
                'first_name' => 'Omebe',
                'last_name' => 'Johnbosco',
            ],
            [
                'id' => '002',
                'first_name' => 'Iwueze',
                'last_name' => 'Ifeoma',
            ],
            [
                'id' => '003',
                'first_name' => 'Omebe',
                'last_name' => 'Ifeanyi',
            ],
        ];
        $this->assertEquals($expected,$this->Students->getStudentsWithIdAndNameByClassId(1));
    }

    /**
     * Test getStudentAnnualResult method
     *
     * @return void
     */
    public function testGetStudentAnnualResult()
    {
        $this->assertInstanceOf(Entity::class,$this->Students->getStudentAnnualResult('001',['term_id'=>1,'session_id'=>1,'class_id'=>1]));
    }

    /**
     * Test getStudentTermlyResult method
     *
     * @return void
     */
    public function testGetStudentTermlyResult()
    {
        $this->assertInstanceOf(Entity::class,$this->Students->getStudentTermlyResult('001',['term_id'=>1,'session_id'=>1,'class_id'=>1]));
    }

    /**
     * Test getStudentTermlyResultOnly method
     *
     * @return void
     */
    public function testGetStudentTermlyResultOnly()
    {
        $actual = $this->Students->getStudentTermlyResultOnly('001',['term_id'=>1,'session_id'=>1,'class_id'=>1]);
        $expected = [
            [
                'id' => 1,
                'student_id' => '001',
                'subject_id' => '1',
                'first_test' => 9,
                'second_test' => 8,
                'third_test' => 8,
                'exam' => 8,
            ]
        ];
        $this->assertInstanceOf(Query::class, $actual);
    }

    /**
     * Test getStudentAnnualResultOnly method
     *
     * @return void
     */
    public function testGetStudentAnnualResultOnly()
    {
        $actual = $this->Students->getStudentAnnualResultOnly('001',['term_id'=>1,'session_id'=>1,'class_id'=>1]);
        /*$expected = [
            [
                'id' => 1,
                'student_id' => '001',
                'subject_id' => 1,
                'first_term' => 92
            ]
        ];*/
        $this->assertInstanceOf(Query::class, $actual);
    }


    /**
     * Test getStudentAnnualPromotions method
     *
     * @return void
     */
    public function testGetStudentAnnualPromotions()
    {
        $expected = [
            'id' => '001',
            'first_name' => 'Omebe',
            'last_name' => 'Johnbosco',
            'student_annual_positions' => []
        ];
        $this->assertEquals($expected['id'],$this->Students->getStudentAnnualPromotions(['term_id'=>1,'session_id'=>1,'class_id'=>1])[0]['id']);
    }
}
