<?php
namespace ResultSystem\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ResultRemarkInputsFixture
 *
 */
class ResultRemarkInputsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'main_value' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => '', 'precision' => null, 'fixed' => null],
        'replacement' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => '', 'precision' => null, 'fixed' => null],
        'output_order' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'visibility' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
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
            'main_value' => 'remark_1',
            'replacement' => 'Teacher 1',
            'output_order' => 1,
            'visibility' => 1
        ],
        [
            'id' => 2,
            'main_value' => 'remark_2',
            'replacement' => 'Teacher 2',
            'output_order' => 2,
            'visibility' => 1
        ],
        [
            'id' => 3,
            'main_value' => 'remark_3',
            'replacement' => 'Teacher 3',
            'output_order' => 2,
            'visibility' => 0
        ],
    ];
}
