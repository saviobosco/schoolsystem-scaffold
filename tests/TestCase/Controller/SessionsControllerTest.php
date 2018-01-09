<?php
namespace App\Test\TestCase\Controller;

use App\Controller\SessionsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\SessionsController Test Case
 */
class SessionsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sessions',
        'app.students',
        'app.classes',
        'app.class_demarcations',
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
        $this->get('/sessions');
        $this->assertResponseOk();
        $this->assertResponseContains('Sessions');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('sessions/view/1');
        $this->assertResponseOk();
        $this->assertResponseContains('session');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $data = [
            'id' => 4,
            'session' => '2019/2020',
            'created' => '2016-09-01 20:48:25',
            'modified' => '2016-09-01 20:48:25'
        ];
        $this->post('sessions/add',$data);
        $this->assertResponseSuccess();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->get('sessions/edit/1');
        $this->assertResponseOk();
        $this->assertResponseContains('2016/2017');

        $data = [
            'id' => 1,
            'session' => '2019/2020',
            'created' => '2016-09-01 20:48:25',
            'modified' => '2016-09-01 20:48:25'
        ];

        $this->post('sessions/edit/1',$data);
        $this->assertResponseSuccess();
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->delete('sessions/delete/1');
        $this->assertResponseSuccess();
        $this->assertRedirect();
    }
}
