<?php
use Migrations\AbstractMigration;

class AddReceiptIdToIncomes extends AbstractMigration
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
        $table = $this->table('incomes');
        if ( ! $table->hasColumn('receipt_id')) {
            $table->addColumn('receipt_id','integer',[
                'default' => null,
                'limit' => 10,
                'null' => true,
            ]);
        }
        $table->update();
    }

    public function down()
    {
        $table = $this->table('incomes');
        if ($table->hasColumn('receipt_id')) {
            $table->removeColumn('receipt_id');
        }
    }
}
