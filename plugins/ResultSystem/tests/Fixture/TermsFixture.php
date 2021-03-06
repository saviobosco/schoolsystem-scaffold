<?php
namespace ResultSystem\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TermsFixture
 *
 */
class TermsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 30, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
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
            'name' => 'First Term',
            'created' => '2016-09-01 22:15:35',
            'modified' => '2016-09-01 22:15:35'
        ],
        [
            'id' => 2,
            'name' => 'Second Term',
            'created' => '2016-09-01 22:15:35',
            'modified' => '2016-09-01 22:15:35'
        ],
        [
            'id' => 3,
            'name' => 'Third Term',
            'created' => '2016-09-01 22:15:35',
            'modified' => '2016-09-01 22:15:35'
        ],
        [
            'id' => 4,
            'name' => 'Annual Term',
            'created' => '2016-09-01 22:15:35',
            'modified' => '2016-09-01 22:15:35'
        ],
    ];
}
