<?php
use Migrations\AbstractMigration;

class CreateStudentTermlyResults extends AbstractMigration
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
        $table = $this->table('student_termly_results');
        $table->addColumn('student_id', 'string', [
            'default' => null,
            'limit' => 30,
            'null' => false,
        ]);
        $table->addColumn('subject_id', 'string', [
            'default' => null,
            'limit' => 30,
            'null' => false,
        ]);
        $table->addColumn('first_test', 'float', [
            'default' => null,
            'limit' => 3,
            'null' => true,
        ]);
        $table->addColumn('second_test', 'float', [
            'default' => null,
            'limit' => 3,
            'null' => true,
        ]);
        $table->addColumn('third_test', 'float', [
            'default' => null,
            'limit' => 3,
            'null' => true,
        ]);
        $table->addColumn('exam', 'float', [
            'default' => null,
            'limit' => 3,
            'null' => true,
        ]);
        $table->addColumn('total', 'float', [
            'default' => null,
            'limit' => 3,
            'null' => true,
        ]);
        $table->addColumn('grade', 'string', [
            'default' => null,
            'limit' => 10,
            'null' => true,
        ]);
        $table->addColumn('remark', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => true,
        ]);
        $table->addColumn('principal_comment', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => true,
        ]);
        $table->addColumn('head_teacher_comment', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => true,
        ]);
        $table->addColumn('class_id', 'integer', [
            'default' => null,
            'limit' => 3,
            'null' => false,
        ]);
        $table->addColumn('term_id', 'integer', [
            'default' => null,
            'limit' => 3,
            'null' => false,
        ]);
        $table->addColumn('session_id', 'integer', [
            'default' => null,
            'limit' => 3,
            'null' => false,
        ]);
        $table->create();
    }

    public function down()
    {
        $this->table('student_termly_results')->drop();
    }
}
