<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ClassDemacationsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ClassDemacationsController Test Case
 */
class ClassDemarcationsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.class_demarcations',
        'app.classes',
        'app.students',
        'app.sessions'
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
        $this->get('/class-demarcations');
        $this->assertResponseOk();
        $this->assertResponseContains('ClassDemarcations');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('class-demarcations/view/1');
        $this->assertResponseOk();
        $this->assertResponseContains('ClassDemarcation');
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
            'name' => 'JSS 1D',
            'class_id' => 1
        ];
        $this->post('class-demarcations/add',$data);
        $this->assertResponseSuccess();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->get('class-demarcations/edit/1');
        $this->assertResponseOk();
        $this->assertResponseContains('JSS 1A');

        $data = [
            'id' => 1,
            'name' => 'JSS 1A',
            'class_id' => 1
        ];
        $this->post('class-demarcations/edit/1',$data);
        $this->assertResponseSuccess();
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->delete('class-demarcations/delete/1');
        $this->assertResponseSuccess();
        $this->assertRedirect();
    }
}
