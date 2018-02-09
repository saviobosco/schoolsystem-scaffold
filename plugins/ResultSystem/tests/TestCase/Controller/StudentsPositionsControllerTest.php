<?php
namespace ResultSystem\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use ResultSystem\Controller\StudentsPositionsController;

/**
 * ResultSystem\Controller\StudentsPositionsController Test Case
 */
class StudentsPositionsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.student_termly_positions',
        'plugin.result_system.student_annual_positions',
        'plugin.result_system.sessions',
        'plugin.result_system.classes',
        'plugin.result_system.terms',
        'plugin.result_system.students',

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
        $this->enableCsrfToken();
    }

    public function testIndex()
    {
        $this->get('/result-system/students-positions?session_id=1&class_id=1&term_id=1');
        //$this->assertResponseOk();
        $this->assertResponseContains('001');
    }
}
