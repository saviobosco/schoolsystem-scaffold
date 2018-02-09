<?php
use Migrations\AbstractMigration;

class CreateStudentAnnualResults extends AbstractMigration
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
        $table = $this->table('student_annual_results');
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
        $table->addColumn('first_term', 'float', [
            'default' => null,
            'limit' => 3,
            'null' => false,
        ]);
        $table->addColumn('second_term', 'float', [
            'default' => null,
            'limit' => 3,
            'null' => true,
        ]);
        $table->addColumn('third_term', 'float', [
            'default' => null,
            'limit' => 3,
            'null' => true,
        ]);
        $table->addColumn('total', 'float', [
            'default' => null,
            'limit' => 3,
            'null' => true,
        ]);
        $table->addColumn('average', 'float', [
            'default' => null,
            'limit' => 3,
            'null' => true,
        ]);
        $table->addColumn('remark', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => true,
        ]);
        $table->addColumn('class_id', 'integer', [
            'default' => null,
            'limit' => 3,
            'null' => false,
        ]);
        $table->addColumn('session_id', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => false,
        ]);
        $table->create();
    }

    public function down()
    {
        $this->table('student_annual_results')->drop();
    }
}
