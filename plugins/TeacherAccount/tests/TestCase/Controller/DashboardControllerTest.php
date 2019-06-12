<?php
namespace TeacherAccount\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use TeacherAccount\Controller\DashboardController;

/**
 * TeacherAccount\Controller\DashboardController Test Case
 */
class DashboardControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.users_manager.users',
        'plugin.result_system.subjects',
        'plugin.class_manager.classes',
        'plugin.teacher_account.teachers_subjects',
        'plugin.teacher_account.teachers_classes',
        'plugin.users_manager.teachers_subjects_classes_permissions',
        'plugin.subjects_manager.blocks',
        'plugin.result_system.sessions',
        'plugin.result_system.terms',
    ];

    /**
     * Test initial setup
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 2,
                    'username' => 'Teacher 1',
                    'first_name' => '',
                    'last_name' => '',
                    'photo' => '',
                    'role' => 'teacher',
                    'super_user' => 0
                    // other keys.
                ]
            ]
        ]);
        $this->disableErrorHandlerMiddleware();
    }

    public function testIndex()
    {
        $this->get('/teacher-account/dashboard');
        $this->assertResponseCode(200);
    }
}
