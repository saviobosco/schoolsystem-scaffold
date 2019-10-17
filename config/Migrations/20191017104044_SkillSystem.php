<?php
use Migrations\AbstractMigration;

class SkillSystem extends AbstractMigration
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
        $this->table('affective_dispositions')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->create();

        $this->table('psychomotor_skills')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->create();

        $this->table('students_psychomotor_skill_scores')
            ->addColumn('student_id', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('psychomotor_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('score', 'integer', [
                'default' => null,
                'limit' => 2,
                'null' => false,
            ])
            ->addColumn('class_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('term_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('session_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                ['student_id', 'session_id', 'class_id', 'term_id']
            )
            ->create();

        $this->table('students_affective_disposition_scores')
            ->addColumn('student_id', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('affective_id', 'integer', [
                'default' => null,
                'limit' => 3,
                'null' => false,
            ])
            ->addColumn('score', 'integer', [
                'default' => null,
                'limit' => 3,
                'null' => false,
            ])
            ->addColumn('class_id', 'integer', [
                'default' => null,
                'limit' => 3,
                'null' => false,
            ])
            ->addColumn('term_id', 'integer', [
                'default' => null,
                'limit' => 3,
                'null' => false,
            ])
            ->addColumn('session_id', 'integer', [
                'default' => null,
                'limit' => 3,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                ['student_id', 'session_id', 'class_id', 'term_id']
            )
            ->create();
    }
}
