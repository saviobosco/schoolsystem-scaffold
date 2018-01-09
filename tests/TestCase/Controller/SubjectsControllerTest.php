<?php
namespace App\Test\TestCase\Controller;

use App\Controller\SubjectsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\SubjectsController Test Case
 */
class SubjectsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.subjects',
        'app.blocks',
        'app.classes',
        'app.class_demarcations',
        'app.students',
        'app.sessions',
        'plugin.result_system.student_termly_results',
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
        $this->get('/subjects');
        $this->assertResponseOk();
        $this->assertResponseContains('Subjects');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('subjects/view/1');
        $this->assertResponseOk();
        $this->assertResponseContains('subject');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $data = [
            'id' => 1,
            'name' => 'MATHEMATICS',
            'block_id' => 2
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
        $this->get('subjects/edit/1');
        $this->assertResponseOk();
        $this->assertResponseContains('MATHEMATICS');

        $data = [
            'id' => 1,
            'name' => 'MATHEMATICS',
            'block_id' => 1
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
        $this->delete('subjects/delete/1');
        $this->assertResponseSuccess();
        $this->assertRedirect();
    }

}
