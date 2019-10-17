<?php
use Migrations\AbstractMigration;

class ResultSystem extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {

        $this->table('result_grade_inputs')
            ->addColumn('main_value', 'string', [
                'default' => null,
                'limit' => 30,
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
                'default' => 0,
                'limit' => 3,
                'null' => true,
            ])
            ->addColumn('visibility', 'integer', [
                'default' => 0,
                'limit' => 3,
                'null' => true,
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
                'default' => 0,
                'limit' => 11,
                'null' => true,
            ])
            ->addColumn('visibility', 'integer', [
                'default' => 0,
                'limit' => 2,
                'null' => true,
            ])
            ->addColumn('session_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addIndex(['session_id'])
            ->addForeignKey(
                'session_id',
                'sessions',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->create();



        /** Student Annual Results */

        $this->table('student_annual_results')
            ->addColumn('student_id', 'string', [
                'default' => null,
                'limit' => 30,
                'null' => false,
            ])
            ->addColumn('subject_id', 'integer', [
                'default' => null,
                'limit' => 11,
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
            ->addIndex(['student_id', 'subject_id', 'session_id', 'class_id'])
            ->addForeignKey(
                'student_id',
                'students',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey(
                'subject_id',
                'subjects',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey(
                'class_id',
                'classes',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey(
                'session_id',
                'sessions',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->create();



        /** Student Class Counts */

        $this->table('student_class_counts')
            ->addColumn('student_count', 'integer', [
                'default' => null,
                'limit' => 11,
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
            ->addIndex(['session_id', 'class_id', 'term_id'])
            ->addForeignKey(
                'session_id',
                'sessions',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey(
                'class_id',
                'classes',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey(
                'term_id',
                'terms',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->create();



        /** Student General Remarks */

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
            ->addIndex(['student_id', 'session_id', 'class_id', 'term_id'])
            ->addForeignKey(
                'student_id',
                'students',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey(
                'session_id',
                'sessions',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey(
                'class_id',
                'classes',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey(
                'term_id',
                'terms',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->create();




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
            ->addIndex(['student_id', 'session_id', 'class_id', 'term_id'])
            ->addForeignKey(
                'student_id',
                'students',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey(
                'session_id',
                'sessions',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey(
                'class_id',
                'classes',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey(
                'term_id',
                'terms',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->create();



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
            ->addColumn('class_id', 'integer', [
                'default' => null,
                'limit' => 11,
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
            ->addIndex(['student_id', 'session_id', 'class_id', 'term_id', 'pin'])
            ->create();


        $this->table('student_positions')
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
            ->addColumn('promoted', 'boolean', [
                'default' => null,
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
            ->addIndex(['student_id', 'session_id', 'class_id', 'term_id'])
            ->create();


        /** Student Termly Results  */

        $this->table('student_termly_results')
            ->addColumn('student_id', 'string', [
                'default' => null,
                'limit' => 30,
                'null' => false,
            ])
            ->addColumn('subject_id', 'integer', [
                'default' => null,
                'limit' => 11,
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
            ->addColumn('sixth_test', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('seventh_test', 'float', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('eight_test', 'float', [
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
            ->addIndex(
                [
                    'student_id','subject_id', 'session_id', 'class_id', 'term_id'
                ]
            )
            ->addForeignKey(
                'student_id',
                'students',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey(
                'subject_id',
                'subjects',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey(
                'session_id',
                'sessions',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey(
                'class_id',
                'classes',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey(
                'term_id',
                'terms',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->create();


        /** Students Subject Position */
        $this->table('student_subject_positions')
            ->addColumn('subject_id', 'integer', [
                'default' => null,
                'limit' => 11,
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
            ->addIndex(
                ['student_id','subject_id', 'session_id', 'class_id', 'term_id']
            )
            ->addForeignKey(
                'student_id',
                'students',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey(
                'subject_id',
                'subjects',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey(
                'session_id',
                'sessions',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey(
                'class_id',
                'classes',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey(
                'term_id',
                'terms',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->create();



        /** subject class average table **/

        $this->table('subject_class_averages')
            ->addColumn('subject_id', 'integer', [
                'default' => null,
                'limit' => 11,
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
            ->addIndex([
                'class_id', 'term_id', 'session_id'
            ])
            ->addForeignKey(
                'class_id',
                'classes',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey(
                'session_id',
                'sessions',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey(
                'term_id',
                'terms',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->create();
    }
}
