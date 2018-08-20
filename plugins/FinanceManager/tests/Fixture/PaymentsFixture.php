<?php
namespace FinanceManager\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PaymentsFixture
 *
 */
class PaymentsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'receipt_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'payment_made_by' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_bin', 'comment' => '', 'precision' => null, 'fixed' => null],
        'payment_type_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'payment_received_by' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'payment_status' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'payment_approved_by' => ['type' => 'uuid', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'payment_approved_on' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'payment_payment_type_id' => ['type' => 'index', 'columns' => ['payment_type_id'], 'length' => []],
            'payment_receipt_id' => ['type' => 'index', 'columns' => ['receipt_id'], 'length' => []],
            'payment_made_by' => ['type' => 'index', 'columns' => ['payment_made_by'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'payments_ibfk_1' => ['type' => 'foreign', 'columns' => ['payment_type_id'], 'references' => ['payment_types', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
            'payments_ibfk_2' => ['type' => 'foreign', 'columns' => ['receipt_id'], 'references' => ['receipts', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
            'receipt_id' => 1,
            'payment_made_by' => 'Lorem ipsum dolor sit amet',
            'payment_type_id' => 1,
            'payment_received_by' => 'ac794aa2-bd1d-4cfc-a736-7e8afb53b083',
            'payment_status' => 1,
            'payment_approved_by' => '66278d5c-799f-4853-8376-5ac800740eb0',
            'payment_approved_on' => '2018-01-07 10:17:38',
            'created' => '2018-01-07 10:17:38',
            'modified' => '2018-01-07 10:17:38'
        ],
    ];
}
