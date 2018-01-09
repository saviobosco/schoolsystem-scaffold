<?php
namespace SkillsGradingSystem\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use SkillsGradingSystem\Controller\AffectiveDispositionsController;

/**
 * SkillsGradingSystem\Controller\AffectiveDispositionsController Test Case
 */
class AffectiveDispositionsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.skills_grading_system.affective_dispositions',
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
        $this->get('/skills-grading-system/affective-dispositions');
        $this->assertResponseOk();
        $this->assertResponseContains('Affective Dispositions');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/skills-grading-system/affective-dispositions/view/1');
        $this->assertResponseOk();
        $this->assertResponseContains('Edit Affective Disposition');
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
            'name' => 'Punctuality',
            'created' => '2016-09-12 15:33:41',
            'modified' => '2016-09-12 15:33:41'
        ];
        $this->post('/skills-grading-system/affective-dispositions/add',$data);
        $this->assertResponseSuccess();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->get('/skills-grading-system/affective-dispositions/edit/1');
        $this->assertResponseOk();
        $this->assertResponseContains('Punctuality');

        $data = [
            'id' => 1,
            'name' => 'Attentiveness',
            'created' => '2016-09-12 15:33:41',
            'modified' => '2016-09-12 15:33:41'
        ];

        $this->post('/skills-grading-system/affective-dispositions/edit/1',$data);
        $this->assertResponseSuccess();
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->delete('/skills-grading-system/affective-dispositions/delete/1');
        $this->assertResponseSuccess();
        $this->assertRedirect();
    }
}
