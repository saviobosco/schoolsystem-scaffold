<?php
namespace BankSystem\Test\TestCase\Model\Table;

use BankSystem\Model\Table\AccountTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * BankSystem\Model\Table\AccountTypesTable Test Case
 */
class AccountTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \BankSystem\Model\Table\AccountTypesTable
     */
    public $AccountTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.bank_system.account_types',
        'plugin.bank_system.account_holders'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AccountTypes') ? [] : ['className' => AccountTypesTable::class];
        $this->AccountTypes = TableRegistry::get('AccountTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AccountTypes);

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
}
