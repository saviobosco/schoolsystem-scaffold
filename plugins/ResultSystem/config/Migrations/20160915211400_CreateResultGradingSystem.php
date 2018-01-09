<?php
use Migrations\AbstractMigration;

class CreateResultGradingSystem extends AbstractMigration
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
        $table = $this->table('result_grading_systems');

        $table->addColumn('grade', 'string', [
            'default' => null,
            'limit' => 30,
            'null' => false,
        ]);

        $table->addColumn('score', 'integer', [
            'default' => null,
            'limit' => 5,
            'null' => false,
        ]);

        $table->addColumn('remark', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => false,
        ]);

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);

        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);

        $table->create();
    }


}
