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
        'plugin.result_system.student_annual_results',
        'plugin.result_system.student_termly_subject_positions',
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

    public function testDelete()
    {
        $this->delete('/result-system/delete-termly-result/1');
        $this->assertRedirect();
        $this->assertSession('The record has been deleted.','Flash.flash.0.message');
    }
}
