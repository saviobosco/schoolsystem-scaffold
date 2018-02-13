<?php
namespace ClassManager\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use ClassManager\Controller\ClassesController;

/**
 * ClassManager\Controller\ClassesController Test Case
 */
class ClassesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.class_manager.classes',
        'plugin.class_manager.blocks',
        'plugin.class_manager.class_demarcations',
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
                    'role' => 'superuser',
                    'super_user' => 1
                    // other keys.
                ]
            ]
        ]);
        $this->enableRetainFlashMessages();
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
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/classes/view/1');
        $this->assertResponseOk();
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $data = [
            'id' => 3,
            'class' => 'Jss 2',
            'block_id' => 1,
            'no_of_subjects' => 1
        ];
        $this->post('/classes/add',$data);
        $this->assertRedirect();
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
            'class' => 'Jss 1',
            'block_id' => 1,
            'no_of_subjects' => 1
        ];
        $this->post('/classes/edit/1',$data);
        $this->assertRedirect();
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->delete('/classes/delete/1');
        $this->assertRedirect();
        $this->assertSession('The class has been deleted.', 'Flash.flash.0.message');
    }
}
