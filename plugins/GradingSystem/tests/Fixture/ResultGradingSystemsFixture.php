<?php
namespace GradingSystem\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ResultGradingSystemsFixture
 *
 */
class ResultGradingSystemsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'grade' => ['type' => 'string', 'length' => 30, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'score' => ['type' => 'string', 'length' => 15, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'remark' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'cal_order' => ['type' => 'integer', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
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
            'grade' => 'A',
            'score' => '75 - 100',
            'remark' => 'Distinction',
            'cal_order' => 1,
            'created' => '2017-07-13 14:09:37',
            'modified' => '2017-07-13 14:09:37'
        ],
        [
            'id' => 2,
            'grade' => 'B',
            'score' => '55 - 74',
            'remark' => 'Credit',
            'cal_order' => 2,
            'created' => '2017-07-13 14:09:37',
            'modified' => '2017-07-13 14:09:37'
        ],
        [
            'id' => 3,
            'grade' => 'P',
            'score' => '45 - 54',
            'remark' => 'Pass',
            'cal_order' => 3,
            'created' => '2017-07-13 14:09:37',
            'modified' => '2017-07-13 14:09:37'
        ],
        [
            'id' => 4,
            'grade' => 'F',
            'score' => '0 - 45',
            'remark' => 'Fail',
            'cal_order' => 4,
            'created' => '2017-07-13 14:09:37',
            'modified' => '2017-07-13 14:09:37'
        ],
    ];
}
