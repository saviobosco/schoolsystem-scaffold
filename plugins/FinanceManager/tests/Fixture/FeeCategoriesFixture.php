<?php
namespace FinanceManager\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FeeCategoriesFixture
 *
 */
class FeeCategoriesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'type' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => '', 'precision' => null, 'fixed' => null],
        'description' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_bin', 'comment' => '', 'precision' => null],
        'income_amount' => ['type' => 'decimal', 'length' => 10, 'precision' => 0, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => ''],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_bin'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'type' => 'School Fees',
            'description' => 'School Fees.',
            'income_amount' => 0,
            'created' => '2018-01-07 10:17:16',
            'modified' => '2018-01-07 10:17:16'
        ],
        [
            'id' => 2,
            'type' => 'Damage',
            'description' => 'Damage.',
            'income_amount' => 0,
            'created' => '2018-01-07 10:17:16',
            'modified' => '2018-01-07 10:17:16'
        ],
        [
            'id' => 3,
            'type' => 'Medicals',
            'description' => 'Medicals',
            'income_amount' => 0,
            'created' => '2018-01-07 10:17:16',
            'modified' => '2018-01-07 10:17:16'
        ]
    ];
}
