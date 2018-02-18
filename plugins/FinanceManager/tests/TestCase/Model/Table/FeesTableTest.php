<?php
namespace FinanceManager\Test\TestCase\Model\Table;

use Cake\Event\EventList;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use FinanceManager\Model\Table\FeesTable;

/**
 * FinanceManager\Model\Table\FeesTable Test Case
 */
class FeesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \FinanceManager\Model\Table\FeesTable
     */
    public $Fees;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.fees',
        'plugin.finance_manager.fee_categories',
        'plugin.finance_manager.student_fee_payments',
        'plugin.finance_manager.student_fees',
        'plugin.finance_manager.students',
        'plugin.finance_manager.classes',
        'plugin.finance_manager.receipts',
        'plugin.finance_manager.payments',
        'plugin.finance_manager.payment_types',
        'plugin.finance_manager.incomes',
        'plugin.finance_manager.terms',
        'plugin.finance_manager.sessions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Fees') ? [] : ['className' => FeesTable::class];
        $this->Fees = TableRegistry::get('Fees', $config);
        $this->Fees->getEventManager()->setEventList(new EventList());
        $this->Fees->StudentFees->getEventManager()->setEventList(new EventList());
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Fees);

        parent::tearDown();
    }

    /**
     * Test checkIfFeeExists method
     *
     * @return void
     */
    public function testCheckIfFeeExists()
    {
        $fee = new Entity([
            'id'=>1,
            'fee_category_id'=>1,
            'term_id' => 1,
            'class_id' => 1,
            'session_id' => 1
        ]);
        $this->assertTrue($this->Fees->checkIfFeeExists($fee));
        $fee->term_id = 2;
        $this->assertNotTrue($this->Fees->checkIfFeeExists($fee));
    }

    /**
     * Test addFee method
     *
     * @return void
     */
    public function testAddFee()
    {
        $postData = [
            'fee_category_id' => '1',
            'amount' => '3000',
            'term_id' => '1',
            'class_id' => '0',
            'session_id' => '1',
            'compulsory' => '1',
            'create_students_records' => '1',
            'income_amount_expected' => '12000',
            'number_of_students' => '4'
        ]; // for all classes
        $this->assertTrue($this->Fees->addFee($postData));
        $fee = $this->Fees->find('all')->where(['class_id'=>6])->first();
        $this->assertEquals('3000',$fee->income_amount_expected);
        $this->assertEquals(1,$fee->number_of_students);
        $postData['fee_category_id'] = 2;
        $postData['class_id'] = 1; // for JSS 1
        $this->assertTrue($this->Fees->addFee($postData));
    }

    /**
     * Test saveFee method
     *
     * @return void
     */
    public function testSaveFee()
    {
        $fee = $this->Fees->newEntity([
            'fee_category_id' => 1,
            'amount' => 25500,
            'term_id' => 1,
            'class_id' => 1,
            'session_id' => 2,
            'compulsory' => true,
            'income_amount_expected' => 76500,
            'number_of_students' => 3,
        ]);
        $this->assertInstanceOf(Entity::class,$this->Fees->saveFee($fee));
    }

    /**
     * Test createStudentsFeeRecordByClass method
     *
     * @return void
     */
    public function testCreateStudentsFeeRecordByClass()
    {
        $this->assertTrue($this->Fees->createStudentsFeeRecordByClass(1,1));
        $this->assertEventFired('Model.afterSave',$this->Fees->StudentFees->getEventManager());
    }

    /**
     * Test getFeeDefaulters method
     *
     * @return void
     */
    public function testGetFeeDefaulters()
    {
        $queryData = [
            'session_id' => 1,
            'class_id' => 1,
            'term_id' => 1,
            'percentage' => 75
        ];

        $expected = [
            [
                'student_id' => '1000',
                'class_id' => 1,
                'total' =>(float)25000
            ]
        ];
        $this->assertEquals($expected,$this->Fees->getFeeDefaulters($queryData));
    }

    /**
     * Test getStudentsData method
     *
     * @return void
     */
    public function testGetStudentsData()
    {
        $expected = [
            '1000' => 'Omebe Johnbosco',
        ];
        $this->assertArraySubset($expected,$this->Fees->getStudentsData());
    }

    /**
     * Test getFeeWithClassSessionTerm method
     *
     * @return void
     */
    public function testGetFeeWithClassSessionTerm()
    {
        $expected = [
            1 => 'School Fees--2018/2019--JSS 1--First Term'
        ];
        $this->assertEquals($expected,$this->Fees->getFeeWithClassSessionTerm());
    }

    /**
     * Test createStudentsFeeRecord method
     *
     * @return void
     */
    public function testCreateStudentsFeeRecord()
    {
        $postData = [
            'fee_id' => 1,
            'student_ids' => [
                '1005'
            ]
        ];
        $this->assertTrue($this->Fees->createStudentsFeeRecord($postData));
        $fee = $this->Fees->get(1);
        $this->assertEquals('50000',$fee->income_amount_expected);
    }

    /**
     * Test getFeeDefaultersByFeeId method
     *
     * @return void
     */
    public function testGetFeeDefaultersByFeeId()
    {
        $this->assertInstanceOf(Entity::class,$this->Fees->getFeeDefaultersByFeeId(1));
    }

    /**
     * Test getFeeCompleteStudentsByFeeId method
     *
     * @return void
     */
    public function testGetFeeCompleteStudentsByFeeId()
    {
        $this->assertInstanceOf(Entity::class,$this->Fees->getFeeCompleteStudentsByFeeId(1));
    }

    /**
     * Test getStudentWithCompleteFees method
     *
     * @return void
     */
    public function testGetStudentWithCompleteFees()
    {
        $queryData = [
            'session_id' => 1,
            'class_id' => 1,
            'term_id' => 1
        ];
        $expected = [];
        $this->assertEquals($expected,$this->Fees->getStudentWithCompleteFees($queryData));
    }

    /**
     * Test getCompulsoryFeesByParameters method
     *
     * @return void
     */
    public function testGetCompulsoryFeesByParameters()
    {
        $queryData = [
            'session_id' => 1,
            'class_id' => 1,
            'term_id' => 1
        ];
        $this->assertEquals('25000',$this->Fees->getCompulsoryFeesByParameters($queryData));
    }

    /**
     * Test queryFeesTable method
     *
     * @return void
     */
    public function testQueryFeesTable()
    {
        $queryData = [
            'session_id' => 1,
            'class_id' => 1,
            'term_id' => 1
        ];
        $expected = [
            1 => [
                'amount' => 25000,
                'expectedIncome' => 25000,
                'amountReceived' => 0,
                'amountRemaining' => 25000,
                'percentageReceived' => '0.00',
                'percentageRemaining' => '100.00',
                'numberOfStudents' => 1,
                'numberOfStudentsPaid' => 0,
                'numberOfStudentsRemaining' => 1
            ]
        ];
        $this->assertEquals($expected,$this->Fees->queryFeesTable($queryData));
    }

    /**
     * Test getFeeCategoriesData method
     *
     * @return void
     */
    public function testGetFeeCategoriesData()
    {
        $expected = [
            1 => 'School Fees',
            2 => 'Damage'
        ];
        $this->assertEquals($expected,$this->Fees->getFeeCategoriesData());
    }

    /**
     * Test deleteFee method
     *
     * @return void
     */
    public function testDeleteFee()
    {
        $fee = new Entity(['id'=>1]);
        $this->assertTrue($this->Fees->deleteFee($fee));
    }
}
