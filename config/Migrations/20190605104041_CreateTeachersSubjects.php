<?php
use Migrations\AbstractMigration;

class CreateTeachersSubjects extends AbstractMigration
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
        $table = $this->table('teachers_subjects')
            ->addForeignKey(
                'teacher_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )->addForeignKey(
                'subject_id',
                'subjects',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            );
        $table->addColumn('teacher_id', 'uuid',[
            'limit' => null,
            'default' => null,
            'null' => false
        ])
        ->addColumn('subject_id', 'integer', [
            'limit' => 11,
            'null' => false
        ])
            ->addIndex(['teacher_id', 'subject_id'])
        ->create();
    }

    public function down()
    {
        $this->table('teachers_subjects')
            ->dropForeignKey(
                'teacher_id'
            )->dropForeignKey('subject_id');

        $this->table('teachers_subjects')->drop();
    }
}
