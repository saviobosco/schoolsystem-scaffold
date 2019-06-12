<?php
namespace StudentsManager\Test\TestCase\Model\Table;

use Cake\Event\EventList;
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
        'plugin.users_manager.users',
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
        $this->Students->getEventManager()->setEventList(new EventList());
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
            'id'=> '003',
            'first_name' => 'Ifeanyi',
            'last_name' => 'Omebe',
            'class_id' => 1,
            'created' => Time::now(),
            'modified' => Time::now()
        ]);
        $savedStudent = $this->Students->addStudent($student);
        $this->assertInstanceOf(Entity::class, $savedStudent);
        $this->assertEventFired(StudentsTable::EVENT_ADDED_STUDENT, $this->Students->
        getEventManager());
        $this->assertEventFiredWith(StudentsTable::EVENT_ADDED_STUDENT, 'student', $savedStudent, $this->Students->getEventManager());
    }

    public function testAddStudentFailedDuplicate()
    {
        // test hte addStudent function
        $student = new Entity([
            'id'=> '001',
            'first_name' => 'Ifeanyi',
            'last_name' => 'Omebe',
            'class_id' => 1,
            'created' => Time::now(),
            'modified' => Time::now()
        ]);
        $savedStudent = $this->Students->addStudent($student);
        $this->assertEquals(false, $savedStudent);
    }

    public function testFindUnActiveStudents()
    {
        $result = [
            'id' => '001',
            'first_name' => 'Omebe',
            'last_name' => 'Johnbosco',
            'gender' => null,
            'class_id' => 1,
        ];
        $this->assertEquals($result['id'],$this->Students->findUnActiveStudents()[0]['id']);
    }

    public function testDeactivateStudent()
    {
        $student = $this->Students->get('001');
        $this->assertEquals(true,$this->Students->deactivateStudent($student));
        $this->assertEventFired(StudentsTable::EVENT_DEACTIVATED_STUDENT, $this->Students->
        getEventManager());
        $this->assertEventFiredWith(StudentsTable::EVENT_DEACTIVATED_STUDENT, 'student', $student, $this->Students->getEventManager());
    }

    public function testActivateStudent()
    {
        $student = $this->Students->get('001');
        $this->assertEquals(true, $this->Students->activateStudent($student));
        $this->assertEventFired(StudentsTable::EVENT_ACTIVATED_STUDENT, $this->Students->
        getEventManager());
        $this->assertEventFiredWith(StudentsTable::EVENT_ACTIVATED_STUDENT, 'student', $student, $this->Students->getEventManager());
    }

    public function testChangeStudentsClass()
    {
        $student_ids = ['001'];
        $class = 2;
        $this->assertEquals(['success'=>1], $this->Students->changeStudentsClass($class, $student_ids));
        $this->assertEquals(2, $this->Students->get('001')['class_id']);
    }

    public function testChangeStudentsClassFailed()
    {
        $student_ids = ['001'];
        $class = 1;
        $this->assertEquals(['success'=>0], $this->Students->changeStudentsClass($class, $student_ids));
    }
}
