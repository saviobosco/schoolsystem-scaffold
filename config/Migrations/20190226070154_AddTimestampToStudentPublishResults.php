<?php
use Migrations\AbstractMigration;

class AddTimestampToStudentPublishResults extends AbstractMigration
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
        $table = $this->table('student_publish_results');
        $table
        ->addColumn('created', 'datetime', [
        'default' => null,
        'limit' => null,
        'null' => true,
    ])
        ->addColumn('modified', 'datetime', [
            'default' => null,
            'limit' => null,
            'null' => true,
        ]);
        $table->update();
    }

    public function down()
    {
        $table = $this->table('student_publish_results');

        if ($table->hasColumn('created')) {
            $table->removeColumn('created');
        }
        if ($table->hasColumn('modified')) {
            $table->removeColumn('modified');
        }
        $table->update();
    }
}
