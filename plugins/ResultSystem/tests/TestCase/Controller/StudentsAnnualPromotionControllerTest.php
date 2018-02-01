<?php
namespace ResultSystem\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use ResultSystem\Controller\StudentsAnnualPromotionController;

/**
 * ResultSystem\Controller\StudentsAnnualPromotionController Test Case
 */
class StudentsAnnualPromotionControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.student_annual_positions',
        'plugin.result_system.students',
        'plugin.result_system.sessions',
        'plugin.result_system.classes',
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
        $this->get('/result-system/students-annual-promotion?session_id=1&class_id=1');
        $this->assertResponseOk();
    }

    public function testProcessAnnualPromotion()
    {
        $data = [
            'student_annual_positions' => [
                0 => [
                    'promoted' => '1',
                    'student_id' => '001',
                    'class_id' => '1',
                    'session_id' => '1'
                ],
            ]
        ];
        $this->post('/result-system/students-annual-promotion?session_id=1&class_id=1',$data);
        $this->assertRedirect();
        $this->assertSession('The action was successful!', 'Flash.flash.0.message');
    }

}
