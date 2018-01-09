<?php
namespace ResultSystem\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use ResultSystem\Controller\StudentsController;

/**
 * ResultSystem\Controller\StudentsController Test Case
 */
class StudentsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.students',
        'app.sessions',
        'app.classes',
        'app.subjects',
        'app.blocks',
        'app.class_demarcations',
        'plugin.result_system.student_annual_results',
        'plugin.result_system.student_termly_results',
        'plugin.result_system.student_result_pins',
        'plugin.result_system.student_termly_positions',
        'plugin.result_system.student_termly_subject_positions',
        'plugin.result_system.student_termly_subject_position_on_class_demarcations',
        'plugin.skills_grading_system.affective_dispositions',
        'plugin.skills_grading_system.psychomotor_skills',
        'plugin.skills_grading_system.students_affective_disposition_scores',
        'plugin.skills_grading_system.students_psychomotor_skill_scores',
        'plugin.result_system.student_annual_position_on_class_demarcations',
        'plugin.result_system.student_annual_positions',
        'plugin.result_system.student_annual_subject_position_on_class_demarcations',
        'plugin.result_system.student_annual_subject_positions',
        'plugin.result_system.student_class_counts',
        'plugin.result_system.subject_class_averages',
        'plugin.result_system.student_general_remarks',
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
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/result-system/students');
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
        $this->get('/result-system/view-student-result/SMS/2017/001?session_id=1&class_id=1');
        $this->assertResponseOk();
        //$this->assertResponseContains('SMS/2017/001');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $data = [
            0 => [
                'first_test' => '6',
                'second_test' => '6.5',
                'third_test' => '3',
                'exam' => '23',
                'student_id' => 'SMS/2017/003',
                'subject_id' => '5',
                'class_id' => '1',
                'term_id' => '1',
                'session_id' => '1'
            ],
            1 => [
                'first_test' => '5',
                'second_test' => '8',
                'third_test' => '9',
                'exam' => '10',
                'student_id' => 'SMS/2017/003',
                'subject_id' => '6',
                'class_id' => '1',
                'term_id' => '1',
                'session_id' => '1'
            ],
        ];
        $this->post('/result-system/add-student-result/SMS/2017/003',$data);
        $this->assertResponseSuccess();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->get('/result-system/edit-student-result/SMS/2017/001?session_id=1&class_id=1');
        $this->assertResponseOk();
        $this->assertResponseContains('SMS/2017/001');

        $data = [
            0 => [
                'first_test' => '6',
                'second_test' => '6.5',
                'third_test' => '3',
                'exam' => '23',
                'student_id' => 'SMS/2017/001',
                'subject_id' => '5',
                'class_id' => '1',
                'term_id' => '1',
                'session_id' => '1'
            ],
            1 => [
                'first_test' => '5',
                'second_test' => '8',
                'third_test' => '9',
                'exam' => '10',
                'student_id' => 'SMS/2017/001',
                'subject_id' => '6',
                'class_id' => '1',
                'term_id' => '1',
                'session_id' => '1'
            ],
        ];
        $this->post('/result-system/edit-student-result/SMS/2017/001?session_id=1&class_id=1',$data);
        $this->assertResponseSuccess();
    }

    public function testViewStudentResult()
    {
        $this->session([
            'Student' => [
                'id' => 'SMS/2017/002',
                'session_id' => 1,
                'class_id' => 1,
                'term_id' => 1
            ]
        ]);
        $this->get('/result-system/student-result');
        $this->assertResponseOk();
    }

    public function testCheckResult()
    {
        $data = [
            'reg_number' => 'SMS/2017/002',
            'pin' => 123456,
            'session_id' => 1,
            'class_id' => 1,
            'term_id' => 1
        ];
        $this->post('/result-system/check-student-result',$data);
        $this->assertRedirect(['action' => 'viewStudentResult']);
        $sessions = [
            'id' => 'SMS/2017/002',
            'session_id' => 1,
            'class_id' => 1,
            'term_id' => 1
        ];
        $this->assertSession($sessions, 'Student');
        //$this->assertResponseContains('Incorrect registration number or Invalid pin');
    }

    public function testCheckResultWithExistingData()
    {
        $data = [
            'reg_number' => 'SMS/2017/001',
            'pin' => 123457,
            'session_id' => 1,
            'class_id' => 1,
            'term_id' => 1
        ];
        $this->post('/result-system/check-student-result',$data);
        $this->assertRedirect(['action' => 'viewStudentResult']);
        $sessions = [
            'id' => 'SMS/2017/001',
            'session_id' => 1,
            'class_id' => 1,
            'term_id' => 1
        ];
        $this->assertSession($sessions, 'Student');
    }

    public function testCheckResultFailedTermWithExistingData()
    {
        $data = [
            'reg_number' => 'SMS/2017/001',
            'pin' => 123457,
            'session_id' => 1,
            'class_id' => 1,
            'term_id' => 2
        ];
        $this->post('/result-system/check-student-result',$data);
        $this->assertResponseContains('This pin belongs to you but the term is incorrect. Check and try again');
    }

    public function testCheckResultFailedClassWithExistingData()
    {
        $data = [
            'reg_number' => 'SMS/2017/001',
            'pin' => 123457,
            'session_id' => 1,
            'class_id' => 2,
            'term_id' => 1
        ];
        $this->post('/result-system/check-student-result',$data);
        $this->assertResponseContains('This pin belongs to you but the class is incorrect. Check and try again');
    }

    public function testCheckResultFailedSessionWithExistingData()
    {
        $data = [
            'reg_number' => 'SMS/2017/001',
            'pin' => 123457,
            'session_id' => 2,
            'class_id' => 1,
            'term_id' => 1
        ];
        $this->post('/result-system/check-student-result',$data);
        $this->assertResponseContains('This pin belongs to you but the session is incorrect. Check and try again');
    }

    public function testCheckResultFailedRegistrationNumberWithExistingData()
    {
        $data = [
            'reg_number' => 'SMS/2017/002',
            'pin' => 123457,
            'session_id' => 2,
            'class_id' => 1,
            'term_id' => 1
        ];
        $this->post('/result-system/check-student-result',$data);
        $this->assertResponseContains('Incorrect registration number or Invalid pin');
    }

    public function testCheckResultFailedRegistrationNumberWithPostData()
    {
        $data = [
            'reg_number' => 'SMS/2017/015',
            'pin' => 123456,
            'session_id' => 1,
            'class_id' => 1,
            'term_id' => 1
        ];
        $this->post('/result-system/check-student-result',$data);
        $this->assertResponseContains('Incorrect registration number or Invalid pin');
    }

}
