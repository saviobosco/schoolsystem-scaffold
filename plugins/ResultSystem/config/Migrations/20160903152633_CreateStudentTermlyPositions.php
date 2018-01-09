<?php
use Migrations\AbstractMigration;

class CreateStudentTermlyPositions extends AbstractMigration
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
        $table = $this->table('student_termly_positions');

        $table->addColumn('student_id', 'string', [
            'default' => null,
            'limit' => 30,
            'null' => false,
        ]);

        $table->addColumn('total', 'float', [
            'default' => null,
            'limit' => 10,
            'null' => false,
        ]);

        $table->addColumn('average', 'float', [
            'default' => null,
            'limit' => 6,
            'null' => false,
        ]);

        $table->addColumn('position', 'integer', [
            'default' => null,
            'limit' => 10,
            'null' => false,
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
        $this->table('student_termly_positions')->drop();
    }
}
