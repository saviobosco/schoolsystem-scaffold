<?php
namespace FinanceManager\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StudentFeePaymentsFixture
 *
 */
class StudentFeePaymentsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'student_fee_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'amount_paid' => ['type' => 'decimal', 'length' => 10, 'precision' => 0, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'amount_remaining' => ['type' => 'decimal', 'length' => 10, 'precision' => 0, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'receipt_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'fee_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'Fee id is need to know fee income', 'precision' => null, 'autoIncrement' => null],
        'fee_category_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'Fee Category id is need to know fee category income', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'created_by' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified_by' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'receipt_id' => ['type' => 'index', 'columns' => ['receipt_id'], 'length' => []],
            'student_fee_id' => ['type' => 'index', 'columns' => ['student_fee_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'student_fee_payments_ibfk_1' => ['type' => 'foreign', 'columns' => ['receipt_id'], 'references' => ['receipts', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
            'student_fee_payments_ibfk_2' => ['type' => 'foreign', 'columns' => ['student_fee_id'], 'references' => ['student_fees', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
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
            'student_fee_id' => 1,
            'amount_paid' => 1.5,
            'amount_remaining' => 1.5,
            'receipt_id' => 1,
            'fee_id' => 1,
            'fee_category_id' => 1,
            'created' => '2018-01-07 10:55:24',
            'modified' => '2018-01-07 10:55:24',
            'created_by' => 'd3c1b4db-9340-45cc-8209-2dbefc9d6b8a',
            'modified_by' => '9a0f48ad-895c-4364-974a-caea4559c682'
        ],
    ];
}
