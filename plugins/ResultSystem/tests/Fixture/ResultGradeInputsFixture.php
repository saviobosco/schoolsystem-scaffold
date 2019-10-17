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
        'main_value' => ['type' => 'string', 'length' => 30, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'replacement' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'percentage' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'output_order' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'visibility' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'session_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_unicode_ci'
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
            'session_id' => 1,
            'created' => '2019-10-16 01:27:35',
            'modified' => '2019-10-16 01:27:35'
        ],
        [
            'id' => 2,
            'main_value' => 'first_test',
            'replacement' => 'First Test',
            'percentage' => '10',
            'output_order' => 1,
            'session_id' => 2,
            'created' => '2019-10-16 01:27:35',
            'modified' => '2019-10-16 01:27:35'
        ],
        [
            'id' => 3,
            'main_value' => 'second_test',
            'replacement' => 'Second Test',
            'percentage' => '10',
            'output_order' => 2,
            'session_id' => 2,
            'created' => '2019-10-16 01:27:35',
            'modified' => '2019-10-16 01:27:35'
        ]
    ];
}
