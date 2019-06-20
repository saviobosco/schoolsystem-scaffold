<?php
use Migrations\AbstractMigration;

class CreateLogins extends AbstractMigration
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
        $table = $this->table('logins');
        $table->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )->addColumn('user_id', 'string',[
            'limit' => 36,
            'default' => null,
            'null' => false,
            ])
            ->addColumn('ip_address', 'string',[
            'default' => null,
            'null' => false
            ])
            ->addColumn('created', 'datetime')
            ->create();
    }

    public function down()
    {
        $this->table('logins')
            ->dropForeignKey('user_id')
            ->drop();
    }
}
