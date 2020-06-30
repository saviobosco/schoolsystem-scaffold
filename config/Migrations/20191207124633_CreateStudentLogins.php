<?php
use Migrations\AbstractMigration;

class CreateStudentLogins extends AbstractMigration
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
        $table = $this->table('student_logins');
        $table->addColumn('username', 'string')
            ->addColumn('password', 'string')
            ->addColumn('student_id', 'integer')
            ->addColumn('last_seen', 'datetime', [
                'default' => null,
                'null' => true
            ])
            ->addColumn('status', 'boolean', [
                'default' => 1,
                'limit' => 2
                ])
            ->addTimestamps()
            ->addIndex(['student_id']);


        $table->create();
    }
}
