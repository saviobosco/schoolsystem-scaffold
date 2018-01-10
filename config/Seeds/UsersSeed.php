<?php
use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
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
                'id' => '3e737a99-4f4f-45cb-b4c0-109af3dc922b',
                'username' => 'admin2',
                'email' => '',
                'password' => '$2y$10$TelebfOvk5hOZEpCiw0pdes6WB7.ccmfFdSLKGRnRJCdGRIQ9/dlq',
                'first_name' => 'Admin',
                'last_name' => '2',
                'token' => NULL,
                'token_expires' => NULL,
                'api_token' => NULL,
                'activation_date' => NULL,
                'tos_date' => NULL,
                'active' => '1',
                'is_superuser' => '0',
                'role' => 'user',
                'record_id' => NULL,
                'created' => '2018-01-08 22:06:20',
                'modified' => '2018-01-08 22:10:13',
            ],
            [
                'id' => '6ae8971c-e86b-4e8c-9d45-cc6a87010452',
                'username' => 'admin',
                'email' => 'admin@info.com',
                'password' => '$2y$10$ZXwDCoPAFWXJlzR8edyLIe/p6H9okuHcp.Ci.ELFsUvHynEjdtz3K',
                'first_name' => 'admin',
                'last_name' => 'admin',
                'token' => NULL,
                'token_expires' => NULL,
                'api_token' => NULL,
                'activation_date' => '2016-10-05 17:01:02',
                'tos_date' => '2016-10-05 17:01:02',
                'active' => '1',
                'is_superuser' => '1',
                'role' => 'superuser',
                'record_id' => NULL,
                'created' => '2016-10-05 17:01:02',
                'modified' => '2016-11-12 15:41:06',
            ],
            [
                'id' => '8a4130f0-052b-4cc6-8860-b47b76f3cd7c',
                'username' => 'admin4',
                'email' => '',
                'password' => '$2y$10$j/mNC7b6UYLHS7hzShkqXeE0R4YmIo9ExTD0/x79chH6JHL.ypi8e',
                'first_name' => 'Admin',
                'last_name' => '4',
                'token' => NULL,
                'token_expires' => NULL,
                'api_token' => NULL,
                'activation_date' => NULL,
                'tos_date' => NULL,
                'active' => '1',
                'is_superuser' => '0',
                'role' => 'admin',
                'record_id' => NULL,
                'created' => '2018-01-08 22:50:29',
                'modified' => '2018-01-08 22:50:29',
            ],
            [
                'id' => '9b3e991f-4258-477f-8157-239d3701f154',
                'username' => 'admin3',
                'email' => '',
                'password' => '$2y$10$thYh1/m/TAz5LfUXZFHgZulYnBvLgdTejcBecJTQdAxS5JspDHe1C',
                'first_name' => 'Bursar',
                'last_name' => '1',
                'token' => NULL,
                'token_expires' => NULL,
                'api_token' => NULL,
                'activation_date' => NULL,
                'tos_date' => NULL,
                'active' => '1',
                'is_superuser' => '0',
                'role' => 'bursar',
                'record_id' => NULL,
                'created' => '2018-01-08 22:13:36',
                'modified' => '2018-01-08 22:14:53',
            ],
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
