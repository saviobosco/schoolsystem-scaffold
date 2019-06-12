<?php
namespace ResultSystem\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use ResultSystem\Controller\PublishResultsController;

/**
 * ResultSystem\Controller\PublishResultsController Test Case
 */
class PublishResultsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.student_publish_results',
        'plugin.result_system.student_termly_results',
        'plugin.result_system.student_annual_results',
        'plugin.result_system.students',
        'plugin.result_system.sessions',
        'plugin.result_system.classes',
        'plugin.result_system.terms',
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


    public function testIndex()
    {
        $this->get('/result-system/publish-students-results?session_id=1&class_id=1&term_id=1');
        $this->assertResponseOk();
        $this->assertResponseContains('Omebe Johnbosco');
    }

    public function testPublishResults()
    {
        $data = [
            'student_publish_results' => [
                0 => [
                    'status' => '1',
                    'student_id' => '001',
                    'class_id' => '1',
                    'session_id' => '1',
                    'term_id' => '1'
                ],
            ]
        ];
        $this->put('/result-system/publish-students-results?session_id=1&class_id=1&term_id=1',$data);
        $this->assertRedirect();
        $this->assertSession('The results were successfully published', 'Flash.flash.0.message');
    }

}
