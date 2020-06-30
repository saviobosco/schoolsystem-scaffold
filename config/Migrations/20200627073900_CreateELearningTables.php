<?php
use Migrations\AbstractMigration;

class CreateELearningTables extends AbstractMigration
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
        $table = $this->table('e_learning_lectures');

        $table->addColumn('topic', 'string', [
           'limit' => 500,
           'null' => false
        ]);

        $table->addColumn('introduction', 'text');
        $table->addColumn('content', 'text');
        $table->addColumn('summary', 'text', [
            'default' => null,
            'null' => true
        ]);
        $table->addColumn('exercise', 'text', [
            'default' => null,
            'null' => true
        ]);

        $table->addColumn('published', 'boolean', [
            'default' => 1,
        ]);

        $table->addColumn('sort_order', 'integer', [
           'default' => 0,
            'limit' => 11,
        ]);

        $table->addColumn('subject_id', 'integer', [
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);

        $table->addColumn('session_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false
        ]);
        $table->addColumn('class_id', 'integer', [
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);

        $table->addColumn('term_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false
        ]);

        $table->addColumn('created_by', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false
        ]);
        $table->addTimestamps();
        $table->create();


        // create the e-learning assignments
        $table = $this->table('e_learning_assignments');
        $table->addColumn('assignment', 'text');
        $table->addColumn('lecture_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true
        ]);

        $table->addColumn('subject_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true
        ]);
        $table->addColumn('session_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true
        ]);
        $table->addColumn('class_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true
        ]);
        $table->addColumn('term_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true
        ]);
        $table->addTimestamps();
        $table->create();
    }


    public function down()
    {
        $this->dropTable('e_learning_lectures');
        $this->dropTable('e_learning_assignments');
    }
}
