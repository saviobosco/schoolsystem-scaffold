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
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
