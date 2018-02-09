<?php
use Migrations\AbstractMigration;

class AddToAccountHolders extends AbstractMigration
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
        $this->table('account_holders')
            ->addColumn('student_id','string',[
                'default' => null,
                'null' => true,
                'limit' => 30,
                'after' => 'account_type_id'
            ])->update();
    }

    public function down()
    {
        $table = $this->table('account_holders');
        if ( $table->hasColumn('student_id')) {
            $table->removeColumn('student_id');
        }
    }
}
