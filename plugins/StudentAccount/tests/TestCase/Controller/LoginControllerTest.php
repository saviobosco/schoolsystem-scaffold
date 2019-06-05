<?php
namespace StudentAccount\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use StudentAccount\Controller\LoginController;

/**
 * StudentAccount\Controller\LoginController Test Case
 */
class LoginControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.student_account.students'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/student-account/login');
        $this->assertResponseOk();
        $this->assertResponseCode(200);
    }

    /**
     * Test login method
     *
     * @return void
     */
    public function testLogin()
    {
        $postData = ['admission_number' => '001'];
        $this->post('/student-account/login', $postData);
        $this->assertRedirect('/student-account/dashboard');
    }
}
