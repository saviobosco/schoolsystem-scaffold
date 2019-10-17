<?php
namespace ResultSystem\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use ResultSystem\Controller\UploadResultController;

/**
 * ResultSystem\Controller\UploadResultController Test Case
 *
 */
class UploadResultControllerTest extends IntegrationTestCase
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
        'plugin.result_system.terms',
        'plugin.result_system.subjects',
        'plugin.result_system.result_grade_inputs',
        'plugin.grading_system.result_grading_systems',
        'plugin.result_system.student_termly_results',
        'plugin.result_system.student_annual_results',
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
        $this->markTestSkipped('deprecated');
        /*$this->get('/result-system/upload-result');
        $this->assertResponseOk();*/
    }

    public function testUploadResult()
    {
        $this->markTestSkipped('deprecated');
        /*$data = [
            'type' => 'first_test',
            'class_id' => '1',
            'term_id' => '1',
            'session_id' => '1',
            'result' => [
                'tmp_name' => '/home/saviobosco/schoolsystem2-testing/test-excel.xls',
                'error' => (int) 0,
                'name' => 'catholic_entrance.xls',
                'type' => 'application/vnd.ms-excel',
                'size' => (int) 6144
            ]
        ];
        $this->put('/result-system/upload-result?session_id=1',$data);
        $this->assertRedirect();
        $this->assertSession('2 records were successfully read and uploaded.', 'Flash.flash.0.message');*/
    }

    public function testUploadResultSubjectFailed()
    {
        $this->markTestSkipped('deprecated.');
        /*$data = [
            'type' => 'first_test',
            'class_id' => '1',
            'term_id' => '1',
            'session_id' => '1',
            'result' => [
                'tmp_name' => '/home/saviobosco/schoolsystem2-testing/test-failed.xls',
                'error' => (int) 0,
                'name' => 'catholic_entrance.xls',
                'type' => 'application/vnd.ms-excel',
                'size' => (int) 6144
            ]
        ];
        $this->put('/result-system/upload-result',$data);
        $this->assertRedirect();
        $this->assertSession('The result could not be uploaded because the following subjects does not exist in the database Igbo. This might be caused by improper subject naming, wrong character cases and wrong spacings. Please cross check and try again', 'Flash.flash.0.message');*/
    }

    public function testUploadResultStudentFailed()
    {
        $this->markTestSkipped('deprecated.');
        /*$data = [
            'type' => 'first_test',
            'class_id' => '1',
            'term_id' => '1',
            'session_id' => '1',
            'result' => [
                'tmp_name' => '/home/saviobosco/schoolsystem2-testing/test-failed-student.xls',
                'error' => (int) 0,
                'name' => 'catholic_entrance.xls',
                'type' => 'application/vnd.ms-excel',
                'size' => (int) 6144
            ]
        ];
        $this->put('/result-system/upload-result',$data);
        $this->assertRedirect();
        $this->assertSession('3 records were successfully read and uploaded.', 'Flash.flash.0.message');
 */ }
}
