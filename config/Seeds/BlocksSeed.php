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
                'name' => 'Junior',
            ],
            [
                'name' => 'Senior',
            ],
        ];

        $table = $this->table('blocks');
        $table->insert($data)->save();
    }
}
