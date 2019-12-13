<?php
use Migrations\AbstractMigration;

class CreateNewsUpdates extends AbstractMigration
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
        $table = $this->table('news_updates');
        $table->addColumn('title', 'string', [
            'null' => false
        ]);
        $table->addColumn('post', 'text');
        $table->addColumn('default_post', 'boolean', [
            'default' => 0
        ]);
        $table->addColumn('status', 'integer', [
            'default' => 1,
            'limit' => 3,
        ]);
        $table->addTimestamps();
        $table->create();
    }
}
