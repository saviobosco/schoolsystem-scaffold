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
        'amount_paid' => ['type' => 'decimal', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'amount_remaining' => ['type' => 'decimal', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'receipt_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'fee_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'Fee id is need to know fee income', 'precision' => null, 'autoIncrement' => null],
        'fee_category_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'Fee Category id is need to know fee category income', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'student_payment_receipt_id' => ['type' => 'index', 'columns' => ['receipt_id'], 'length' => []],
            'payment_student_fee_id' => ['type' => 'index', 'columns' => ['student_fee_id'], 'length' => []],
            'payment_fee_id' => ['type' => 'index', 'columns' => ['fee_id'], 'length' => []],
            'payment_fee_category_id' => ['type' => 'index', 'columns' => ['fee_category_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'student_fee_payments_ibfk_1' => ['type' => 'foreign', 'columns' => ['receipt_id'], 'references' => ['receipts', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
            'student_fee_payments_ibfk_2' => ['type' => 'foreign', 'columns' => ['student_fee_id'], 'references' => ['student_fees', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
            'student_fee_payments_ibfk_3' => ['type' => 'foreign', 'columns' => ['fee_id'], 'references' => ['fees', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
            'student_fee_payments_ibfk_4' => ['type' => 'foreign', 'columns' => ['fee_category_id'], 'references' => ['fee_categories', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
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
            'amount_paid' => 1000,
            'amount_remaining' => 24000,
            'receipt_id' => 1,
            'fee_id' => 1,
            'fee_category_id' => 1,
            'created' => '2018-02-13 21:21:02',
            'modified' => '2018-02-13 21:21:02',
        ],
        [
            'id' => 2,
            'student_fee_id' => 2,
            'amount_paid' => 1000,
            'amount_remaining' => 1000,
            'receipt_id' => 1,
            'fee_id' => null,
            'fee_category_id' => 2,
            'created' => '2018-02-13 21:21:02',
            'modified' => '2018-02-13 21:21:02',
        ]
    ];
}
