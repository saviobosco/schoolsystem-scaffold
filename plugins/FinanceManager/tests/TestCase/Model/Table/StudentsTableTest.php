<?php
namespace FinanceManager\Test\TestCase\Model\Table;

use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use FinanceManager\Model\Table\StudentsTable;

/**
 * FinanceManager\Model\Table\StudentsTable Test Case
 */
class StudentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \FinanceManager\Model\Table\StudentsTable
     */
    public $Students;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.classes',
        'plugin.finance_manager.fees',
        'plugin.finance_manager.students',
        'plugin.finance_manager.fee_categories',
        'plugin.finance_manager.student_fee_payments',
        'plugin.finance_manager.student_fees',
        'plugin.finance_manager.receipts',
        'plugin.finance_manager.payments',
        'plugin.finance_manager.payment_types',
        'plugin.finance_manager.incomes',
        'plugin.finance_manager.terms',
        'plugin.finance_manager.sessions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Students') ? [] : ['className' => StudentsTable::class];
        $this->Students = TableRegistry::get('Students', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Students);

        parent::tearDown();
    }

    /**
     * Test getStudentFees method
     *
     * @return void
     */
    public function testGetStudentFees()
    {
        $expected = [
            'id' => 1,
            'student_id' => '001',
            'fee_id' => null,
            'fee_category_id' => 2,
            'amount' => 2000,
            'paid' => 0,
            'amount_remaining' => null,
            'purpose' => 'Damage',
        ];
        $actual = $this->Students->getStudentFees('001');
        $this->assertEquals($expected['id'], $actual[0]['id']);
        $this->assertEquals($expected['amount'], $actual[0]['amount']);
        $this->assertEquals($expected['student_id'], $actual[0]['student_id']);
    }

    /**
     * Test getStudentSpecialFees method
     *
     * @return void
     */
    public function testGetStudentSpecialFees()
    {
        $expected = [
            'id' => 2,
            'student_id' => '001',
            'fee_id' => null,
            'fee_category_id' => 2,
            'amount' => 2000,
            'paid' => 0,
            'amount_remaining' => null,
            'purpose' => 'Damage',
        ];
        $actual = $this->Students->getStudentSpecialFees('001');
        $this->assertEquals($expected['id'], $actual[0]['id']);
        $this->assertEquals($expected['purpose'], $actual[0]['purpose']);
    }

    /**
     * Test getReceiptDetails method
     *
     * @return void
     */
    public function testGetReceiptDetails()
    {
        $expected = [
            'student_fee_payments' => [
                [
                    'id' => 1,
                    'student_fee_id' => 1,
                    'amount_paid' => 1000,
                    'amount_remaining' => 24000,
                    'receipt_id' => 1,
                    'fee_id' => 1,
                ],
                [
                    'id' => 2,
                    'student_fee_id' => 2,
                ]
            ]
        ];
        $actual = $this->Students->getReceiptDetails(1);
        $this->assertEquals($expected['student_fee_payments'][0]['student_fee_id'], $actual['student_fee_payments'][0]['student_fee_id']);
        $this->assertEquals($expected['student_fee_payments'][1]['student_fee_id'], $actual['student_fee_payments'][1]['student_fee_id']);
        $this->assertEquals('001', $actual['student']['id']);
        $this->assertEquals(1, $actual['student']['class']['id']);
    }

    /**
     * Test getStudentsWithId method
     *
     * @return void
     */
    public function testGetStudentsWithId()
    {
        $expected = [
            'id' => '001',
            'first_name' => 'Omebe',
            'last_name' => 'Johnbosco',
            'class' => [
                'id' => 1,
                'class' => 'JSS 1'
            ]
        ];
        $actual = $this->Students->getStudentsWithId('001');
        $this->assertContains($expected['id'], $actual[0]['id']);
        $this->assertContains($expected['first_name'], $actual[0]['first_name']);
    }

    /**
     * Test getStudentArrears method
     *
     * @return void
     */
    public function testGetStudentArrears()
    {
        $expected = [
            [
                'id' => 1,
                'student_id' => '001',
                'fee_id' => 1,
                'fee_category_id' => 1,
                'amount' => null,
                'paid' => 0,
                'amount_remaining' => null,
                'purpose' => '',
                'created' => new FrozenTime('2018-02-13 19:47:44'),
                'modified' => new FrozenTime('2018-02-13 19:47:44'),
                'created_by' => 'ca79c1f1-7aa9-452d-85de-10ef846ab70a',
                'modified_by' => '0a1248a3-42e2-4da5-bbea-2378e1defe6f',
                'fee' => [
                    'id' => 1,
                    'amount' => 25000,
                ]
            ]
        ];
        $actual = $this->Students->getStudentArrears('001');
        $this->assertEquals($expected[0]['id'], $actual[0]['id']);
    }

    /**
     * Test getStudentsDataList method
     *
     * @return void
     */
    public function testGetStudentsDataList()
    {
        $expected = [
            '001' => 'Omebe Johnbosco',
        ];
        $this->assertEquals($expected['001'],$this->Students->getStudentsDataList()['001']);
    }

    /**
     * Test createStudentFeesByClassIdAndSessionId method
     *
     * @return void
     */
    public function testCreateStudentFeesByClassIdAndSessionId()
    {
        $this->Students->createStudentFeesByClassIdAndSessionId('002', 1, 1);
        $studentFeeTable = TableRegistry::get('FinanceManager.StudentFees');
        $studentFees = $studentFeeTable->find()->where(['student_id' => '002'])->toArray();
        $this->assertEquals(1, $studentFees[0]['fee_id']);
    }

    public function testGetReceipts()
    {
        $receipts = $this->Students->getReceipts('001');
        $this->assertCount(2, $receipts);
    }
}
