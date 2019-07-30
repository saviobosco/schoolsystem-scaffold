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
        'plugin.result_system.sessions',
        'plugin.result_system.classes',
        'plugin.result_system.subjects',
        'plugin.result_system.terms',
        'plugin.result_system.class_demarcations',
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
        'plugin.result_system.result_grade_inputs',
        'plugin.result_system.result_remark_inputs',
        'plugin.grading_system.result_grading_systems',
        'plugin.result_system.student_publish_results',
        'plugin.skills_grading_system.affective_dispositions',
        'plugin.skills_grading_system.psychomotor_skills'
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
                ]
            ]
        ]);
        $this->enableRetainFlashMessages();
        $this->enableCsrfToken();
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

    public function testSearchByStudentNameInIndex()
    {
        $this->get('/result-system/students?_name=Omebe');
        $this->assertResponseContains('Johnbosco');
        $this->assertResponseContains('Ifeanyi');
    }

    public function testSearchByClass()
    {
        $this->get('/result-system/students?class_id=1');
        $this->assertResponseContains('Omebe');
    }


    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/result-system/view-student-result/001?session_id=1&class_id=1&term_id=1');
        $this->assertResponseOk();
        $this->assertResponseContains('Omebe Johnbosco');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $data = [
            'student_termly_results' => [
                1 => [
                    'first_test' => '9',
                    'second_test' => '9',
                    'third_test' => '9',
                    'fourth_test' => '9',
                    'exam' => '60',
                    'student_id' => '001',
                    'subject_id' => '1',
                    'class_id' => '1',
                    'term_id' => '2',
                    'session_id' => '1'
                ],
                2 => [
                    'first_test' => '9',
                    'second_test' => '9',
                    'third_test' => '9',
                    'fourth_test' => '9',
                    'exam' => '49',
                    'student_id' => '001',
                    'subject_id' => '2',
                    'class_id' => '1',
                    'term_id' => '2',
                    'session_id' => '1'
                ],
                3 => [
                    'first_test' => '5',
                    'second_test' => '7',
                    'third_test' => '8',
                    'fourth_test' => '9',
                    'exam' => '40',
                    'student_id' => '001',
                    'subject_id' => '3',
                    'class_id' => '1',
                    'term_id' => '2',
                    'session_id' => '1'
                ],
            ],
            'student_general_remarks' => [
                0 => [
                    'student_id' => '001',
                    'class_id' => '1',
                    'term_id' => '2',
                    'session_id' => '1',
                    'remark_1' => 'A good student',
                    'remark_2' => 'Keep it up',
                    'remark_3' => 'Try harder'
                ]
            ]
        ];
        $this->post('/result-system/add-student-result/001?session_id=1&class_id=1&term_id=2',$data);
        $this->assertRedirect();
        $this->assertSession('The student results and remarks has been saved.', 'Flash.flash.0.message');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $data = [
            'student_termly_results' => [
                1 => [
                    'first_test' => '9',
                    'second_test' => '9',
                    'third_test' => '9',
                    'fourth_test' => '9',
                    'exam' => '60',
                    'student_id' => '001',
                    'subject_id' => '1',
                    'class_id' => '1',
                    'term_id' => '1',
                    'session_id' => '1'
                ],
                2 => [
                    'first_test' => '9',
                    'second_test' => '9',
                    'third_test' => '9',
                    'fourth_test' => '9',
                    'exam' => '49',
                    'student_id' => '001',
                    'subject_id' => '2',
                    'class_id' => '1',
                    'term_id' => '1',
                    'session_id' => '1'
                ],
                3 => [
                    'first_test' => '5',
                    'second_test' => '7',
                    'third_test' => '8',
                    'fourth_test' => '9',
                    'exam' => '40',
                    'student_id' => '001',
                    'subject_id' => '3',
                    'class_id' => '1',
                    'term_id' => '1',
                    'session_id' => '1'
                ],
            ],
            'student_general_remarks' => [
                0 => [
                    'student_id' => '001',
                    'class_id' => '1',
                    'term_id' => '1',
                    'session_id' => '1',
                    'remark_1' => 'A good student',
                    'remark_2' => 'Keep it up',
                    'remark_3' => 'Try harder'
                ]
            ]
        ];
        $this->put('/result-system/edit-student-result/001?session_id=1&class_id=1&term_id=1',$data);
        $this->assertRedirect();
        $this->assertSession('The student has been saved.', 'Flash.flash.0.message');
    }

    public function testViewStudentResultForAdmin()
    {
        $this->get('/result-system/student-result-format/001?session_id=1&class_id=1&term_id=1');
        $this->assertResponseOk();
    }

    /** @test */
    public function testPrintStudentsResultsForTermly()
    {
        $this->get('/result-system/print-students-results?session_id=1&class_id=1&term_id=1');
        $this->assertResponseOk();
        $this->assertResponseContains('001');
        $this->assertResponseContains('002');
        $this->assertResponseContains('003');
    }

    /** @test */
    public function testPrintStudentsResultsForAnnual()
    {
        $this->get('/result-system/print-students-results?session_id=1&class_id=1&term_id=4');
        $this->assertResponseOk();
        $this->assertResponseContains('001');
        $this->assertResponseContains('002');
        $this->assertResponseContains('003');
    }

    public function testDeleteStudentResults()
    {
        $this->delete('/result-system/delete-student-result/001?session_id=1&class_id=1&term_id=1');
        $this->assertRedirect();
        $this->assertSession('The student results was successfully deleted.', 'Flash.flash.0.message');
    }
}
