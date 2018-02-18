<?php
namespace FinanceManager\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FeesFixture
 *
 */
class FeesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'fee_category_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount' => ['type' => 'decimal', 'length' => 10, 'precision' => 0, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'compulsory' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => '0', 'comment' => 'Used to mark a fee as compulsory', 'precision' => null],
        'income_amount_expected' => ['type' => 'decimal', 'length' => 10, 'precision' => 0, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => ''],
        'amount_earned' => ['type' => 'decimal', 'length' => 10, 'precision' => 0, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => ''],
        'number_of_students' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'term_id' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'class_id' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'session_id' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'created_by' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified_by' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'class_id' => ['type' => 'index', 'columns' => ['class_id'], 'length' => []],
            'fee_category_id' => ['type' => 'index', 'columns' => ['fee_category_id'], 'length' => []],
            'session_id' => ['type' => 'index', 'columns' => ['session_id'], 'length' => []],
            'term_id' => ['type' => 'index', 'columns' => ['term_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fees_ibfk_1' => ['type' => 'foreign', 'columns' => ['class_id'], 'references' => ['classes', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
            'fees_ibfk_2' => ['type' => 'foreign', 'columns' => ['fee_category_id'], 'references' => ['fee_categories', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
            'fees_ibfk_3' => ['type' => 'foreign', 'columns' => ['session_id'], 'references' => ['sessions', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
            'fees_ibfk_4' => ['type' => 'foreign', 'columns' => ['term_id'], 'references' => ['terms', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
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
            'fee_category_id' => 1,
            'amount' => 25000,
            'compulsory' => 1,
            'income_amount_expected' => 25000,
            'amount_earned' => null,
            'number_of_students' => 1,
            'term_id' => 1,
            'class_id' => 1,
            'session_id' => 1,
            'created' => '2018-02-13 19:50:00',
            'modified' => '2018-02-13 19:50:00',
            'created_by' => '61165c04-45bb-43b9-8b39-06d24d1189cf',
            'modified_by' => '7b44335b-50d1-4b0b-bddc-ac6d2397f028'
        ],
    ];
}
