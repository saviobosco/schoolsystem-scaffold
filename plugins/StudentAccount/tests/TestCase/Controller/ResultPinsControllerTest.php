<?php
namespace StudentAccount\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use StudentAccount\Controller\ResultPinsController;

/**
 * StudentAccount\Controller\ResultPinsController Test Case
 */
class ResultPinsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.student_account.student_result_pins',
        'plugin.result_system.students',
        'plugin.result_system.sessions',
        'plugin.result_system.classes',
        'plugin.result_system.subjects',
        'plugin.result_system.terms',
        'plugin.result_system.class_demarcations',
        'plugin.result_system.student_annual_results',
        'plugin.result_system.student_termly_results',
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
                    'id' => '001',
                    'first_name' => 'Omebe',
                    'last_name' => 'Johnbosco',
                    'date_of_birth' => '2019-02-22',
                    'gender' => 'Lorem ipsum dolor sit amet',
                    'state_of_origin' => 'Lorem ipsum dolor sit amet',
                    'religion_id' => 1,
                    'home_residence' => 'Lorem ipsum dolor sit amet',
                    'guardian' => 'Lorem ipsum dolor sit amet',
                    'relationship_to_guardian' => 'Lorem ipsum dolor sit amet',
                    'occupation_of_guardian' => 'Lorem ipsum dolor sit amet',
                    'guardian_phone_number' => 'Lorem ipsum d',
                    'class_id' => 1,
                    'class_demarcation_id' => 1,
                    'photo' => 'Lorem ipsum dolor sit amet',
                    'photo_dir' => 'Lorem ipsum dolor sit amet',
                    'created' => '2019-02-22 13:11:42',
                    'modified' => '2019-02-22 13:11:42',
                    'status' => 1,
                    'state_id' => 1
                ]
            ]
        ]);
        $this->disableErrorHandlerMiddleware();
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/student-account/result-pins');
        $this->assertResponseOk();
        $this->assertResponseContains('1234567890');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/student-account/result-pins/view?pin=1234567890&class_id=1&session_id=1&term_id=1');
        $this->assertResponseOk();
        $this->assertResponseContains('Omebe Johnbosco');
    }
}
