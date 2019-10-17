<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 12/7/18
 * Time: 8:15 PM
 */

namespace ResultSystem\Test\TestCase\Controller;


use Cake\Chronos\Chronos;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\TestSuite\IntegrationTestCase;
use ResultSystem\Controller\CheckResultController;
use Settings\Core\Setting;

class CheckResultControllerTest extends IntegrationTestCase
{
    public $fixtures = [
        'plugin.result_system.students',
        'plugin.result_system.sessions',
        'plugin.result_system.classes',
        'plugin.result_system.subjects',
        'plugin.result_system.terms',
        'plugin.result_system.student_annual_results',
        'plugin.result_system.student_termly_results',
        'plugin.result_system.student_result_pins',
        'plugin.result_system.student_positions',
        'plugin.result_system.student_subject_positions',
        'plugin.skills_grading_system.affective_dispositions',
        'plugin.skills_grading_system.psychomotor_skills',
        'plugin.skills_grading_system.students_affective_disposition_scores',
        'plugin.skills_grading_system.students_psychomotor_skill_scores',
        'plugin.result_system.student_class_counts',
        'plugin.result_system.subject_class_averages',
        'plugin.result_system.student_general_remarks',
        'plugin.result_system.result_grade_inputs',
        'plugin.result_system.result_remark_inputs',
        'plugin.grading_system.result_grading_systems',
        'plugin.result_system.student_publish_results',
        'plugin.skills_grading_system.affective_dispositions',
        'plugin.skills_grading_system.psychomotor_skills',
        'plugin.result_system.settings_configurations'
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
        $this->disableErrorHandlerMiddleware();
    }

    public function testCheckResult()
    {
        $postData = [
            'pin' => 123456,
            'admission_number' => '001',
            'class_id' => 1,
            'session_id' => 1,
            'term_id' => 1
        ];
        $this->post('/result-system/check-result/check-result', $postData);
        $this->assertRedirect('/result-system/view-student-result-sheet?id=001&session_id=1&class_id=1&term_id=1&ts='.Chronos::now()->timestamp);
        $this->assertResponseCode(302);
    }

    public function testCheckResultFailedCauseOfUsedPin()
    {
        $postData = [
            'pin' => 123457,
            'admission_number' => '002',
            'class_id' => 1,
            'session_id' => 1,
            'term_id' => 1
        ];
        $this->post('/result-system/check-result/check-result', $postData);
        $this->assertRedirect('/');
        $this->assertResponseCode(302);
        $this->assertSession('Sorry this pin has been used by another student.', 'Flash.flash.0.message');
    }

    public function testViewStudentResult()
    {
        $timestamp = Chronos::now()->timestamp;
         Cache::write('001-'.$timestamp,[
             'id' => '001',
             'class_id' => 1,
             'session_id' => 1,
             'term_id' => 1
        ]);
        $this->get('/result-system/check-result/view-student-result?id=001&session_id=1&class_id=1&term_id=1&ts='.$timestamp);
        $this->assertResponseOk();
    }

    public function testCheckResultFailedCauseOfWrongSession()
    {
        $postData = [
            'pin' => 123457,
            'admission_number' => '001',
            'class_id' => 1,
            'session_id' => 2,
            'term_id' => 1
        ];
        $this->post('/result-system/check-result/check-result', $postData);
        $this->assertRedirect('/');
        $this->assertResponseCode(302);
        $this->assertSession('This pin has been used by you, but the session selected is incorrect. Please try again', 'Flash.flash.0.message');
    }

    public function testCheckResultFailedCauseOfWrongSelectedClass()
    {
        $postData = [
            'pin' => 123457,
            'admission_number' => '001',
            'class_id' => 2,
            'session_id' => 1,
            'term_id' => 1
        ];
        $this->post('/result-system/check-result/check-result', $postData);
        $this->assertRedirect('/');
        $this->assertResponseCode(302);
        $this->assertSession('This pin has been used by you, but the class selected is incorrect. Please try again', 'Flash.flash.0.message');
    }

    public function testCheckResultPassedWithSelectedTerm()
    {
        Setting::write('Application.use_result_pin_for_all_terms', 1);
        Configure::write('ResultPin.allTerms', true);
        $postData = [
            'pin' => 123457,
            'admission_number' => '001',
            'class_id' => 1,
            'session_id' => 1,
            'term_id' => 2
        ];
        $this->post('/result-system/check-result/check-result', $postData);
        $this->assertRedirect('/result-system/view-student-result-sheet?id=001&session_id=1&class_id=1&term_id=2&ts='.Chronos::now()->timestamp);
        $this->assertResponseCode(302);
    }

    public function testCheckResultFailedCauseOfWrongTermSelected()
    {
        Setting::write('Application.use_result_pin_for_all_terms', 0);
        $postData = [
            'pin' => 123457,
            'admission_number' => '001',
            'class_id' => 1,
            'session_id' => 1,
            'term_id' => 2
        ];
        $this->post('/result-system/check-result/check-result', $postData);
        $this->assertRedirect('/');
        $this->assertResponseCode(302);
        $this->assertSession('This pin has been used by you, but the term selected is incorrect. Please try again', 'Flash.flash.0.message');
    }

    public function testCheckResultFailedCauseOfNonExistingStudent()
    {
        $postData = [
            'pin' => 123456,
            'admission_number' => '1000',
            'class_id' => 1,
            'session_id' => 1,
            'term_id' => 2
        ];
        $this->post('/result-system/check-result/check-result', $postData);
        $this->assertRedirect('/');
        $this->assertResponseCode(302);
        $this->assertSession('The registration number does not exist.', 'Flash.flash.0.message');
    }

    public function testGetStudent()
    {
        $this->get('/result-system/check-result/get-student?student_id=001');
        $this->assertResponseCode(200);
        $this->assertContentType('application/json');
        $this->assertResponseContains('001');
    }

    public function testGetStudentFailedBecauseNoStudentIdQuery()
    {
        $this->get('/result-system/check-result/get-student?student_id=');
        $this->assertResponseCode(400);
        $this->assertContentType('application/json');
        $this->assertResponseContains('Missing required detail');
    }

    public function testGetStudentResultSessions()
    {
        $this->get('/result-system/check-result/get-student-result-sessions?student_id=001&class_id=1');
        $this->assertResponseCode(200);
        $this->assertContentType('application/json');
        $this->assertResponseContains('1');
    }

    public function testGetStudentResultSessionsFailed()
    {
        $this->get('/result-system/check-result/get-student-result-sessions?student_id=001&class_id=');
        $this->assertResponseCode(400);
        $this->assertContentType('application/json');
        $this->assertResponseContains('Missing required detail');
    }

    public function testGetStudentResultTerms()
    {
        $this->get('/result-system/check-result/get-student-result-terms?student_id=001&class_id=1&session_id=1');
        $this->assertResponseCode(200);
        $this->assertContentType('application/json');
        $this->assertResponseContains('1');
    }

    public function testGetStudentResultTermsFailed()
    {
        $this->get('/result-system/check-result/get-student-result-terms?student_id=001&class_id=1&session_id=');
        $this->assertResponseCode(400);
        $this->assertContentType('application/json');
        $this->assertResponseContains('Missing required detail');
    }

}