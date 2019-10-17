<?php
namespace ResultSystem\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use ResultSystem\Controller\SubjectsController;

/**
 * ResultSystem\Controller\SubjectsController Test Case
 */
class SubjectsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.subjects',
        'plugin.result_system.classes',
        'plugin.class_manager.blocks',
        'plugin.result_system.terms',
        'plugin.result_system.student_annual_results',
        'plugin.result_system.student_termly_results',
        'plugin.result_system.students',
        'plugin.result_system.sessions',
        'plugin.result_system.result_grade_inputs',
        'plugin.grading_system.result_grading_systems',
        'plugin.result_system.student_subject_positions',
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
        $this->get('/result-system/subjects');
        $this->assertResponseOk();
        $this->assertResponseContains('English');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/result-system/view-subject-result/1?session_id=1&class_id=1&term_id=1');
        $this->assertResponseOk();
        $this->assertResponseContains('001');
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
                '001' => [
                    'first_test' => '4',
                    'second_test' => '5',
                    'third_test' => '4',
                    'fourth_test' => '4',
                    'exam' => '34',
                    'student_id' => '001',
                    'subject_id' => '1',
                    'class_id' => '1',
                    'term_id' => '2',
                    'session_id' => '1'
                ],
                '002' => [
                    'first_test' => '4',
                    'second_test' => '5',
                    'third_test' => '4',
                    'fourth_test' => '4',
                    'exam' => '34',
                    'student_id' => '002',
                    'subject_id' => '1',
                    'class_id' => '1',
                    'term_id' => '2',
                    'session_id' => '1'
                ],
                '003' => [
                    'first_test' => '4',
                    'second_test' => '5',
                    'third_test' => '4',
                    'fourth_test' => '4',
                    'exam' => '34',
                    'student_id' => '003',
                    'subject_id' => '1',
                    'class_id' => '1',
                    'term_id' => '2',
                    'session_id' => '1'
                ]
            ]
        ];
        $this->post('/result-system/add-subject-result/1?session_id=1&class_id=1&term_id=2',$data);
        $this->assertRedirect();
        $this->assertSession('The results were successfully added!', 'Flash.flash.0.message');
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
                0 => [
                    'first_test' => '9',
                    'second_test' => '10',
                    'third_test' => '9',
                    'fourth_test' => '9',
                    'exam' => '9',
                    'total' => '46',
                    'student_id' => '001',
                    'subject_id' => '1',
                    'class_id' => '1',
                    'term_id' => '1',
                    'session_id' => '1'
                ],
            ]
        ];
        $this->put('/result-system/edit-subject-result/1?session_id=1&class_id=1&term_id=1',$data);
        $this->assertRedirect();
        $this->assertSession('The subject results was successfully updated.', 'Flash.flash.0.message');

    }
}
