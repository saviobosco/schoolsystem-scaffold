<?php
namespace UsersManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use UsersManager\Model\Table\LoginsTable;

/**
 * UsersManager\Model\Table\LoginsTable Test Case
 */
class LoginsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \UsersManager\Model\Table\LoginsTable
     */
    public $Logins;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.users_manager.logins',
        'plugin.users_manager.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Logins') ? [] : ['className' => LoginsTable::class];
        $this->Logins = TableRegistry::get('Logins', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Logins);

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
