<?php
use Migrations\AbstractSeed;

/**
 * Terms seed.
 */
class TermsSeed extends AbstractSeed
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
                'name' => 'First Term',
                'created' => '2016-09-01 22:14:40',
                'modified' => '2016-09-01 22:14:40',
            ],
            [
                'id' => '2',
                'name' => 'Second Term',
                'created' => '2016-09-01 22:14:40',
                'modified' => '2016-09-01 22:14:40',
            ],
            [
                'id' => '3',
                'name' => 'Third Term',
                'created' => '2016-09-01 22:14:40',
                'modified' => '2016-09-01 22:14:40',
            ],
            [
                'id' => '4',
                'name' => 'Annual',
                'created' => '2016-09-01 22:14:40',
                'modified' => '2016-09-01 22:14:40',
            ],
        ];

        $table = $this->table('terms');
        $table->insert($data)->save();
    }
}
