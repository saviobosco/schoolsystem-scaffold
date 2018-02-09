<?php
namespace BankSystem\Test\TestCase\Model\Table;

use BankSystem\Model\Table\AccountHoldersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * BankSystem\Model\Table\AccountHoldersTable Test Case
 */
class AccountHoldersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \BankSystem\Model\Table\AccountHoldersTable
     */
    public $AccountHolders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.bank_system.account_holders',
        'plugin.bank_system.account_types'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AccountHolders') ? [] : ['className' => AccountHoldersTable::class];
        $this->AccountHolders = TableRegistry::get('AccountHolders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AccountHolders);

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
