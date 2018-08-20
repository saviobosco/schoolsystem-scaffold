<?php
namespace FinanceManager\Test\TestCase\Model\Table;

use Cake\Database\Driver\Mysql;
use Cake\I18n\Date;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use FinanceManager\Model\Table\FeeCategoriesTable;

/**
 * FinanceManager\Model\Table\FeeCategoriesTable Test Case
 */
class FeeCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \FinanceManager\Model\Table\FeeCategoriesTable
     */
    public $FeeCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.fee_categories',
        'plugin.finance_manager.fees',
        'plugin.finance_manager.students',
        'plugin.finance_manager.student_fees',
        'plugin.finance_manager.student_fee_payments',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('FeeCategories') ? [] : ['className' => FeeCategoriesTable::class];
        $this->FeeCategories = TableRegistry::get('FeeCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FeeCategories);

        parent::tearDown();
    }

    /**
     * Test findIncomeByFeeCategories method
     *
     * @return void
     */
    public function testFindIncomeByFeeCategories()
    {
        $expected = [
            [
                'id' => 1,
                'type' => 'School Fees',
                'income_amount' => 0
            ]
        ];
        $this->assertArraySubset($expected,$this->FeeCategories->findIncomeByFeeCategories());
    }

    /**
     * Test deleteFeeCategory method
     *
     * @return void
     */
    public function testDeleteFeeCategory()
    {
        $fee_category = new Entity(['id'=>1]);
        $this->assertNotTrue($this->FeeCategories->deleteFeeCategory($fee_category));
    }

    /**
     * Test getIncomeByFeeCategories method
     *
     * @return void
     */
    public function testGetIncomeByFeeCategories()
    {
        $postData = ['query' => 'year'];
        $expected = [
            0 => [
                'id' => 1,
                'type' => 'School Fees',
                'student_fee_payments' => [
                    0 => [
                        'id' => 1,
                        'fee_category_id' => 1,
                        'amount_paid' => 1000,
                        'created' => new FrozenTime('2018-02-13 21:21:02'),
                    ]
                ]
            ],
            1 => [
                'id' => 2,
                'type' => 'Damage',
                'student_fee_payments' => [
                    0 => [
                        'id' => 2,
                        'fee_category_id' => 2,
                        'amount_paid' => 1000,
                        'created' => new FrozenTime('2018-02-13 21:21:02'),
                    ]
                ]
            ],
        ];
        if ($this->FeeCategories->getConnection()->getDriver() instanceof Mysql) {
            $actual = $this->FeeCategories->getIncomeByFeeCategories($postData);
            $this->assertEquals($expected[0], $actual[0]);
        }
    }

    /**
     * Test getIncomeByFeeCategoriesWithDateRange method
     *
     * @return void
     */
    public function testGetIncomeByFeeCategoriesWithDateRange()
    {
        $postData = [
            'query' => 'custom',
            'start_date' => '12/30/2017',
            'end_date' => '02/16/2018',
        ];
        $expected = [
            0 => [
                'id' => 1,
                'type' => 'School Fees',
                'student_fee_payments' => [
                    0 => [
                        'id' => 1,
                        'fee_category_id' => 1,
                        'amount_paid' => 1000,
                        'created' => new FrozenTime('2018-02-13 21:21:02'),
                    ]
                ]
            ],
            1 => [
                'id' => 2,
                'type' => 'Damage',
                'student_fee_payments' => [
                    0 => [
                        'id' => 2,
                        'fee_category_id' => 2,
                        'amount_paid' => 1000,
                        'created' => new FrozenTime('2018-02-13 21:21:02'),
                    ]
                ]
            ],
        ];
        $actual = $this->FeeCategories->getIncomeByFeeCategoriesWithDateRange(new Date($postData['start_date']),(new Time($postData['end_date']))->addHours(23)->addMinutes(59));
        $this->assertEquals($expected[0]['type'], $actual[0]['type']);
        $this->assertEquals($expected[0]['id'], $actual[0]['id']);
        $this->assertEquals($expected[0]['student_fee_payments'], $actual[0]['student_fee_payments']);
    }
}
