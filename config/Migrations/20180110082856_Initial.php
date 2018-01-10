<?php
use Migrations\AbstractMigration;

class Initial extends AbstractMigration
{
    public function up()
    {

        if ( $this->table('affective_dispositions')->exists() === false ) {
            $this->table('affective_dispositions')
                ->addColumn('name', 'string', [
                    'default' => null,
                    'limit' => 50,
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

        if ( $this->table('blocks')->exists() === false ) {
            $this->table('blocks')
                ->addColumn('name', 'string', [
                    'default' => null,
                    'limit' => 20,
                    'null' => false,
                ])
                ->addColumn('created', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('modified', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => false,
                ])
                ->create();
        }

        if ( $this->table('class_demarcations')->exists() === false ) {
            $this->table('class_demarcations')
                ->addColumn('name', 'string', [
                    'default' => null,
                    'limit' => 10,
                    'null' => false,
                ])
                ->addColumn('class_id', 'integer', [
                    'default' => null,
                    'limit' => 10,
                    'null' => false,
                ])
                ->addColumn('capacity', 'integer', [
                    'default' => null,
                    'limit' => 5,
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

        if ( $this->table('classes')->exists() === false) {
            $this->table('classes')
                ->addColumn('class', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => false,
                ])
                ->addColumn('block_id', 'integer', [
                    'default' => null,
                    'limit' => 4,
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
                ->addColumn('no_of_subjects', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => false,
                ])
                ->addIndex(
                    [
                        'block_id',
                    ]
                )
                ->addIndex(
                    [
                        'block_id',
                    ]
                )
                ->addIndex(
                    [
                        'block_id',
                    ]
                )
                ->create();
        }

        if ( $this->table('expenditure_categories') === false ) {
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
                ->addIndex(
                    [
                        'expenditure_category_id',
                    ]
                )
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
                    'null' => false,
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
                ->addIndex(
                    [
                        'class_id',
                    ]
                )
                ->addIndex(
                    [
                        'class_id',
                    ]
                )
                ->addIndex(
                    [
                        'class_id',
                    ]
                )
                ->addIndex(
                    [
                        'fee_category_id',
                    ]
                )
                ->addIndex(
                    [
                        'fee_category_id',
                    ]
                )
                ->addIndex(
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
                        'session_id',
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
                )
                ->addIndex(
                    [
                        'term_id',
                    ]
                )
                ->addIndex(
                    [
                        'term_id',
                    ]
                )
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
                ->addIndex(
                    [
                        'payment_type_id',
                    ]
                )
                ->addIndex(
                    [
                        'receipt_id',
                    ]
                )
                ->addIndex(
                    [
                        'payment_made_by',
                    ]
                )
                ->create();
        }

        if ( $this->table('psychomotor_skills')->exists() === false) {
            $this->table('psychomotor_skills')
                ->addColumn('name', 'string', [
                    'default' => null,
                    'limit' => 50,
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
                ->addIndex(
                    [
                        'student_id',
                    ]
                )
                ->create();
        }

        if ( $this->table('religions')->exists() === false ) {
            $this->table('religions')
                ->addColumn('name', 'string', [
                    'default' => null,
                    'limit' => 20,
                    'null' => false,
                ])
                ->create();
        }

        if ( $this->table('result_grade_inputs')->exists() === false ) {
            $this->table('result_grade_inputs')
                ->addColumn('main_value', 'string', [
                    'default' => null,
                    'limit' => 20,
                    'null' => false,
                ])
                ->addColumn('replacement', 'string', [
                    'default' => null,
                    'limit' => 50,
                    'null' => true,
                ])
                ->addColumn('percentage', 'string', [
                    'default' => null,
                    'limit' => 10,
                    'null' => true,
                ])
                ->addColumn('output_order', 'integer', [
                    'default' => '0',
                    'limit' => 3,
                    'null' => true,
                ])
                ->addColumn('visibility', 'integer', [
                    'default' => '0',
                    'limit' => 3,
                    'null' => true,
                ])
                ->create();
        }

        if ( $this->table('result_grading_systems')->exists() === false ) {
            $this->table('result_grading_systems')
                ->addColumn('grade', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => false,
                ])
                ->addColumn('score', 'string', [
                    'default' => null,
                    'limit' => 15,
                    'null' => true,
                ])
                ->addColumn('remark', 'string', [
                    'default' => null,
                    'limit' => 50,
                    'null' => false,
                ])
                ->addColumn('cal_order', 'integer', [
                    'comment' => 'This specifies the order in which the are to to called',
                    'default' => null,
                    'limit' => 4,
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

        if  ( $this->table('result_remark_inputs')->exists() === false) {
            $this->table('result_remark_inputs')
                ->addColumn('main_value', 'string', [
                    'default' => null,
                    'limit' => 20,
                    'null' => false,
                ])
                ->addColumn('replacement', 'string', [
                    'default' => null,
                    'limit' => 50,
                    'null' => true,
                ])
                ->addColumn('output_order', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => true,
                ])
                ->addColumn('visibility', 'integer', [
                    'default' => '0',
                    'limit' => 2,
                    'null' => true,
                ])
                ->create();

        }

        if ( $this->table('sessions')->exists() === false ) {
            $this->table('sessions')
                ->addColumn('session', 'string', [
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

        if ( $this->table('settings_configurations')->exists() === false) {
            $this->table('settings_configurations')
                ->addColumn('name', 'string', [
                    'default' => '',
                    'limit' => 100,
                    'null' => false,
                ])
                ->addColumn('value', 'text', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('description', 'text', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('type', 'string', [
                    'default' => '',
                    'limit' => 50,
                    'null' => false,
                ])
                ->addColumn('editable', 'boolean', [
                    'default' => true,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('weight', 'integer', [
                    'default' => '0',
                    'limit' => 11,
                    'null' => false,
                ])
                ->addColumn('autoload', 'boolean', [
                    'default' => true,
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
                ->create();
        }

        if ( $this->table('social_accounts')->exists() === false ) {
            $this->table('social_accounts', ['id' => false, 'primary_key' => ['id']])
                ->addColumn('id', 'uuid', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('user_id', 'uuid', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('provider', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => false,
                ])
                ->addColumn('username', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => true,
                ])
                ->addColumn('reference', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => false,
                ])
                ->addColumn('avatar', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => true,
                ])
                ->addColumn('description', 'text', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('link', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => false,
                ])
                ->addColumn('token', 'string', [
                    'default' => null,
                    'limit' => 500,
                    'null' => false,
                ])
                ->addColumn('token_secret', 'string', [
                    'default' => null,
                    'limit' => 500,
                    'null' => true,
                ])
                ->addColumn('token_expires', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('active', 'boolean', [
                    'default' => true,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('data', 'text', [
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
                ->addIndex(
                    [
                        'user_id',
                    ]
                )
                ->addIndex(
                    [
                        'user_id',
                    ]
                )
                ->create();
        }

        if ( $this->table('states')->exists() === false) {
            $this->table('states')
                ->addColumn('state', 'string', [
                    'default' => null,
                    'limit' => 100,
                    'null' => false,
                ])
                ->create();
        }

        if ( $this->table('student_annual_position_on_class_demarcations')->exists() === false) {
            $this->table('student_annual_position_on_class_demarcations')
                ->addColumn('student_id', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => false,
                ])
                ->addColumn('total', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('average', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('grade', 'string', [
                    'default' => null,
                    'limit' => 20,
                    'null' => true,
                ])
                ->addColumn('position', 'integer', [
                    'default' => null,
                    'limit' => 10,
                    'null' => true,
                ])
                ->addColumn('class_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('class_demarcation_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('session_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->create();
        }

        if ( $this->table('student_annual_positions')->exists() === false) {
            $this->table('student_annual_positions')
                ->addColumn('student_id', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => false,
                ])
                ->addColumn('total', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('average', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('grade', 'string', [
                    'default' => null,
                    'limit' => 20,
                    'null' => true,
                ])
                ->addColumn('position', 'integer', [
                    'default' => null,
                    'limit' => 10,
                    'null' => true,
                ])
                ->addColumn('promoted', 'tinyinteger', [
                    'default' => null,
                    'limit' => 2,
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
                ->create();
        }

        if ( $this->table('student_annual_results')->exists() === false) {
            $this->table('student_annual_results')
                ->addColumn('student_id', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => false,
                ])
                ->addColumn('subject_id', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => false,
                ])
                ->addColumn('first_term', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('second_term', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('third_term', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('total', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('average', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('remark', 'string', [
                    'default' => null,
                    'limit' => 20,
                    'null' => true,
                ])
                ->addColumn('class_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('session_id', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => true,
                ])
                ->addColumn('grade', 'string', [
                    'default' => null,
                    'limit' => 10,
                    'null' => true,
                ])
                ->create();
        }

        if ( $this->table('student_annual_subject_position_on_class_demarcations')->exists() === false) {
            $this->table('student_annual_subject_position_on_class_demarcations')
                ->addColumn('subject_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('student_id', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => false,
                ])
                ->addColumn('total', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('position', 'integer', [
                    'default' => null,
                    'limit' => 10,
                    'null' => true,
                ])
                ->addColumn('class_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('class_demarcation_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('session_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->create();
        }

        if ( $this->table('student_annual_subject_positions')->exists() === false ) {
            $this->table('student_annual_subject_positions')
                ->addColumn('subject_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('student_id', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => false,
                ])
                ->addColumn('total', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('position', 'integer', [
                    'default' => null,
                    'limit' => 10,
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
                ->create();
        }

        if ( $this->table('student_class_counts')->exists() === false) {
            $this->table('student_class_counts')
                ->addColumn('student_count', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => false,
                ])
                ->addColumn('class_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('term_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('session_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
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
                    'null' => false,
                ])
                ->addColumn('fee_category_id', 'integer', [
                    'comment' => 'Fee Category id is need to know fee category income',
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
                ->addIndex(
                    [
                        'receipt_id',
                    ]
                )
                ->addIndex(
                    [
                        'student_fee_id',
                    ]
                )
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
                    'null' => false,
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
                ->addIndex(
                    [
                        'fee_id',
                    ]
                )
                ->addIndex(
                    [
                        'student_id',
                    ]
                )
                ->create();
        }

        if ( $this->table('student_general_remarks')->exists() === false) {
            $this->table('student_general_remarks')
                ->addColumn('student_id', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => false,
                ])
                ->addColumn('remark_1', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => true,
                ])
                ->addColumn('remark_2', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => true,
                ])
                ->addColumn('remark_3', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => true,
                ])
                ->addColumn('remark_4', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => true,
                ])
                ->addColumn('remark_5', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => true,
                ])
                ->addColumn('remark_6', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => true,
                ])
                ->addColumn('class_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('term_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('session_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->create();
        }

        if ( $this->table('student_publish_results')->exists() === false ) {
            $this->table('student_publish_results')
                ->addColumn('student_id', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => false,
                ])
                ->addColumn('status', 'integer', [
                    'default' => '0',
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('class_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('term_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('session_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->create();
        }

        if ( $this->table('student_result_pins')->exists() === false) {
            $this->table('student_result_pins', ['id' => false, 'primary_key' => ['serial_number']])
                ->addColumn('serial_number', 'integer', [
                    'autoIncrement' => true,
                    'default' => null,
                    'limit' => 11,
                    'null' => false,
                ])
                ->addColumn('pin', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => false,
                ])
                ->addColumn('student_id', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => true,
                ])
                ->addColumn('term_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => true,
                ])
                ->addColumn('session_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => true,
                ])
                ->addColumn('created', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('modified', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('class_id', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => true,
                ])
                ->create();
        }

        if ( $this->table('student_termly_position_on_class_demarcations')->exists() === false) {
            $this->table('student_termly_position_on_class_demarcations')
                ->addColumn('student_id', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => false,
                ])
                ->addColumn('total', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('average', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('grade', 'string', [
                    'default' => null,
                    'limit' => 20,
                    'null' => true,
                ])
                ->addColumn('position', 'integer', [
                    'default' => null,
                    'limit' => 10,
                    'null' => true,
                ])
                ->addColumn('class_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('class_demarcation_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('term_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('session_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->create();
        }

        if ( $this->table('student_termly_positions')->exists() === false) {
            $this->table('student_termly_positions')
                ->addColumn('student_id', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => false,
                ])
                ->addColumn('total', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('average', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('grade', 'string', [
                    'default' => null,
                    'limit' => 20,
                    'null' => true,
                ])
                ->addColumn('position', 'integer', [
                    'default' => null,
                    'limit' => 10,
                    'null' => true,
                ])
                ->addColumn('class_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('term_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('session_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->create();
        }

        if ( $this->table('student_termly_results')->exists() === false ) {
            $this->table('student_termly_results')
                ->addColumn('student_id', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => false,
                ])
                ->addColumn('subject_id', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => false,
                ])
                ->addColumn('first_test', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('second_test', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('third_test', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('fourth_test', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('fifth_test', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('exam', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('total', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('grade', 'string', [
                    'default' => null,
                    'limit' => 10,
                    'null' => true,
                ])
                ->addColumn('remark', 'string', [
                    'default' => null,
                    'limit' => 20,
                    'null' => true,
                ])
                ->addColumn('principal_comment', 'string', [
                    'default' => null,
                    'limit' => 100,
                    'null' => true,
                ])
                ->addColumn('head_teacher_comment', 'string', [
                    'default' => null,
                    'limit' => 100,
                    'null' => true,
                ])
                ->addColumn('class_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('term_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('session_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->create();
        }

        if ( $this->table('student_termly_subject_position_on_class_demarcations')->exists() === false) {
            $this->table('student_termly_subject_position_on_class_demarcations')
                ->addColumn('subject_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('student_id', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => false,
                ])
                ->addColumn('total', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('position', 'integer', [
                    'default' => null,
                    'limit' => 10,
                    'null' => true,
                ])
                ->addColumn('class_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('class_demarcation_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('term_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('session_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->create();
        }

        if ( $this->table('student_termly_subject_positions')->exists() === false) {
            $this->table('student_termly_subject_positions')
                ->addColumn('subject_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('student_id', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => false,
                ])
                ->addColumn('total', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('position', 'integer', [
                    'default' => null,
                    'limit' => 10,
                    'null' => true,
                ])
                ->addColumn('class_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('term_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('session_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->create();
        }

        if ( $this->table('students')->exists() === false ) {
            $this->table('students', ['id' => false, 'primary_key' => ['id']])
                ->addColumn('id', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => false,
                ])
                ->addColumn('first_name', 'string', [
                    'default' => null,
                    'limit' => 50,
                    'null' => false,
                ])
                ->addColumn('last_name', 'string', [
                    'default' => null,
                    'limit' => 50,
                    'null' => false,
                ])
                ->addColumn('date_of_birth', 'date', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('gender', 'string', [
                    'default' => '',
                    'limit' => 255,
                    'null' => true,
                ])
                ->addColumn('state_of_origin', 'string', [
                    'default' => null,
                    'limit' => 50,
                    'null' => true,
                ])
                ->addColumn('religion_id', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => true,
                ])
                ->addColumn('home_residence', 'string', [
                    'default' => null,
                    'limit' => 70,
                    'null' => true,
                ])
                ->addColumn('guardian', 'string', [
                    'default' => null,
                    'limit' => 50,
                    'null' => true,
                ])
                ->addColumn('relationship_to_guardian', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => true,
                ])
                ->addColumn('occupation_of_guardian', 'string', [
                    'default' => null,
                    'limit' => 50,
                    'null' => true,
                ])
                ->addColumn('guardian_phone_number', 'string', [
                    'default' => null,
                    'limit' => 15,
                    'null' => true,
                ])
                ->addColumn('class_id', 'integer', [
                    'default' => null,
                    'limit' => 2,
                    'null' => false,
                ])
                ->addColumn('class_demarcation_id', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => true,
                ])
                ->addColumn('photo', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => true,
                ])
                ->addColumn('photo_dir', 'string', [
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
                ->addColumn('status', 'integer', [
                    'default' => '1',
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('state_id', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => true,
                ])
                ->addIndex(
                    [
                        'class_id',
                    ]
                )
                ->create();
        }

        if ( $this->table('students_affective_disposition_scores')->exists() === false) {
            $this->table('students_affective_disposition_scores')
                ->addColumn('student_id', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => false,
                ])
                ->addColumn('affective_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('score', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('class_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('term_id', 'integer', [
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
                ->create();
        }

        if ( $this->table('students_psychomotor_skill_scores')->exists() === false) {
            $this->table('students_psychomotor_skill_scores')
                ->addColumn('student_id', 'string', [
                    'default' => null,
                    'limit' => 30,
                    'null' => false,
                ])
                ->addColumn('psychomotor_id', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => false,
                ])
                ->addColumn('score', 'integer', [
                    'default' => null,
                    'limit' => 2,
                    'null' => false,
                ])
                ->addColumn('class_id', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => false,
                ])
                ->addColumn('term_id', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => false,
                ])
                ->addColumn('session_id', 'integer', [
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

        if ( $this->table('subject_class_averages')->exists() === false) {
            $this->table('subject_class_averages')
                ->addColumn('subject_id', 'integer', [
                    'default' => null,
                    'limit' => 5,
                    'null' => false,
                ])
                ->addColumn('student_count', 'integer', [
                    'default' => null,
                    'limit' => 11,
                    'null' => false,
                ])
                ->addColumn('class_average', 'float', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('class_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('term_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->addColumn('session_id', 'integer', [
                    'default' => null,
                    'limit' => 3,
                    'null' => false,
                ])
                ->create();
        }

        if ( $this->table('subjects')->exists() === false) {
            $this->table('subjects')
                ->addColumn('name', 'string', [
                    'default' => null,
                    'limit' => 100,
                    'null' => false,
                ])
                ->addColumn('block_id', 'integer', [
                    'default' => null,
                    'limit' => 4,
                    'null' => false,
                ])
                ->create();
        }

        if ( $this->table('terms')->exists() === false) {
            $this->table('terms')
                ->addColumn('name', 'string', [
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

        if ( $this->table('users')->exists() === false) {
            $this->table('users', ['id' => false, 'primary_key' => ['id']])
                ->addColumn('id', 'uuid', [
                    'default' => null,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('username', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => false,
                ])
                ->addColumn('email', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => true,
                ])
                ->addColumn('password', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => false,
                ])
                ->addColumn('first_name', 'string', [
                    'default' => null,
                    'limit' => 50,
                    'null' => true,
                ])
                ->addColumn('last_name', 'string', [
                    'default' => null,
                    'limit' => 50,
                    'null' => true,
                ])
                ->addColumn('token', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => true,
                ])
                ->addColumn('token_expires', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('api_token', 'string', [
                    'default' => null,
                    'limit' => 255,
                    'null' => true,
                ])
                ->addColumn('activation_date', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('tos_date', 'datetime', [
                    'default' => null,
                    'limit' => null,
                    'null' => true,
                ])
                ->addColumn('active', 'boolean', [
                    'default' => false,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('is_superuser', 'boolean', [
                    'default' => false,
                    'limit' => null,
                    'null' => false,
                ])
                ->addColumn('role', 'string', [
                    'default' => 'user',
                    'limit' => 255,
                    'null' => true,
                ])
                ->addColumn('record_id', 'string', [
                    'default' => null,
                    'limit' => 30,
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
                ->addIndex(
                    [
                        'record_id',
                    ]
                )
                ->create();
        }


        $this->table('classes')
            ->addForeignKey(
                'block_id',
                'blocks',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'block_id',
                'blocks',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'block_id',
                'blocks',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

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
            ->addForeignKey(
                'expenditure_category_id',
                'expenditure_categories',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
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
                'class_id',
                'classes',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
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
                'fee_category_id',
                'fee_categories',
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
                'session_id',
                'sessions',
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
            ->addForeignKey(
                'term_id',
                'terms',
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

        $this->table('social_accounts')
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
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
        $this->table('classes')
            ->dropForeignKey(
                'block_id'
            )
            ->dropForeignKey(
                'block_id'
            )
            ->dropForeignKey(
                'block_id'
            );

        $this->table('expenditures')
            ->dropForeignKey(
                'expenditure_category_id'
            )
            ->dropForeignKey(
                'expenditure_category_id'
            )
            ->dropForeignKey(
                'expenditure_category_id'
            );

        $this->table('fees')
            ->dropForeignKey(
                'class_id'
            )
            ->dropForeignKey(
                'class_id'
            )
            ->dropForeignKey(
                'class_id'
            )
            ->dropForeignKey(
                'fee_category_id'
            )
            ->dropForeignKey(
                'fee_category_id'
            )
            ->dropForeignKey(
                'fee_category_id'
            )
            ->dropForeignKey(
                'session_id'
            )
            ->dropForeignKey(
                'session_id'
            )
            ->dropForeignKey(
                'session_id'
            )
            ->dropForeignKey(
                'term_id'
            )
            ->dropForeignKey(
                'term_id'
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

        $this->table('social_accounts')
            ->dropForeignKey(
                'user_id'
            )
            ->dropForeignKey(
                'user_id'
            );

        $this->table('student_fee_payments')
            ->dropForeignKey(
                'receipt_id'
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

        $this->dropTable('affective_dispositions');
        $this->dropTable('blocks');
        $this->dropTable('class_demarcations');
        $this->dropTable('classes');
        $this->dropTable('expenditure_categories');
        $this->dropTable('expenditures');
        $this->dropTable('fee_categories');
        $this->dropTable('fees');
        $this->dropTable('incomes');
        $this->dropTable('payment_types');
        $this->dropTable('payments');
        $this->dropTable('psychomotor_skills');
        $this->dropTable('queued_tasks');
        $this->dropTable('receipts');
        $this->dropTable('religions');
        $this->dropTable('result_grade_inputs');
        $this->dropTable('result_grading_systems');
        $this->dropTable('result_remark_inputs');
        $this->dropTable('sessions');
        $this->dropTable('settings_configurations');
        $this->dropTable('social_accounts');
        $this->dropTable('states');
        $this->dropTable('student_annual_position_on_class_demarcations');
        $this->dropTable('student_annual_positions');
        $this->dropTable('student_annual_results');
        $this->dropTable('student_annual_subject_position_on_class_demarcations');
        $this->dropTable('student_annual_subject_positions');
        $this->dropTable('student_class_counts');
        $this->dropTable('student_fee_payments');
        $this->dropTable('student_fees');
        $this->dropTable('student_general_remarks');
        $this->dropTable('student_publish_results');
        $this->dropTable('student_result_pins');
        $this->dropTable('student_termly_position_on_class_demarcations');
        $this->dropTable('student_termly_positions');
        $this->dropTable('student_termly_results');
        $this->dropTable('student_termly_subject_position_on_class_demarcations');
        $this->dropTable('student_termly_subject_positions');
        $this->dropTable('students');
        $this->dropTable('students_affective_disposition_scores');
        $this->dropTable('students_psychomotor_skill_scores');
        $this->dropTable('subject_class_averages');
        $this->dropTable('subjects');
        $this->dropTable('terms');
        $this->dropTable('users');
    }
}
