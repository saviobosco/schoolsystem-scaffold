<?php
namespace FinanceManager\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use FinanceManager\Controller\StudentsController;

/**
 * FinanceManager\Controller\StudentsController Test Case
 */
class StudentsControllerTest extends IntegrationTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->session([
            'Auth' => [
                'User' => [
                    'id' => 'f8b668c2-0de6-4561-9018-f0199c9e8525',
                    'username' => 'testing',
                    'role' => 'superuser',
                    'super_user' => 1
                    // other keys.
                ]
            ]
        ]);
        $this->disableErrorHandlerMiddleware();
    }

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.students',
        'plugin.finance_manager.sessions',
        'plugin.finance_manager.classes',
        'plugin.finance_manager.student_fees',
        'plugin.finance_manager.fee_categories',
        'plugin.finance_manager.fees',
        'plugin.finance_manager.users',
        'plugin.finance_manager.terms',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/finance-manager/students?class_id=1');
        $this->assertResponseOk();
        $this->assertResponseContains('Omebe');
        $this->assertResponseContains('Johnbosco');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/finance-manager/students/view/001');
        $this->assertResponseOk();
        $this->assertResponseContains('Omebe Johnbosco');
    }

    /*public function testGetStudentByAjax()
    {
        $this->configRequest([
            'headers' => ['X-Requested-With' => 'XML-HttpRequest']
        ]);
        $this->get('/finance-manager/students/get-student-by-ajax?id=001');
    }*/

    /*public function testGetStudentsCountByClassId()
    {
        $this->configRequest([
            'headers' => [
                'X-Requested-With' => 'XML-HttpRequest',
                'HTTP_X_REQUESTED_WITH' => 'XML-HttpRequest'            ]
        ]);
        $this->get('/finance-manager/students/get-students-count-by-class-id?class_id=1');
    }*/
}
