<?php
use Migrations\AbstractMigration;

class CreateResultBannerImage extends AbstractMigration
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
        $table = $this->table('result_banner_images');

        $table->addColumn('banner_image', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);

        $table->addColumn('photo_dir', 'string', [
            'default' => null,
            'limit' =>100,
            'null' => false,
        ]);

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);

        $table->create();
    }

    public function down ()
    {
        $this->table('result_banner_images')->drop();
    }
}
