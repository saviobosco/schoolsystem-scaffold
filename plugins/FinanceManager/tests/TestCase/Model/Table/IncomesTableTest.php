<?php
namespace FinanceManager\Test\TestCase\Model\Table;

use Cake\Database\Driver\Mysql;
use Cake\Database\Driver\Sqlite;
use Cake\I18n\Date;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use FinanceManager\Model\Table\IncomesTable;
use Cake\Datasource\ConnectionManager;

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

    public $autoFixtures = false;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
       /* $dsn = 'mysql://root:mypassword@172.17.0.2/test_db';
        ConnectionManager::drop('test');
        ConnectionManager::setConfig('test', ['url' => $dsn]);*/
        $config = TableRegistry::exists('Incomes') ? [] : ['className' => IncomesTable::class];
        $this->Incomes = TableRegistry::get('Incomes', $config);
        $this->loadFixtures();
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
        $this->assertEquals([], $this->Incomes->getIncomeWithPassedValue($postData));
        $postData['query'] = 'month';
        $this->assertEquals([], $this->Incomes->getIncomeWithPassedValue($postData));

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
        if ($this->Incomes->getConnection()->getDriver() instanceof Mysql) {
            $this->assertEquals($expected[0]['amount'], $this->Incomes->getIncomeWithPassedValue($postData)[0]['amount']);
        }
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
        ];
        if ($this->Incomes->getConnection()->getDriver() instanceof Mysql) {
            $this->assertEquals($expected[0]['amount'],$this->Incomes->getIncomeWithDateRange(new Date($postData['start_date']),(new Time($postData['end_date']))->addHours(23)->addMinutes(59) )[0]['amount']);
        }
    }

    public function testRemoveRecordWithReceiptId()
    {
        $actual = $this->Incomes->removeRecordWithReceiptId(new Entity(['id' => 1]));
        $this->assertEquals(true, $actual);
    }
}
