<?php
use Migrations\AbstractMigration;

class CreateTermTimeTables extends AbstractMigration
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
        $table = $this->table('term_time_tables');
        $table->addColumn('start_date', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('end_date', 'date', [
            'default' => null,
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

        $table->addColumn('result_session_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
            'comment' => 'Session id result that that date will be attached to'
        ]);

        $table->addColumn('result_term_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
            'comment' => 'term id result that that date will be attached to'
        ]);

        $table->create();
    }

    public function down()
    {
        $this->table('term_time_tables')->drop();
    }
}
