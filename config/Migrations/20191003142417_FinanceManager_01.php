<?php
use Migrations\AbstractMigration;

class FinanceManager01 extends AbstractMigration
{
    public function up()
    {
        if ( $this->table('expenditure_categories')->exists() === false ) {
            $this->table('expenditure_categories')
                ->addColumn('type', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => false,
                ])
                ->addColumn('description', 'text', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('created', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('modified', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->create();

        }

        if ( $this->table('expenditures')->exists() === false ) {
            $this->table('expenditures')
                ->addColumn('expenditure_category_id', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => true,
                ])
                ->addColumn('purpose', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => false,
                ])
                ->addColumn('date', 'date', [
                    'comment' => 'The date the expenditure was used ',
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('created', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('modified', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('created_by', 'uuid', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('modified_by', 'uuid', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('amount', 'decimal', [
                    'default' => null,
                    'limit' => 10,
                    'null' => false,
                ])
                ->addIndex(
                    [
                        'expenditure_category_id',
                    ]
                )
                ->create();
        }

        if ( $this->table('fee_categories')->exists() === false) {
            $this->table('fee_categories')
                ->addColumn('type', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => false,
                ])
                ->addColumn('description', 'text', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('income_amount', 'decimal', [
                    'default' => '0',
                    'limit' => 10,
                    'null' => false,
                ])
                ->addColumn('created', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('modified', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->create();
        }

        if ( $this->table('fees')->exists() === false) {
            $this->table('fees')
                ->addColumn('fee_category_id', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => false,
                ])
                ->addColumn('amount', 'decimal', [
                    'default' => null,
                    'limit' => 10,
                    'null' => false,
                ])
                ->addColumn('compulsory', 'boolean', [
                    'comment' => 'Used to mark a fee as compulsory',
                    'default' => false,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('income_amount_expected', 'decimal', [
                    'default' => '0',
                    'limit' => 10,
                    'null' => true,
                ])
                ->addColumn('amount_earned', 'decimal', [
                    'default' => '0',
                    'limit' => 10,
                    'null' => true,
                ])
                ->addColumn('number_of_students', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => true,
                ])
                ->addColumn('term_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => true,
                ])
                ->addColumn('class_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('session_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('created', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('modified', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('created_by', 'uuid', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('modified_by', 'uuid', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addIndex(['class_id', 'fee_category_id', 'session_id', 'term_id'])
                /*->addIndex(
                    [
                        'fee_category_id',
                    ]
                )
                ->addIndex(
                    [
                        'session_id',
                    ]
                )
                ->addIndex(
                    [
                        'term_id',
                    ]
                )*/
                ->create();

        }

        if ( $this->table('incomes')->exists() === false ) {
            $this->table('incomes')
                ->addColumn('amount', 'decimal', [
                    'default' => null,
                    'limit' => 10,
                    'null' => false,
                ])
                ->addColumn('week', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => false,
                ])
                ->addColumn('month', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => false,
                ])
                ->addColumn('year', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => false,
                ])
                ->addColumn('created', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('modified', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->create();
        }

        if ( $this->table('payment_types')->exists() === false) {
            $this->table('payment_types')
                ->addColumn('type', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => false,
                ])
                ->addColumn('created', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('modified', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->create();

        }

        if ( $this->table('payments')->exists() === false) {
            $this->table('payments')
                ->addColumn('receipt_id', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => false,
                ])
                ->addColumn('payment_made_by', 'string', [
                    'default' => null,
                    'limit' => 100,
                    'null' => false,
                ])
                ->addColumn('payment_type_id', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => false,
                ])
                ->addColumn('payment_received_by', 'uuid', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('payment_status', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => false,
                ])
                ->addColumn('payment_approved_by', 'uuid', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('payment_approved_on', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('created', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('modified', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addIndex(['payment_type_id', 'receipt_id', 'payment_made_by'])
                ->create();
        }


        if ( $this->table('receipts')->exists() === false ) {
            $this->table('receipts')
                ->addColumn('student_id', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => false,
                ])
                ->addColumn('total_amount_paid', 'decimal', [
                    'default' => null,
                    'limit' => 10,
                    'null' => false,
                ])
                ->addColumn('created', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('modified', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('created_by', 'uuid', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('modified_by', 'uuid', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addIndex('student_id')
                ->create();
        }



        if ( $this->table('student_fee_payments')->exists() === false) {
            $this->table('student_fee_payments')
                ->addColumn('student_fee_id', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => false,
                ])
                ->addColumn('amount_paid', 'decimal', [
                    'default' => null,
                    'limit' => 10,
                    'null' => false,
                ])
                ->addColumn('amount_remaining', 'decimal', [
                    'default' => null,
                    'limit' => 10,
                    'null' => true,
                ])
                ->addColumn('receipt_id', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => false,
                ])
                ->addColumn('fee_id', 'integer', [
                    'comment' => 'Fee id is need to know fee income',
                    'default' => null,
                    'limit' => 11,
                    'null' => true,
                ])
                ->addColumn('fee_category_id', 'integer', [
                    'comment' => 'Fee Category id is need to know fee category income',
                    'default' => null,
                    'limit' => 11,
                    'null' => true,
                ])
                ->addColumn('created', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('modified', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addIndex(['receipt_id', 'student_fee_id'])
                ->create();
        }

        if ( $this->table('student_fees')->exists() === false) {
            $this->table('student_fees')
                ->addColumn('student_id', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => false,
                ])
                ->addColumn('fee_id', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => true,
                ])
                ->addColumn('fee_category_id', 'integer', [
                    'comment' => 'This column is used to track special fee',
                    'default' => null,
                    'limit' => 11,
                    'null' => true,
                ])
                ->addColumn('amount', 'decimal', [
                    'default' => null,
                    'limit' => 10,
                    'null' => true,
                ])
                ->addColumn('paid', 'boolean', [
                    'default' => false,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('amount_remaining', 'decimal', [
                    'default' => null,
                    'limit' => 10,
                    'null' => true,
                ])
                ->addColumn('purpose', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => true,
                ])
                ->addColumn('created', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('modified', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addIndex(['fee_id', 'student_id'])
                ->create();
        }



        /**
         * Adding foreign keys for Finance Manager.
         */
        $this->table('expenditures')
            ->addForeignKey(
                'expenditure_category_id',
                'expenditure_categories',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('fees')
            ->addForeignKey(
                'class_id',
                'classes',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'fee_category_id',
                'fee_categories',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'session_id',
                'sessions',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'term_id',
                'terms',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('payments')
            ->addForeignKey(
                'payment_type_id',
                'payment_types',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'receipt_id',
                'receipts',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();


        $this->table('receipts')
            ->addForeignKey(
                'student_id',
                'students',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('student_fee_payments')
            ->addForeignKey(
                'receipt_id',
                'receipts',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'student_fee_id',
                'student_fees',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'fee_id',
                'fees',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'fee_category_id',
                'fee_categories',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('student_fees')
            ->addForeignKey(
                'fee_id',
                'fees',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'student_id',
                'students',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('students')
            ->addForeignKey(
                'class_id',
                'classes',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();
    }

    public function down()
    {
        $this->table('expenditures')
            ->dropForeignKey(
                'expenditure_category_id'
            );

        $this->table('fees')
            ->dropForeignKey(
                'class_id'
            )
            ->dropForeignKey(
                'fee_category_id'
            )
            ->dropForeignKey(
                'session_id'
            )
            ->dropForeignKey(
                'term_id'
            );

        $this->table('payments')
            ->dropForeignKey(
                'payment_type_id'
            )
            ->dropForeignKey(
                'receipt_id'
            );

        $this->table('receipts')
            ->dropForeignKey(
                'student_id'
            );


        $this->table('student_fee_payments')
            ->dropForeignKey(
                'receipt_id'
            )
            ->dropForeignKey(
                'fee_id'
            )
            ->dropForeignKey(
                'fee_category_id'
            )
            ->dropForeignKey(
                'student_fee_id'
            );

        $this->table('student_fees')
            ->dropForeignKey(
                'fee_id'
            )
            ->dropForeignKey(
                'student_id'
            );

        $this->table('students')
            ->dropForeignKey(
                'class_id'
            );

        $tables =[
            'expenditure_categories',
            'expenditures',
            'fee_categories',
            'fees',
            'incomes',
            'payment_types',
            'payments',
            'receipts',
            'student_fee_payments',
            'student_fees',
        ];
        foreach ( $tables as $table ) {
            if ($this->table($table)->exists()) {
                $this->dropTable($table);
            }
        }
    }
}
