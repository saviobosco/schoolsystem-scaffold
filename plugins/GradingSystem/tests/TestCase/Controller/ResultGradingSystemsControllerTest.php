<?php
namespace GradingSystem\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use GradingSystem\Controller\ResultGradingSystemsController;

/**
 * GradingSystem\Controller\ResultGradingSystemsController Test Case
 */
class ResultGradingSystemsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.grading_system.result_grading_systems'
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

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/grading-system/result-grading-systems');
        $this->assertResponseOk();
        $this->assertResponseContains('Result Grading Systems');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/grading-system/result-grading-systems/view/1');
        $this->assertResponseOk();
        $this->assertResponseContains('Distinction');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $data = [
            'id' => 5,
            'grade' => 'A',
            'score' => '75 - above',
            'remark' => 'Distinction',
            'cal_order' => 5,
            'created' => '2017-07-13 14:09:37',
            'modified' => '2017-07-13 14:09:37'
        ];
        $this->post('/grading-system/result-grading-systems/add',$data);
        $this->assertResponseSuccess();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $data = [
            'id' => 1,
            'grade' => 'A',
            'score' => '75 - above',
            'remark' => 'Distinction',
            'cal_order' => 6,
        ];

        $this->post('/grading-system/result-grading-systems/edit/1',$data);
        $this->assertRedirect();
        $this->assertResponseSuccess();
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->delete('/grading-system/result-grading-systems/delete/1');
        $this->assertResponseSuccess();
        $this->assertRedirect();
    }
}
