<?php
namespace FinanceManager\Test\TestCase\Model\Table;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use FinanceManager\Model\Table\PaymentsTable;

/**
 * FinanceManager\Model\Table\PaymentsTable Test Case
 */
class PaymentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \FinanceManager\Model\Table\PaymentsTable
     */
    public $Payments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.payments',
        'plugin.finance_manager.receipts',
        'plugin.finance_manager.payment_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Payments') ? [] : ['className' => PaymentsTable::class];
        $this->Payments = TableRegistry::get('Payments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Payments);

        parent::tearDown();
    }

    public function testGeneratePaymentRecord()
    {
        $paymentData = [
            'receipt_id' => 1,
            'payment_made_by' => 'Parent',
            'payment_type_id' => 1,
            'payment_received_by' => 'ac794aa2-bd1d-4cfc-a736-7e8afb53b083',
        ];
        $this->assertInstanceOf(Entity::class, $this->Payments->generatePaymentRecord($paymentData));
    }

    public function testGetPaymentDetails()
    {
        $this->assertEquals(1, $this->Payments->getPaymentDetails(1)['id']);
    }
}
