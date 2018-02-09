<?php

use Phinx\Seed\AbstractSeed;

class Classes extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'class'    => 'JSS 1',
                'block_id' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                'no_of_subjects' => null
            ],
            [
                'class'    => 'JSS 2',
                'block_id' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                'no_of_subjects' => null
            ],
            [
                'class'    => 'JSS 3',
                'block_id' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                'no_of_subjects' => null
            ],
            [
                'class'    => 'SSS 1',
                'block_id' => 2,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                'no_of_subjects' => null
            ],
            [
                'class'    => 'SSS 2',
                'block_id' => 2,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                'no_of_subjects' => null
            ],
            [
                'class'    => 'SSS 3',
                'block_id' => 2,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                'no_of_subjects' => null
            ],
        ];

        $posts = $this->table('classes');
        $posts->insert($data)
            ->save();
    }
}
