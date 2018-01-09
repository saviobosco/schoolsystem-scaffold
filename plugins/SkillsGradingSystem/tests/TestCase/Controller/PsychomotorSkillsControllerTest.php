<?php
namespace SkillsGradingSystem\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use SkillsGradingSystem\Controller\PsychomotorSkillsController;

/**
 * SkillsGradingSystem\Controller\PsychomotorSkillsController Test Case
 */
class PsychomotorSkillsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.skills_grading_system.psychomotor_skills',
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
        $this->get('/skills-grading-system/psychomotor-skills');
        $this->assertResponseOk();
        $this->assertResponseContains('Psychomotor Skills');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/skills-grading-system/psychomotor-skills/view/1');
        $this->assertResponseOk();
        $this->assertResponseContains('Hand Writing');
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
            'name' => 'Hand Writing2',
            'created' => '2016-09-12 15:34:16',
            'modified' => '2016-09-12 15:34:16'
        ];
        $this->post('/skills-grading-system/psychomotor-skills/add',$data);
        $this->assertResponseSuccess();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->get('/skills-grading-system/psychomotor-skills/edit/1');
        $this->assertResponseOk();
        $this->assertResponseContains('Hand Writing');

        $data = [
            'id' => 1,
            'name' => 'Painting',
            'created' => '2016-09-12 15:34:16',
            'modified' => '2016-09-12 15:34:16'
        ];

        $this->post('/skills-grading-system/psychomotor-skills/edit/1',$data);
        $this->assertResponseSuccess();
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->delete('/skills-grading-system/psychomotor-skills/delete/1');
        $this->assertResponseSuccess();
        $this->assertRedirect();
    }
}
