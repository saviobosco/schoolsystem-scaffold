<?php
namespace TeacherAccount\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use TeacherAccount\Controller\StudentsResultsController;

/**
 * TeacherAccount\Controller\StudentsResultsController Test Case
 */
class StudentsResultsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.sessions',
        'plugin.result_system.classes',
        'plugin.result_system.terms',
        'plugin.result_system.subjects',
        'plugin.result_system.result_grade_inputs',
        'plugin.result_system.students',
        'plugin.result_system.student_termly_results',
        'plugin.result_system.student_annual_results',
        'plugin.result_system.student_termly_subject_positions',
        'plugin.teacher_account.teachers_subjects',
        'plugin.teacher_account.teachers_classes',
        'plugin.users_manager.teachers_subjects_classes_permissions',
        'plugin.subjects_manager.blocks',
        'plugin.grading_system.result_grading_systems'
    ];

    public function setUp()
    {
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
        $this->enableRetainFlashMessages();
    }

    public function testAdd()
    {
        $this->get('/teacher-account/students-results/add?class_id=1&session_id=1&subject_id=1&term_id=3');
        $this->assertResponseOk();
        $this->assertResponseContains('001');
    }

    public function testPostAdd()
    {
        $postData = [
            'student_termly_results' => [
                '001' => [
                    'first_test' => '4',
                    'second_test' => '5',
                    'third_test' => '4',
                    'fourth_test' => '4',
                    'exam' => '34',
                    'student_id' => '001',
                    'subject_id' => '1',
                    'class_id' => '1',
                    'term_id' => '2',
                    'session_id' => '1'
                ],
                '002' => [
                    'first_test' => '4',
                    'second_test' => '5',
                    'third_test' => '4',
                    'fourth_test' => '4',
                    'exam' => '34',
                    'student_id' => '002',
                    'subject_id' => '1',
                    'class_id' => '1',
                    'term_id' => '2',
                    'session_id' => '1'
                ],
                '003' => [
                    'first_test' => '4',
                    'second_test' => '5',
                    'third_test' => '4',
                    'fourth_test' => '4',
                    'exam' => '34',
                    'student_id' => '003',
                    'subject_id' => '1',
                    'class_id' => '1',
                    'term_id' => '2',
                    'session_id' => '1'
                ]
            ]
        ];
        $this->post('/teacher-account/students-results/add?class_id=1&session_id=1&subject_id=1&term_id=2', $postData);
        $this->assertSession('The results were successfully added!', 'Flash.flash.0.message');
    }


    public function testEdit()
    {
        $this->get('/teacher-account/students-results/edit?class_id=1&session_id=1&subject_id=1&term_id=1');
        $this->assertResponseOk();
        $this->assertResponseContains('001');
    }

    public function testEditPut()
    {
        $postData = [
            'student_termly_results' => [
                '001' => [
                    'first_test' => '4',
                    'second_test' => '5',
                    'third_test' => '4',
                    'fourth_test' => '4',
                    'exam' => '34',
                    'student_id' => '001',
                    'subject_id' => '1',
                    'class_id' => '1',
                    'term_id' => '2',
                    'session_id' => '1'
                ],
            ]
        ];
        $this->put('/teacher-account/students-results/edit?class_id=1&session_id=1&subject_id=1&term_id=1', $postData);
        $this->assertSession('The subject termly results was successfully updated.', 'Flash.flash.0.message');
    }

    public function testEditPutAnnualResult()
    {
        $postData = [
            'student_annual_results' => [
                '001' => [
                    'id' => 1,
                    'student_id' => '001',
                    'subject_id' => 1,
                    'first_term' => 92,
                    'second_term' => '',
                    'third_term' => '',
                    'class_id' => 1,
                    'session_id' => 1,
                ],
            ]
        ];
        $this->put('/teacher-account/students-results/edit?class_id=1&session_id=1&subject_id=1&term_id=4', $postData);
        $this->assertSession('The subject annual results was successfully updated.', 'Flash.flash.0.message');
    }
}
