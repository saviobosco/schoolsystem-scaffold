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
        $data = [
            'session_id' => 1,
            'class_id' => 1,
            'term_id' => 1,
            'no_of_subjects' => 3
        ];
        $this->post('result-system/result-processing',$data);
        $this->assertResponseOk();
        $this->assertResponseContains('Successfully Calculated the students termly results');
    }

    /**
     * Test index ResultProcessingWithStudentPosition
     *
     * @return void
     */
    public function testResultProcessingWithStudentPosition()
    {
        $data = [
            'session_id' => 1,
            'class_id' => 1,
            'term_id' => 1,
            'no_of_subjects' => 3,
            'cal_student_position' => true
        ];
        $this->post('result-system/result-processing',$data);
        $this->assertResponseOk();
        $this->assertResponseContains('Successfully Calculated the students termly results');
    }

    /**
     * Test index ResultProcessingWithSubjectPosition
     *
     * @return void
     */
    public function testResultProcessingWithSubjectPosition()
    {
        $data = [
            'session_id' => 1,
            'class_id' => 1,
            'term_id' => 1,
            'no_of_subjects' => 3,
            'cal_subject_position' => true
        ];
        $this->post('result-system/result-processing',$data);
        $this->assertResponseOk();
        $this->assertResponseContains('Successfully calculated the students subject position');
    }

    /**
     * Test index ResultProcessingWithClassAverage
     *
     * @return void
     */
    public function testResultProcessingWithClassAverage()
    {
        $data = [
            'session_id' => 1,
            'class_id' => 1,
            'term_id' => 1,
            'no_of_subjects' => 3,
            'cal_class_average' => true
        ];
        $this->post('result-system/result-processing',$data);
        $this->assertResponseOk();
        $this->assertResponseContains('Successfully Calculated the students termly results');
    }

}