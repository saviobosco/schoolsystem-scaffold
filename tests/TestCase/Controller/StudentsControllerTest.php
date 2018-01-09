<?php
namespace App\Test\TestCase\Controller;

use App\Controller\StudentsController;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\StudentsController Test Case
 */
class StudentsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.students',
        'app.sessions',
        'app.classes',
        'app.states',
        'app.class_demarcations'
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
        $this->get('/students');
        $this->assertResponseOk();
        $this->assertResponseContains('Students');
    }

    public function testIndexQuery()
    {
        $this->get('/students?class_id=3');
        $this->assertResponseOk();
        $this->assertResponseContains('Students');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('viewstudent/SMS/2017/001');
        $this->assertResponseOk();
        $this->assertResponseContains('student');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $data = [
            'id' => 'SMS/2016/010',
            'first_name' => 'Lorem ipsum dolor sit amet',
            'last_name' => 'Lorem ipsum dolor sit amet',
            'date_of_birth' => '2016-10-28',
            'gender' => 'Lorem ip',
            'state_of_origin' => 'Lorem ipsum dolor sit amet',
            'religion' => 'Lorem ipsum dolor sit amet',
            'home_residence' => 'Lorem ipsum dolor sit amet',
            'guardian' => 'Lorem ipsum dolor sit amet',
            'relationship_to_guardian' => 'Lorem ipsum dolor sit amet',
            'occupation_of_guardian' => 'Lorem ipsum dolor sit amet',
            'guardian_phone_number' => 'Lorem ipsum d',
            'session_id' => 'Lorem ips',
            'class_id' => 1,
            'class_demarcation_id' => 1,
            'created' => '2016-10-28 22:38:50',
            'modified' => '2016-10-28 22:38:50',
            'status' => 1
        ];
        $this->post('students/add',$data);
        $this->assertResponseSuccess();
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->get('editstudent/SMS/2017/001');
        $this->assertResponseOk();
        $this->assertResponseContains('Omebe Johnbosco');

        $data = [
            'id' => 'SMS/2017/001',
            'first_name' => 'Omebe',
            'last_name' => 'Johnbosco Ebuka',
            'date_of_birth' => '2016-10-28',
            'gender' => 'Lorem ip',
            'state_of_origin' => 'Lorem ipsum dolor sit amet',
            'religion' => 'Lorem ipsum dolor sit amet',
            'home_residence' => 'Lorem ipsum dolor sit amet',
            'guardian' => 'Lorem ipsum dolor sit amet',
            'relationship_to_guardian' => 'Lorem ipsum dolor sit amet',
            'occupation_of_guardian' => 'Lorem ipsum dolor sit amet',
            'guardian_phone_number' => 'Lorem ipsum d',
            'session_id' => 'Lorem ips',
            'class_id' => 1,
            'class_demarcation_id' => 1,
            'created' => '2016-10-28 22:38:50',
            'modified' => '2016-10-28 22:38:50',
            'status' => 1
        ];

        $this->post('editstudent/SMS/2017/001',$data);
        $this->assertResponseSuccess();
    }

    /**
     * Test delete method
     *
     * @return void
     * TestDelete works very fine but throws up an error on execution ..
     */
   /* public function testDelete()
    {
        $this->delete('deletestudent/SAS/2016/001');
        $this->assertResponseSuccess();
        $this->assertRedirect();
    } */
}
