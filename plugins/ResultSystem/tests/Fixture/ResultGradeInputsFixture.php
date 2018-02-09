<?php
namespace ResultSystem\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ResultGradeInputsFixture
 *
 */
class ResultGradeInputsFixture extends TestFixture
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
        'replacement' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_bin', 'comment' => '', 'precision' => null, 'fixed' => null],
        'percentage' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_bin', 'comment' => '', 'precision' => null, 'fixed' => null],
        'output_order' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'visibility' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null],
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
            'main_value' => 'first_test',
            'replacement' => 'First Test',
            'percentage' => '10',
            'output_order' => 1,
            'visibility' => 1
        ],
        [
            'id' => 2,
            'main_value' => 'second_test',
            'replacement' => 'Second Test',
            'percentage' => '10',
            'output_order' => 2,
            'visibility' => 0
        ],
        [
            'id' => 3,
            'main_value' => 'third_test',
            'replacement' => 'Third Test',
            'percentage' => '10',
            'output_order' => 3,
            'visibility' => 0
        ],
        [
            'id' => 4,
            'main_value' => 'exam',
            'replacement' => 'Examination',
            'percentage' => '70',
            'output_order' => 4,
            'visibility' => 1
        ],
    ];
}
