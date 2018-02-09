<?php
namespace BankSystem\Test\TestCase\Model\Table;

use BankSystem\Model\Table\CreditTransactionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * BankSystem\Model\Table\CreditTransactionsTable Test Case
 */
class CreditTransactionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \BankSystem\Model\Table\CreditTransactionsTable
     */
    public $CreditTransactions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.bank_system.credit_transactions',
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
        $config = TableRegistry::exists('CreditTransactions') ? [] : ['className' => CreditTransactionsTable::class];
        $this->CreditTransactions = TableRegistry::get('CreditTransactions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CreditTransactions);

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
