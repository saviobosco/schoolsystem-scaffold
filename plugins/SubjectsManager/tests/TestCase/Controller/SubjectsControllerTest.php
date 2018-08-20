<?php
namespace SubjectsManager\Test\TestCase\Controller;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use SubjectsManager\Controller\SubjectsController;

/**
 * SubjectsManager\Controller\SubjectsController Test Case
 */
class SubjectsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.subjects_manager.subjects',
        'plugin.subjects_manager.blocks',
        'plugin.class_manager.classes',
    ];

    public function setUp()
    {
        parent::setUp();
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
        $this->get('/subjects-manager/subjects');
        $this->assertResponseOk();
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/subjects-manager/subjects/view/1');
        $this->assertResponseContains('Mathematics');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $postData = [
            'name' => 'English',
            'block_id' => 1
        ];
        $this->post('/subjects-manager/subjects/add', $postData);
        $this->assertRedirect();
        $subjectTable = TableRegistry::get('SubjectsManager.Subjects');
        $subject = $subjectTable->get(2);
        $this->assertEquals($postData['name'], $subject['name']);
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $postData = [
            'id' => 1,
            'name' => 'Igbo'
        ];
        $this->put('/subjects-manager/subjects/edit/1', $postData);
        $this->assertRedirect();
        $subjectTable = TableRegistry::get('SubjectsManager.Subjects');
        $subject = $subjectTable->get(1);
        $this->assertEquals($postData['name'], $subject['name']);
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->delete('/subjects-manager/subjects/delete/1');
        $this->assertRedirect();
        $this->assertSession('The subject has been deleted.', 'Flash.flash.0.message');
    }
}
