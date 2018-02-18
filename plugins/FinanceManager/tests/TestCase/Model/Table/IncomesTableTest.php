<?php
namespace FinanceManager\Test\TestCase\Model\Table;

use Cake\I18n\Date;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use FinanceManager\Model\Table\IncomesTable;

/**
 * FinanceManager\Model\Table\IncomesTable Test Case
 */
class IncomesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \FinanceManager\Model\Table\IncomesTable
     */
    public $Incomes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.incomes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Incomes') ? [] : ['className' => IncomesTable::class];
        $this->Incomes = TableRegistry::get('Incomes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Incomes);

        parent::tearDown();
    }

    /**
     * Test getIncomeWithPassedValue method
     *
     * @return void
     */
    public function testGetIncomeWithPassedValue()
    {
        $postData = ['query' => 'week'];
        $this->assertEquals([],$this->Incomes->getIncomeWithPassedValue($postData));
        $postData['query'] = 'month';
        $this->assertEquals([],$this->Incomes->getIncomeWithPassedValue($postData));
        $expected = [
            [
                'id' => 1,
                'amount' => 10000,
                'week' => 1,
                'month' => 1,
                'year' => 1,
                'created' => new FrozenTime('2018-01-07 10:21:42'),
                'modified' => new FrozenTime('2018-01-07 10:21:42')
            ],
            [
                'id' => 2,
                'amount' => 20000,
                'week' => 1,
                'month' => 1,
                'year' => 1,
                'created' => new FrozenTime('2018-01-07 10:21:42'),
                'modified' => new FrozenTime('2018-01-07 10:21:42')
            ]
        ];
        $postData['query'] = 'year';
        $this->assertEquals($expected,$this->Incomes->getIncomeWithPassedValue($postData));
    }

    /**
     * Test getIncomeWithDateRange method
     *
     * @return void
     */
    public function testGetIncomeWithDateRange()
    {
        $postData = [
            'query' => 'custom',
            'start_date' => '12/30/2017',
            'end_date' => '02/16/2018',
        ];
        $expected = [
            [
                'id' => 1,
                'amount' => 10000,
                'week' => 1,
                'month' => 1,
                'year' => 1,
                'created' => new FrozenTime('2018-01-07 10:21:42'),
                'modified' => new FrozenTime('2018-01-07 10:21:42')
            ],
            [
                'id' => 2,
                'amount' => 20000,
                'week' => 1,
                'month' => 1,
                'year' => 1,
                'created' => new FrozenTime('2018-01-07 10:21:42'),
                'modified' => new FrozenTime('2018-01-07 10:21:42')
            ]
        ];
        $this->assertEquals($expected,$this->Incomes->getIncomeWithDateRange(new Date($postData['start_date']),(new Time($postData['end_date']))->addHours(23)->addMinutes(59) ));
    }
}
