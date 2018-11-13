<?php
namespace FinanceManager\Test\TestCase\Controller;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use FinanceManager\Controller\FeesController;

/**
 * FinanceManager\Controller\FeesController Test Case
 */
class FeesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.fees',
        'plugin.finance_manager.fee_categories',
        'plugin.finance_manager.student_fees',
        'plugin.finance_manager.student_fee_payments',
        'plugin.finance_manager.sessions',
        'plugin.finance_manager.classes',
        'plugin.finance_manager.terms',
        'plugin.finance_manager.students',
        'plugin.finance_manager.users',
    ];

    public function setUp()
    {
        parent::setUp();
        // Set session data
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
        $this->enableRetainFlashMessages();
        $this->disableErrorHandlerMiddleware();
        $this->enableCsrfToken();
    }

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get('/finance-manager/fees');
        $this->assertResponseOk();
        $this->assertResponseContains('School Fees');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->get('/finance-manager/fees/view/1');
        $this->assertResponseOk();
        $this->assertResponseContains('25,000.00');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $postData = [
            'fee_category_id' => '1',
            'amount' => '25000',
            'term_id' => '1',
            'class_id' => '6',
            'session_id' => '1',
            'compulsory' => '1',
            'create_students_records' => '1',
            'income_amount_expected' => '1',
            'number_of_students' => '1'
        ];
        $this->post('/finance-manager/fees/add', $postData);
        $this->assertRedirect();
        $this->assertSession('The fee has been successfully created.', 'Flash.flash.0.message');
    }

    public function testAddWithNoTerm()
    {
        $postData = [
            'fee_category_id' => '1',
            'amount' => '25000',
            'term_id' => '1',
            'class_id' => '0',
            'session_id' => '1',
            'compulsory' => '1',
            'create_students_records' => '1',
            'income_amount_expected' => '1',
            'number_of_students' => '1'
        ];
        $this->post('/finance-manager/fees/add', $postData);
        $this->assertRedirect();
        $this->assertSession('The fee has been successfully created.', 'Flash.flash.0.message');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $postData = [
            'fee_category_id' => '1',
            'amount' => '60000',
            'term_id' => '1',
            'class_id' => '1',
            'session_id' => '1',
            'compulsory' => '1',
            'income_amount_expected' => '1',
            'number_of_students' => '1'
        ];
        $this->put('/finance-manager/fees/edit/1', $postData);
        $this->assertRedirect();
        $this->assertSession('The fee has been saved.', 'Flash.flash.0.message');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $postData = [
            'fee_category_id' => '1',
            'amount' => '32000',
            'term_id' => '1',
            'class_id' => '6',
            'session_id' => '1',
            'compulsory' => '1',
            'create_students_records' => '1',
            'income_amount_expected' => '1',
            'number_of_students' => '1'
        ];
        $feeTable = TableRegistry::get('FinanceManager.Fees');
        $return = $feeTable->addFee($postData);
        $this->assertTrue($return);

        $fee = $feeTable->get(2);
        $this->assertEquals(2, $fee['id']);
        $this->assertEquals($postData['amount'], $fee['amount']);

        $studentFeesTable = TableRegistry::get('FinanceManager.StudentFees');
        $studentFees = $studentFeesTable->find()->where(['fee_id' => 2])->count();
        $this->assertEquals(1, $studentFees);

        $this->delete('/finance-manager/fees/delete/2');
        $this->assertRedirect();
        $this->assertSession('The fee has been deleted.', 'Flash.flash.0.message');

        $fee = $feeTable->find()->where(['id' => 2])->first();
        $this->assertNull($fee);
        $studentFees = $studentFeesTable->find()->where(['fee_id' => 2])->count();
        $this->assertEquals(0, $studentFees);
    }

    public function testDeleteFailedCauseOfRecordedPayment()
    {
        $this->delete('/finance-manager/fees/delete/1');
        $this->assertRedirect();
        $this->assertSession('The fee could not be deleted. Please, try again.', 'Flash.flash.0.message');
    }

    public function testAddFeesToStudents()
    {
        $postData = [
            'fee_id' => '1',
            'student_ids' => [
                0 => '001',
                1 => '005',
            ]
        ];
        $this->post('/finance-manager/fees/add-fees-to-students', $postData);
        $this->assertSession('The Records were successfully created!', 'Flash.flash.0.message');
    }
}
