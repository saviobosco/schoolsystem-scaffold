<?php
namespace StudentsManager\Test\TestCase\Model\Table;

use Cake\I18n\Time;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use StudentsManager\Model\Table\StudentsTable;

/**
 * StudentsManager\Model\Table\StudentsTable Test Case
 */
class StudentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \StudentsManager\Model\Table\StudentsTable
     */
    public $Students;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.students_manager.students',
        'plugin.students_manager.sessions',
        'plugin.students_manager.classes',
        'plugin.students_manager.class_demarcations',
        'plugin.students_manager.states',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Students') ? [] : ['className' => 'StudentsManager\Model\Table\StudentsTable'];
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

    public function testAddStudent()
    {
        // test hte addStudent function
        $student = new Entity([
            'id'=>1000,
            'first_name' => 'Omebe',
            'last_name' => 'Johnbosco',
            'class_id' => 1,
            'created' => Time::now(),
            'modified' => Time::now()
        ]);
        $this->assertInstanceOf(Entity::class,$this->Students->addStudent($student));
    }

    public function testFindUnActiveStudents()
    {
        $result = [
            [
                'id' => 1000,
                'first_name' => 'Omebe',
                'last_name' => 'Johnbosco',
                'gender' => null,
                'class_id' => 1,
            ]
        ];
        $this->assertEquals($result,$this->Students->findUnActiveStudents());
        //$this->assertArraySubset($result,$this->Students->findUnActiveStudents());
    }

    public function testDeactivateStudent()
    {
        $student = $this->Students->get(1000);
        $this->assertEquals(true,$this->Students->deactivateStudent($student));
    }

    public function testActivateStudent()
    {
        $student = $this->Students->get(1000);
        $this->assertEquals(true,$this->Students->deactivateStudent($student));
    }

    public function testChangeStudentsClass()
    {
        $student_ids = [1000];
        $class = 2;
        $this->assertEquals(['success'=>1],$this->Students->changeStudentsClass($class,$student_ids));
    }

    public function testChangeStudentsClassFailed()
    {
        $student_ids = [1000];
        $class = 1;
        $this->assertEquals(['success'=>0],$this->Students->changeStudentsClass($class,$student_ids));
    }
}
