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
        'plugin.finance_manager.students',
        'plugin.finance_manager.classes',
        'plugin.finance_manager.fees',
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
            'id' => 2,
            'student_id' => '1000',
            'fee_id' => null,
            'fee_category_id' => 2,
            'amount' => 2000,
            'paid' => 0,
            'amount_remaining' => null,
            'purpose' => 'Damage',
            'created' => new FrozenTime('2018-02-13 19:47:44'),
            'modified' => new FrozenTime('2018-02-13 19:47:44'),
            'created_by' => 'ca79c1f1-7aa9-452d-85de-10ef846ab70a',
            'modified_by' => '0a1248a3-42e2-4da5-bbea-2378e1defe6f'
        ];
        $this->assertContains($expected,$this->Students->getStudentFees('1000'));
    }

    /**
     * Test getStudentSpecialFees method
     *
     * @return void
     */
    public function testGetStudentSpecialFees()
    {
        $expected = [
            [
                'id' => 2,
                'student_id' => '1000',
                'fee_id' => null,
                'fee_category_id' => 2,
                'amount' => 2000,
                'paid' => 0,
                'amount_remaining' => null,
                'purpose' => 'Damage',
                'created' => new FrozenTime('2018-02-13 19:47:44'),
                'modified' => new FrozenTime('2018-02-13 19:47:44'),
                'created_by' => 'ca79c1f1-7aa9-452d-85de-10ef846ab70a',
                'modified_by' => '0a1248a3-42e2-4da5-bbea-2378e1defe6f'
            ]
        ];
        $this->assertEquals($expected,$this->Students->getStudentSpecialFees('1000'));
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
                    'fee_category_id' => 1,
                    'created' => new FrozenTime('2018-02-13 21:21:02'),
                    'modified' => new FrozenTime('2018-02-13 21:21:02'),
                    'created_by' => '01b552f3-9310-4c4c-8b99-0d9ebe44eb13',
                    'modified_by' => '86740652-16c4-4683-8468-4af7912ae956'
                ]
            ]
        ];
        $this->assertArraySubset($expected,$this->Students->getReceiptDetails(1));
    }

    /**
     * Test getStudentsWithId method
     *
     * @return void
     */
    public function testGetStudentsWithId()
    {
        $expected = [
            'id' => 1000,
            'first_name' => 'Omebe',
            'last_name' => 'Johnbosco',
            'class' => [
                'id' => 1,
                'class' => 'JSS 1'
            ]
        ];
        $this->assertContains($expected,$this->Students->getStudentsWithId('1000'));
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
                'student_id' => '1000',
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
        $this->assertEquals($expected,$this->Students->getStudentArrears('1000'));
    }

    /**
     * Test getStudentsDataList method
     *
     * @return void
     */
    public function testGetStudentsDataList()
    {
        $expected = [
            1000 => 'Omebe Johnbosco',
        ];
        $this->assertArraySubset($expected,$this->Students->getStudentsDataList());
    }

    /**
     * Test createStudentFeesByClassIdAndSessionId method
     *
     * @return void
     */
    public function testCreateStudentFeesByClassIdAndSessionId()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
