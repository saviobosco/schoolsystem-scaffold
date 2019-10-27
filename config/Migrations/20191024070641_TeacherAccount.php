<?php
use Migrations\AbstractMigration;

class TeacherAccount extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up()
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

        /**
         * teachers_classes table
         */
        $table = $this->table('teachers_classes')
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
            );
        $table->addColumn('teacher_id', 'string',[
            'limit' => 36,
            'null' => false
        ])
            ->addColumn('class_id', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addIndex(['teacher_id', 'class_id'])
            ->create();

        /** teachers_subjects_classes_permissions $table */
        $table = $this->table('teachers_subjects_classes_permissions')
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
            )->addForeignKey(
                'teacher_class_id',
                'teachers_classes',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            );
        $table->addColumn('teacher_id', 'string',[
            'limit' => 36,
            'null' => false
        ])
            ->addColumn('class_id', 'integer', [
                'limit' => 11,
                'null' => false
            ])
            ->addColumn('subjects', 'text', [
                'null' => false
            ])
            ->addColumn('terms', 'text',[
                'null' => false
            ])
            ->addColumn('sessions', 'text',[
                'null' => false
            ])
            ->addColumn('teacher_class_id','integer',[
                'null' => true,
            ])
            ->addIndex(['teacher_id', 'class_id'])
            ->create();
    }

    public function down()
    {
        $this->table('teachers_subjects')
            ->dropForeignKey(
                'teacher_id'
            )->dropForeignKey('subject_id');

        $this->table('teachers_subjects')->drop();


        $this->table('teachers_classes')
            ->dropForeignKey(
                'teacher_id'
            )->dropForeignKey('class_id');

        $this->table('teachers_classes')->drop();


        $this->table('teachers_subjects_classes_permissions')
            ->dropForeignKey(
                'teacher_id'
            )
            ->dropForeignKey('class_id')
            ->dropForeignKey('teacher_class_id');

        $this->table('teachers_classes')->drop();
    }
}
