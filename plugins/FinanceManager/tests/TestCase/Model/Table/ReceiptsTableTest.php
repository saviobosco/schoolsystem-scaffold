<?php
namespace FinanceManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use FinanceManager\Model\Table\ReceiptsTable;
use Cake\Orm\Entity;
use Cake\I18n\FrozenTime;

/**
 * FinanceManager\Model\Table\ReceiptsTable Test Case
 */
class ReceiptsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \FinanceManager\Model\Table\ReceiptsTable
     */
    public $Receipts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.receipts',
        'plugin.finance_manager.student_fee_payments',
        'plugin.finance_manager.student_fees',
        'plugin.finance_manager.students',
        'plugin.finance_manager.classes',
        'plugin.finance_manager.sessions',
        'plugin.finance_manager.fees',
        'plugin.finance_manager.fee_categories',
        'plugin.finance_manager.terms',
        'plugin.finance_manager.payments',
        'plugin.finance_manager.incomes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Receipts') ? [] : ['className' => ReceiptsTable::class];
        $this->Receipts = TableRegistry::get('Receipts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Receipts);

        parent::tearDown();
    }

    /**
     * Test generateReceipt method
     *
     * @return void
     */
    public function testGenerateReceipt()
    {
        $this->assertInstanceOf(Entity::class, $this->Receipts->generateReceipt('001', '25000'));
    }

    /**
     * Test deleteReceipt method
     *
     * @return void
     */
    public function testDeleteReceipt()
    {
        $this->assertTrue($this->Receipts->deleteReceipt(new Entity(['id'=>1])));
    }

    public function testDeleteReceiptFailed()
    {
        $this->assertFalse($this->Receipts->deleteReceipt(new Entity(['id'=>2])));
    }

    /**
     * Test getReceiptDetails method
     *
     * @return void
     */
    public function testGetReceiptDetails()
    {
        $expected = [
            0 => [
                'id' => 1,
                'student_fee_id' => 1,
                'receipt_id' => 1,
            ]
        ];
        $result = $this->Receipts->getReceiptDetails(1);
        $this->assertEquals($expected[0]['receipt_id'],$result[0]['receipt_id']);
        $this->assertEquals(2,count($result));
    }
}
