<?php
namespace BankSystem\Test\TestCase\Model\Table;

use BankSystem\Model\Table\DebitTransactionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * BankSystem\Model\Table\DebitTransactionsTable Test Case
 */
class DebitTransactionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \BankSystem\Model\Table\DebitTransactionsTable
     */
    public $DebitTransactions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.bank_system.debit_transactions',
        'plugin.bank_system.accounts',
        'plugin.bank_system.transaction_logs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DebitTransactions') ? [] : ['className' => DebitTransactionsTable::class];
        $this->DebitTransactions = TableRegistry::get('DebitTransactions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DebitTransactions);

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
