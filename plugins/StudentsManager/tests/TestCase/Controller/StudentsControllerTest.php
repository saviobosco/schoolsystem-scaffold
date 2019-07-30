<?php
namespace StudentsManager\Test\TestCase\Controller;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use StudentsManager\Controller\StudentsController;

/**
 * StudentsManager\Controller\StudentsController Test Case
 */
class StudentsControllerTest extends IntegrationTestCase
{

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
        'plugin.students_manager.religions',
        'plugin.users_manager.users'
    ];

    public function setUp()
    {
        parent::setUp();
        // Set session data
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'username' => 'testing',
                    'role' => 'superuser',
                    'super_user' => 1
                    // other keys.
                ]
            ]
        ]);
        $this->enableRetainFlashMessages();
        $this->disableErrorHandlerMiddleware();
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/students-manager');
        $this->assertResponseOk();
        $this->assertResponseContains('Omebe');
    }

    public function testSearchByStudentNameInIndex()
    {
        $this->get('/students-manager?_name=Omebe');
        $this->assertResponseContains('Ebuka');
        $this->assertResponseContains('Johnbosco');
    }

    public function testSearchByClass()
    {
        $this->get('/students-manager?class_id=1');
        $this->assertResponseContains('Omebe');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/students-manager/view/001');
        $this->assertResponseOk();
        $this->assertResponseContains('Omebe');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $data = [
            'id' => '003',
            'first_name' => 'Iwueze',
            'last_name' => 'Ifeoma',
            'class_id' => 1,
            'session_id' => 1,
            'gender' => 'female'
        ];
        $this->post('/students-manager/add',$data);
        $this->assertRedirect(['action'=>'index']);
        $this->assertSession('The student has been saved.', 'Flash.flash.0.message');
    }

    public function testAddReturnBack()
    {
        $data = [
            'id' => '003',
            'first_name' => 'Iwueze',
            'last_name' => 'Ifeoma',
            'class_id' => 1,
            'return_here' => 1,
            'gender' => 'female',
            'session_id' => 1,
        ];
        $this->post('/students-manager/add',$data);
        $this->assertRedirect(['action'=>'add']);
        $this->assertSession('The student has been saved.', 'Flash.flash.0.message');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $data = [
            'first_name' => 'Omebe',
            'last_name' => 'Ebuka',
            'class_id' => 1,
        ];
        $this->post('/students-manager/edit/001',$data);
        $this->assertResponseOk();
        $this->assertSession('The student has been saved.', 'Flash.flash.0.message');
        $studentTable = TableRegistry::get('StudentsManager.Students');
        $student = $studentTable->get('001');
        $this->assertEquals($data['last_name'],$student['last_name']);
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->delete('/students-manager/delete/001');
        $this->assertRedirect();
        $this->assertSession('The student has been deleted.', 'Flash.flash.0.message');
    }
}
