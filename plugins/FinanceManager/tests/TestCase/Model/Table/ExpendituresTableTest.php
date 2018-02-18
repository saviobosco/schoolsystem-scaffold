<?php
namespace FinanceManager\Test\TestCase\Model\Table;

use Cake\I18n\Date;
use Cake\I18n\FrozenDate;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use FinanceManager\Model\Table\ExpendituresTable;

/**
 * FinanceManager\Model\Table\ExpendituresTable Test Case
 */
class ExpendituresTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \FinanceManager\Model\Table\ExpendituresTable
     */
    public $Expenditures;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.expenditures',
        'plugin.finance_manager.expenditure_categories',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Expenditures') ? [] : ['className' => ExpendituresTable::class];
        $this->Expenditures = TableRegistry::get('Expenditures', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Expenditures);

        parent::tearDown();
    }

    /**
     * Test getExpenditureWithPassedValue method
     *
     * @return void
     */
    public function testGetExpenditureWithPassedValue()
    {
        $postData = [
            'query' => 'year'
        ];
        $expected = [
            [
                'id' => 1,
                'expenditure_category_id' => 1,
                'purpose' => 'School Feeding',
                'date' => new FrozenDate('2018-01-07'),
                'amount' => 15000,
                'expenditure_category' => [
                    'id' => 1,
                    'type' => 'Feeding',
                ]
            ]
        ];
        $this->assertEquals($expected,$this->Expenditures->getExpenditureWithPassedValue($postData));
    }

    /**
     * Test getExpenditureWithDateRange method
     *
     * @return void
     */
    public function testGetExpenditureWithDateRange()
    {
        $postData = [
            'query' => 'custom',
            'start_date' => '12/30/2017',
            'end_date' => '02/16/2018',
        ];
        $expected = [
            [
                'id' => 1,
                'expenditure_category_id' => 1,
                'purpose' => 'School Feeding',
                'date' => new FrozenDate('2018-01-07'),
                'amount' => 15000,
                'expenditure_category' => [
                    'id' => 1,
                    'type' => 'Feeding',
                ]
            ]
        ];
        $this->assertEquals($expected,$this->Expenditures->getExpenditureWithDateRange(new Date($postData['start_date']),(new Time($postData['end_date']))->addHours(23)->addMinutes(59)));
    }

    /**
     * Test getExpenditureWithPassedValueArrangedByExpenditureCat method
     *
     * @return void
     */
    public function testGetExpenditureWithPassedValueArrangedByExpenditureCat()
    {
        $postData = [
            'query' => 'year'
        ];
        $expected = [
            1 => [
                0 => [
                    'expenditure_category_id' => 1,
                    'amount' => 15000,
                    'expenditure_category' => [
                        'id' => 1,
                        'type' => 'Feeding'
                    ]
                ]
            ]
        ];
        $this->assertEquals($expected,$this->Expenditures->getExpenditureWithPassedValueArrangedByExpenditureCat($postData));
    }

    /**
     * Test getExpenditureWithDateRangeArrangedByExpenditureCat method
     *
     * @return void
     */
    public function testGetExpenditureWithDateRangeArrangedByExpenditureCat()
    {
        $postData = [
            'query' => 'custom',
            'start_date' => '12/30/2017',
            'end_date' => '02/16/2018',
        ];
        $expected = [
            1 => [
                0 => [
                    'expenditure_category_id' => 1,
                    'amount' => 15000,
                    'expenditure_category' => [
                        'id' => 1,
                        'type' => 'Feeding'
                    ]
                ]
            ]
        ];
        $this->assertEquals($expected,$this->Expenditures->getExpenditureWithDateRangeArrangedByExpenditureCat(new Date($postData['start_date']),(new Time($postData['end_date']))->addHours(23)->addMinutes(59)));
    }
}
