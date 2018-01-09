<?php
namespace ResultSystem\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use ResultSystem\Controller\StudentTermlyResultsController;

/**
 * ResultSystem\Controller\StudentTermlyResultsController Test Case
 */
class StudentTermlyResultsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.student_termly_results',
        'plugin.grading_system.result_grading_systems',
        'app.students',
        'app.sessions',
        'app.classes',
        'plugin.result_system.terms',
        'app.subjects',
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

    public function testUploadResult()
    {
        $data = [
            'type' => 'first_test',
            'class_id' => '1',
            'term_id' => '1',
            'session_id' => '1',
            'result' => [
                'name' => 'first_test.xlsx',
                'type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'tmp_name' => '/home/saviobosco/SCHOOL-SYSTEM-JSS1-DATA (copy)/schoolsystem_first_test.xlsx',
                'error' => '0',
                'size' => '6973'
            ]

        ];
        $this->post('result-system/student-termly-results/upload-result',$data);
        $this->assertResponseOk();
        $this->assertResponseContains('3 records were successfully read and uploaded');
    }

    public function testUploadResultFailedBadColumnOrder()
    {
        $data = [
            'type' => 'second_test',
            'class_id' => '1',
            'term_id' => '1',
            'session_id' => '1',
            'result' => [
                'name' => 'second_test.xlsx',
                'type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'tmp_name' => '/home/saviobosco/SCHOOL-SYSTEM-JSS1-DATA (copy)/schoolsystem_second_test.xlsx',
                'error' => '0',
                'size' => '6973'
            ]

        ];
        $this->post('result-system/student-termly-results/upload-result',$data);
        $this->assertResponseOk();
        $this->assertResponseContains('The Excel file is not arranged in the proper format. The first column head is student_id and not ');
    }
}
