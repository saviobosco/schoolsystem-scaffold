<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 7/13/17
 * Time: 3:35 PM
 */

namespace ResultSystem\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use ResultSystem\Controller\ResultGradingSystemsController;

/**
 * ResultSystem\Controller\ResultProcessingController Test Case
 */
class ResultProcessingControllerTest extends IntegrationTestCase
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
        'plugin.result_system.class_demarcations',
        'plugin.result_system.subjects',
        'plugin.grading_system.result_grading_systems',
        'plugin.result_system.student_annual_results',
        'plugin.result_system.terms',
        'plugin.result_system.student_termly_results',
        'plugin.result_system.student_termly_positions',
        'plugin.result_system.student_termly_position_on_class_demarcations',
        'plugin.result_system.student_termly_subject_positions',
        'plugin.result_system.student_termly_subject_position_on_class_demarcations',
        'plugin.result_system.student_class_counts',
        'plugin.result_system.subject_class_averages',
        'plugin.result_system.student_class_counts',
        'plugin.result_system.student_annual_positions',
        'plugin.result_system.student_annual_subject_positions',
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

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('result-system/result-processing');
        $this->assertResponseOk();
    }

   /** @test */
    public function testProcessTermlyResults()
    {
        $data = [
            'session_id' => 1,
            'class_id' => 1,
            'term_id' => 1,
            'no_of_subjects' => 3,
            'cal_student_total' => true,
            'cal_student_position' => true,
            'cal_subject_position' => true,
            'cal_class_average' => true,
            'cal_class_count' => true,
        ];
        $this->post('result-system/result-processing/process-termly-result',$data);
        $this->assertRedirect();
        $this->assertSession('Successfully Calculated the students termly results ', 'Flash.flash.0.message');
        $this->assertSession('Successfully calculated the students positions', 'Flash.flash.1.message');
        $this->assertSession('Successfully calculated the students subject positions', 'Flash.flash.2.message');
        $this->assertSession('Successfully calculated the class averages', 'Flash.flash.3.message');
        $this->assertSession('Successfully counted the students in the class', 'Flash.flash.4.message');
    }

    /** @test */
    public function testProcessAnnualResults()
    {
        $data = [
            'session_id' => 1,
            'class_id' => 1,
            'term_id' => 4,
            'cal_student_total' => true,
            'cal_student_position' => true,
            'cal_subject_position' => true,
            'cal_class_count' => true,
        ];
        $this->post('result-system/result-processing/process-annual-result',$data);
        $this->assertRedirect();
        $this->assertSession('Successfully Calculated the students annual results', 'Flash.flash.0.message');
        $this->assertSession('Successfully calculated the students positions', 'Flash.flash.1.message');
        $this->assertSession('Successfully calculated the students subject positions', 'Flash.flash.2.message');
        $this->assertSession('Successfully counted the students in the class', 'Flash.flash.3.message');
    }
}