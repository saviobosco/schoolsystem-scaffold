<?php
namespace StudentsManager\Test\TestCase\Controller;

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
                    'role' => 'admin',
                    'super_user' => 1
                    // other keys.
                ]
            ]
        ]);
        $this->enableRetainFlashMessages();
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/students');
        $this->assertResponseOk();
        $this->assertResponseContains('Students');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/students/view/1000');
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
            'id' => 1001,
            'first_name' => 'Iwueze',
            'last_name' => 'Ifeoma',
            'class_id' => 1,
            'gender' => 'male'
        ];
        $this->post('/students/add',$data);
        $this->assertRedirect(['action'=>'index']);
        $this->assertSession('The student has been saved.', 'Flash.flash.0.message');
    }

    public function testAddWithRedirect()
    {
        $data = [
            'id' => 1002,
            'first_name' => 'Iwueze',
            'last_name' => 'Ifeoma',
            'class_id' => 1,
            'return_here' => 1,
            'gender' => 'male'
        ];
        $this->post('/students/add',$data);
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
        $this->post('/students/edit/1000',$data);
        $this->assertResponseOk();
        $this->assertSession('The student has been saved.', 'Flash.flash.0.message');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->delete('/students/delete/1000');
        $this->assertRedirect();
        $this->assertSession('The student has been deleted.', 'Flash.flash.0.message');
    }
}
