<?php
namespace BankSystem\Test\TestCase\Model\Table;

use BankSystem\Model\Table\TransactionLogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * BankSystem\Model\Table\TransactionLogsTable Test Case
 */
class TransactionLogsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \BankSystem\Model\Table\TransactionLogsTable
     */
    public $TransactionLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.bank_system.transaction_logs',
        'plugin.bank_system.credit_transactions',
        'plugin.bank_system.accounts',
        'plugin.bank_system.debit_transactions',
        'plugin.bank_system.transfer_logs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TransactionLogs') ? [] : ['className' => TransactionLogsTable::class];
        $this->TransactionLogs = TableRegistry::get('TransactionLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TransactionLogs);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
