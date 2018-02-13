<?php
namespace ClassManager\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use ClassManager\Controller\ClassDemarcationsController;

/**
 * ClassManager\Controller\ClassDemarcationsController Test Case
 */
class ClassDemarcationsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.class_manager.class_demarcations',
        'plugin.class_manager.classes',
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
        $this->get('/class-demarcations');
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
            'name' => 'Jss 1A',
            'class_id' => 1,
            'capacity' => 1,
        ];
        $this->post('/class-demarcations/add',$data);
        $this->assertRedirect();
        $this->assertSession('The class demarcation has been saved.', 'Flash.flash.0.message');

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
            'name' => 'Jss 1A',
            'class_id' => 1,
            'capacity' => 1,
        ];
        $this->post('/class-demarcations/edit/1',$data);
        $this->assertRedirect(); // meaning it passed
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->delete('/class-demarcations/delete/1');
        $this->assertRedirect();
        $this->assertSession('The class demarcation has been deleted.', 'Flash.flash.0.message');
    }
}
