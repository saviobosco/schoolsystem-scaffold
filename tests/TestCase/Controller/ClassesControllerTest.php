<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ClassesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ClassesController Test Case
 */
class ClassesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.classes',
        'app.blocks',
        'app.class_demarcations',
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
        $this->get('/classes');
        $this->assertResponseOk();
        $this->assertResponseContains('Classes');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('classes/view/1');
        $this->assertResponseOk();
        $this->assertResponseContains('class');
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
            'class' => 'SS 1',
            'block_id' => 1,
            'created' => '2016-09-02 11:58:12',
            'modified' => '2016-09-02 11:58:12'
        ];
        $this->post('classes/add',$data);
        $this->assertResponseSuccess();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->get('classes/edit/1');
        $this->assertResponseOk();
        $this->assertResponseContains('JSS 1');

        $data = [
            'id' => 1,
            'class' => 'JSS 1',
            'block_id' => 1,
            'created' => '2016-09-02 11:58:12',
            'modified' => '2016-09-02 11:58:12'
        ];
        $this->post('classes/edit/1',$data);
        $this->assertResponseSuccess();
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->delete('classes/delete/1');
        $this->assertResponseSuccess();
        $this->assertRedirect();
    }
}
