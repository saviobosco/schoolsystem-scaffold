<?php
namespace FinanceManager\Test\TestCase\Model\Table;

use Cake\Event\EventList;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use FinanceManager\Model\Table\StudentFeePaymentsTable;

/**
 * FinanceManager\Model\Table\StudentFeePaymentsTable Test Case
 */
class StudentFeePaymentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \FinanceManager\Model\Table\StudentFeePaymentsTable
     */
    public $StudentFeePayments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.student_fee_payments',
        'plugin.finance_manager.student_fees',
        'plugin.finance_manager.students',
        'plugin.finance_manager.fees',
        'plugin.finance_manager.fee_categories',
        //'plugin.CakeDC/Users.users',
        'plugin.finance_manager.receipts',
        'plugin.finance_manager.payments',
        'plugin.finance_manager.payment_types',
        'plugin.finance_manager.incomes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StudentFeePayments') ? [] : ['className' => StudentFeePaymentsTable::class];
        $this->StudentFeePayments = TableRegistry::get('StudentFeePayments', $config);
        $this->StudentFeePayments->getEventManager()->setEventList(new EventList());
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentFeePayments);

        parent::tearDown();
    }

    /**
     * Test processPaymentData method
     *
     * @return void
     */
    public function testProcessPaymentData()
    {
        $entities = $this->StudentFeePayments->newEntities(
            [
                [
                    'amount_to_pay' => '25000',
                    'fee_id' => '1',
                    'fee_category_id' => '1',
                    'amount_paid' => '25000',
                    'student_fee_id' => '1'
                ],
                [
                    'amount_to_pay' => '2000',
                    'fee_id' => '',
                    'fee_category_id' => '2',
                    'amount_paid' => '1000',
                    'student_fee_id' => '2'
                ]
            ]
        );

        $expected = [
            'total' => (float)'26000'
        ];
        $this->assertEquals($expected['total'],$this->StudentFeePayments->processPaymentData($entities)['total']);
    }

    public function testProcessPaymentsRemovedComma()
    {
        $entities = $this->StudentFeePayments->newEntities(
            [
                [
                    'amount_to_pay' => '25000',
                    'fee_id' => '1',
                    'fee_category_id' => '1',
                    'amount_paid' => '25,000',
                    'student_fee_id' => '1'
                ],
                [
                    'amount_to_pay' => '2000',
                    'fee_id' => '',
                    'fee_category_id' => '2',
                    'amount_paid' => '1,000',
                    'student_fee_id' => '2'
                ]
            ]
        );
        $return = $this->StudentFeePayments->processPaymentData($entities);
        $this->assertEquals('25000',$return['paymentData'][0]->amount_paid);
        $this->assertEquals('1000',$return['paymentData'][1]->amount_paid);
        $this->assertEquals((float)'26000',$return['total']);
    }

    public function testProcessPaymentEmpty()
    {
        $entities = $this->StudentFeePayments->newEntities(
            [
                [
                    'amount_to_pay' => '25000',
                    'fee_id' => '1',
                    'fee_category_id' => '1',
                    'amount_paid' => '',
                    'student_fee_id' => '1'
                ],
                [
                    'amount_to_pay' => '2000',
                    'fee_id' => '',
                    'fee_category_id' => '2',
                    'amount_paid' => '',
                    'student_fee_id' => '2'
                ]
            ]
        );
        $expected = [
            'paymentData' =>[],
            'total' => 0
        ];
        $this->assertEquals($expected,$this->StudentFeePayments->processPaymentData($entities));
    }

    /**
     * Test payFees method
     *
     * @return void
     */
    public function testPayFees()
    {
        $postData = [
            'student_id' => '001',
            'student_fees' => [
                0 => [
                    'amount_to_pay' => '25000',
                    'fee_id' => '1',
                    'fee_category_id' => '1',
                    'amount_paid' => '25000',
                    'student_fee_id' => '1'
                ],
                1 => [
                    'amount_to_pay' => '2000',
                    'fee_id' => '',
                    'fee_category_id' => '2',
                    'amount_paid' => '1000',
                    'student_fee_id' => '2'
                ]
            ],
            'payment' => [
                'payment_made_by' => 'student',
                'payment_type_id' => '1',
                'payment_received_by' => '6ae8971c-e86b-4e8c-9d45-cc6a87010452'
            ],
            'generate_receipt' => 'two'
        ];
        $expected = [
            'receipt_id' => 3
        ];
        $this->assertEquals($expected,$this->StudentFeePayments->payFees($postData));
        $this->assertEventFired(StudentFeePaymentsTable::EVENT_AFTER_EACH_FEE_PAYMENT, $this->StudentFeePayments->getEventManager());
        $this->assertEventFired(StudentFeePaymentsTable::EVENT_AFTER_FEES_PAYMENT, $this->StudentFeePayments->getEventManager());
    }

    public function testPayFeesFailedNoPaymentAmount()
    {
        $postData = [
            'student_id' => '1000',
            'student_fees' => [
                (int) 0 => [
                    'amount_to_pay' => '25000',
                    'fee_id' => '1',
                    'fee_category_id' => '1',
                    'amount_paid' => '',
                    'student_fee_id' => '1'
                ],
                (int) 1 => [
                    'amount_to_pay' => '2000',
                    'fee_id' => '',
                    'fee_category_id' => '2',
                    'amount_paid' => '',
                    'student_fee_id' => '2'
                ]
            ],
            'payment' => [
                'payment_made_by' => 'student',
                'payment_type_id' => '1',
                'payment_received_by' => '6ae8971c-e86b-4e8c-9d45-cc6a87010452'
            ],
            'generate_receipt' => 'two'
        ];
        $return = $this->StudentFeePayments->payFees($postData);
        $this->assertEquals('No payment amount was entered for payment',$return['error']);
    }

    /**
     * Test savePayment method
     *
     * @return void
     */
    public function testSavePayment()
    {
        $receipt = new Entity(['id'=>1,'total_amount_paid'=>26000,'student_id'=>1000]);
        $paymentArray = $this->StudentFeePayments->newEntities([
            [
                'amount_to_pay' => '25000',
                'fee_id' => '1',
                'fee_category_id' => '1',
                'amount_paid' => '25000',
                'student_fee_id' => '1'
            ],
            [
                'amount_to_pay' => '2000',
                'fee_id' => '',
                'fee_category_id' => '2',
                'amount_paid' => '1000',
                'student_fee_id' => '2'
            ]
        ]);
        $paymentDetail = [
            'payment_made_by' => 'student',
            'payment_type_id' => '1',
            'payment_received_by' => '6ae8971c-e86b-4e8c-9d45-cc6a87010452'
        ];
        $this->assertTrue($this->StudentFeePayments->savePayment($paymentArray,$receipt,$paymentDetail));
        $this->assertEventFired(StudentFeePaymentsTable::EVENT_AFTER_EACH_FEE_PAYMENT, $this->StudentFeePayments->getEventManager());
        $this->assertEventFired(StudentFeePaymentsTable::EVENT_AFTER_FEES_PAYMENT, $this->StudentFeePayments->getEventManager());
        $this->assertEventFired('Model.afterSave', $this->StudentFeePayments->getEventManager());
    }

    public function testGetStudentPaymentRecord()
    {
        $actual = $this->StudentFeePayments->getStudentPaymentRecords('001');
        $expected = [
            [
                'id' => 1,
                'student_fee_id' => 1,
                'amount_paid' => 1000,
            ],
            [
                'id' => 2,
                'student_fee_id' => 2,
                'amount_paid' => 1000,
                'student_fee' => [
                    'Purpose' => 'Damage'
                ]
            ]
        ];
        $this->assertEquals($expected[0]['id'], $actual[0]['id']);
        $this->assertEquals($expected[1]['student_fee']['Purpose'], $actual[1]['student_fee']['Purpose']);
    }

    public function testDestroyStudentFeePaymentsBelongingToReceipt()
    {
        $expected = [
            1 => 1000,
            2 => 1000
        ];
        $receipt = new Entity(['id' => 1]);
        $this->StudentFeePayments->destroyStudentFeePaymentsBelongingToReceipt($receipt);
        $this->assertEventFired(StudentFeePaymentsTable::EVENT_DELETED_PAYMENT_FEE_ITEM, $this->StudentFeePayments->getEventManager());
        $studentFeePayments = $this->StudentFeePayments->find()->all()->toArray();
        $this->assertEmpty($studentFeePayments);
        $studentFees = $this->StudentFeePayments->StudentFees->find()->all()->combine('id','amount_remaining')->toArray();
        $this->assertEquals($expected[1], $studentFees[1]);
    }
}
