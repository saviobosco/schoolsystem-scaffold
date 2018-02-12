<?php
namespace StudentsManager\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use StudentsManager\Controller\StudentsEmailController;

/**
 * StudentsManager\Controller\StudentsEmailController Test Case
 */
class StudentsEmailControllerTest extends IntegrationTestCase
{
    public function setUp()
    {
        parent::setUp();
        // Set session data
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 1,
                    'username' => 'testing',
                    'role' => 'superuser',
                    'super_user' => 1
                    // other keys.
                ]
            ]
        ]);
        $this->enableRetainFlashMessages();
    }

    public function testIndex()
    {
        $this->assertEquals(true,true);
    }


}
