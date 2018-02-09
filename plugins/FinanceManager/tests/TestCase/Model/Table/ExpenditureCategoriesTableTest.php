<?php
namespace FinanceManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use FinanceManager\Model\Table\ExpenditureCategoriesTable;

/**
 * FinanceManager\Model\Table\ExpenditureCategoriesTable Test Case
 */
class ExpenditureCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \FinanceManager\Model\Table\ExpenditureCategoriesTable
     */
    public $ExpenditureCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.expenditure_categories',
        'plugin.finance_manager.expenditures'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ExpenditureCategories') ? [] : ['className' => ExpenditureCategoriesTable::class];
        $this->ExpenditureCategories = TableRegistry::get('ExpenditureCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExpenditureCategories);

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
