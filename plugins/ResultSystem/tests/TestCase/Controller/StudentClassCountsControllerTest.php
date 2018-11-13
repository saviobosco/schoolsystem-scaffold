<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 11/6/18
 * Time: 11:23 AM
 */

namespace ResultSystem\Test\TestCase\Controller;


use Cake\TestSuite\IntegrationTestCase;

class StudentClassCountsControllerTest extends IntegrationTestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.student_class_counts',
        'plugin.result_system.sessions',
        'plugin.result_system.classes',
        'plugin.result_system.terms',
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
        $this->get('/result-system/students-class-count');
        $this->assertResponseOk();
    }

    public function testAdd()
    {
        $data = [
            'session_id' => 1,
            'class_id' => 1,
            'term_id' => 1,
            'student_count' => 30
        ];
        $this->post('/result-system/students-class-count?session_id=1&term_id=1&class_id=1', $data);
        $this->assertSession('Students Count was successfully saved!', 'Flash.flash.0.message');
        $this->assertRedirect();
    }

    public function testUpdate()
    {
        $data = [
            'session_id' => 1,
            'class_id' => 1,
            'term_id' => 1,
            'student_count' => 30
        ];
        $this->put('/result-system/students-class-count?session_id=1&term_id=1&class_id=1', $data);
        $this->assertSession('Students Count was successfully saved!', 'Flash.flash.0.message');
        $this->assertRedirect();
    }
}