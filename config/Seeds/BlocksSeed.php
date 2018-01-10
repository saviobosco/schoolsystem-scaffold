<?php
use Migrations\AbstractSeed;

/**
 * Blocks seed.
 */
class BlocksSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'name' => 'Junior',
                'created' => '2016-09-02 11:55:19',
                'modified' => '2016-09-02 11:55:19',
            ],
            [
                'id' => '2',
                'name' => 'Senior',
                'created' => '2016-09-02 11:55:19',
                'modified' => '2016-09-02 11:55:19',
            ],
        ];

        $table = $this->table('blocks');
        $table->insert($data)->save();
    }
}
