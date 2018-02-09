<?php
namespace StudentsManager\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use StudentsManager\Controller\StudentsClassController;

/**
 * StudentsManager\Controller\StudentsClassController Test Case
 */
class StudentsClassControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.students_manager.students',
        'plugin.students_manager.classes'
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



    public function testChangeStudentClass()
    {
        $this->get('/students/change-students-class?class_id=1');
        $this->assertResponseContains('Omebe Ebuka');
        $this->assertResponseOk();
    }

    public function testChangeStudentClassPost()
    {
        $data = [
            'student_ids'=>[1005],
            'change_class_id'=> 2
        ];
        $this->post('/students/change-students-class?class_id=1',$data);
        $this->assertSession('The selected students class was successfully changed', 'Flash.flash.0.message');
        $this->assertRedirect();
    }
}
