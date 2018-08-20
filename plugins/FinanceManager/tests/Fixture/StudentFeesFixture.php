<?php
namespace FinanceManager\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StudentFeesFixture
 *
 */
class StudentFeesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'student_id' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => '', 'precision' => null, 'fixed' => null],
        'fee_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'fee_category_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'This column is used to track special fee', 'precision' => null, 'autoIncrement' => null],
        'amount' => ['type' => 'decimal', 'length' => 10, 'precision' => 0, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'paid' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'amount_remaining' => ['type' => 'decimal', 'length' => 10, 'precision' => 0, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'purpose' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_bin', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'created_by' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified_by' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'student_fee_fee_id' => ['type' => 'index', 'columns' => ['fee_id'], 'length' => []],
            'student_fee_student_id' => ['type' => 'index', 'columns' => ['student_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'student_fees_ibfk_1' => ['type' => 'foreign', 'columns' => ['fee_id'], 'references' => ['fees', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'student_fees_ibfk_2' => ['type' => 'foreign', 'columns' => ['student_id'], 'references' => ['students', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
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
            'student_id' => '001',
            'fee_id' => 1,
            'fee_category_id' => 1,
            'amount' => 2000,
            'paid' => 0,
            'amount_remaining' => null,
            'purpose' => '',
            'created' => '2018-02-13 19:47:44',
            'modified' => '2018-02-13 19:47:44',
            'created_by' => 'ca79c1f1-7aa9-452d-85de-10ef846ab70a',
            'modified_by' => '0a1248a3-42e2-4da5-bbea-2378e1defe6f'
        ],
        [
            'id' => 2,
            'student_id' => '001',
            'fee_id' => null,
            'fee_category_id' => 2,
            'amount' => 2000,
            'paid' => 0,
            'amount_remaining' => null,
            'purpose' => 'Damage',
            'created' => '2018-02-13 19:47:44',
            'modified' => '2018-02-13 19:47:44',
            'created_by' => 'ca79c1f1-7aa9-452d-85de-10ef846ab70a',
            'modified_by' => '0a1248a3-42e2-4da5-bbea-2378e1defe6f'
        ],
        [
            'id' => 3,
            'student_id' => '003',
            'fee_id' => 1,
            'fee_category_id' => 1,
            'amount' => 2000,
            'paid' => 1,
            'amount_remaining' => null,
            'purpose' => 'Damage',
            'created' => '2018-02-13 19:47:44',
            'modified' => '2018-02-13 19:47:44',
            'created_by' => 'ca79c1f1-7aa9-452d-85de-10ef846ab70a',
            'modified_by' => '0a1248a3-42e2-4da5-bbea-2378e1defe6f'
        ]
    ];
}
