<?php
namespace BankSystem\Test\TestCase\Model\Table;

use BankSystem\Model\Table\EWalletsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * BankSystem\Model\Table\EWalletsTable Test Case
 */
class EWalletsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \BankSystem\Model\Table\EWalletsTable
     */
    public $EWallets;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.bank_system.e_wallets',
        'plugin.bank_system.accounts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EWallets') ? [] : ['className' => EWalletsTable::class];
        $this->EWallets = TableRegistry::get('EWallets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EWallets);

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
