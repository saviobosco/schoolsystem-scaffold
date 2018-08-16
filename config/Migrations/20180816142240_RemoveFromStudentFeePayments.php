<?php
use Migrations\AbstractMigration;

class RemoveFromStudentFeePayments extends AbstractMigration
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
        $table = $this->table('student_fee_payments');
        if ($table->hasColumn('created_by')) {
            $table->removeColumn('created_by');
        }
        if ($table->hasColumn('modified_by')) {
            $table->removeColumn('modified_by');
        }
    }

    public function down()
    {
        $table = $this->table('student_fee_payments');
        if (! $table->hasColumn('created_by')) {
            $table->addColumn('created_by', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => null,
            ]);
        }
        if (! $table->hasColumn('modified_by')) {
            $table->addColumn('modified_by', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => null,
            ]);
        }
        $table->update();
    }
}
