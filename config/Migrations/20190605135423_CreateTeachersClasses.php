<?php
use Migrations\AbstractMigration;

class CreateTeachersClasses extends AbstractMigration
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
        $table = $this->table('teachers_classes');
        $table->addColumn('teacher_id', 'string',[
            'limit' => 36,
            'null' => false
        ])
            ->addColumn('class_id', 'integer', [
                'limit' => 11,
                'null' => false
            ])
        ->create();

        $this->table('teachers_classes')
            ->addForeignKey(
                'teacher_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )->addForeignKey(
                'class_id',
                'classes',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )->update();
    }

    public function down()
    {
        $this->table('teachers_classes')
            ->dropForeignKey(
                'teacher_id'
            )->dropForeignKey('class_id');

        $this->table('teachers_classes')->drop();
    }
}
