<?php
namespace StudentAccount\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use StudentAccount\Controller\ProfileController;

/**
 * StudentAccount\Controller\ProfileController Test Case
 */
class ProfileControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.student_account.students',
        'plugin.student_account.classes'
    ];

    public function setUp()
    {
        parent::setUp();
        // Set session data
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => '001',
                    'first_name' => 'Omebe',
                    'last_name' => 'Johnbosco',
                    'date_of_birth' => '2019-02-22',
                    'gender' => 'Lorem ipsum dolor sit amet',
                    'state_of_origin' => 'Lorem ipsum dolor sit amet',
                    'religion_id' => 1,
                    'home_residence' => 'Lorem ipsum dolor sit amet',
                    'guardian' => 'Lorem ipsum dolor sit amet',
                    'relationship_to_guardian' => 'Lorem ipsum dolor sit amet',
                    'occupation_of_guardian' => 'Lorem ipsum dolor sit amet',
                    'guardian_phone_number' => 'Lorem ipsum d',
                    'class_id' => 1,
                    'class_demarcation_id' => 1,
                    'photo' => 'Lorem ipsum dolor sit amet',
                    'photo_dir' => 'Lorem ipsum dolor sit amet',
                    'created' => '2019-02-22 13:11:42',
                    'modified' => '2019-02-22 13:11:42',
                    'status' => 1,
                    'state_id' => 1
                ]
            ]
        ]);
        $this->disableErrorHandlerMiddleware();
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/student-account/profile');
        $this->assertResponseOk();
        $this->assertResponseContains('Omebe Johnbosco');
    }
}
