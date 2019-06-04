<?php
use Migrations\AbstractSeed;

/**
 * SettingsConfigurations seed.
 */
class SettingsConfigurationsSeed extends AbstractSeed
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
                'name' => 'Application.school_name',
                'value' => 'School Management System',
                'description' => 'The name of the School ',
                'type' => 'text',
                'editable' => '1',
                'weight' => '1',
                'autoload' => '1',
                'created' => '2016-09-25 19:39:02',
                'modified' => '2017-01-08 21:56:54',
            ],
            [
                'id' => '2',
                'name' => 'Application.motto',
                'value' => '',
                'description' => 'School Motto',
                'type' => 'text',
                'editable' => '1',
                'weight' => '3',
                'autoload' => '1',
                'created' => '2017-01-08 17:56:08',
                'modified' => '2017-01-08 17:57:12',
            ],
            [
                'id' => '5',
                'name' => 'Application.address',
                'value' => '',
                'description' => NULL,
                'type' => '',
                'editable' => '1',
                'weight' => '2',
                'autoload' => '1',
                'created' => '2017-12-04 12:32:51',
                'modified' => '2017-12-04 12:42:20',
            ],
            [
                'id' => '6',
                'name' => 'Application.email_address',
                'value' => 'school',
                'description' => NULL,
                'type' => '',
                'editable' => '1',
                'weight' => '4',
                'autoload' => '1',
                'created' => '2017-12-04 12:34:15',
                'modified' => '2018-02-07 21:58:37',
            ],
            [
                'id' => '7',
                'name' => 'Application.proprietor',
                'value' => '',
                'description' => NULL,
                'type' => '',
                'editable' => '1',
                'weight' => '5',
                'autoload' => '1',
                'created' => '2017-12-04 12:35:44',
                'modified' => '2017-12-04 12:35:44',
            ],
            [
                'id' => '8',
                'name' => 'Application.current_session',
                'value' => '',
                'description' => 'Current Session',
                'type' => 'select',
                'editable' => '1',
                'weight' => '6',
                'autoload' => '1',
                'created' => '2019-04-11 23:30:22',
                'modified' => '2019-04-11 23:48:14',
            ],
            [
                'id' => '9',
                'name' => 'Application.current_term',
                'value' => '',
                'description' => NULL,
                'type' => 'select',
                'editable' => '1',
                'weight' => '7',
                'autoload' => '1',
                'created' => '2019-04-11 23:48:53',
                'modified' => '2019-04-11 23:51:11',
            ],
            [
                'id' => '10',
                'name' => 'Application.use_result_pin_for_all_terms',
                'value' => '0',
                'description' => NULL,
                'type' => 'checkbox',
                'editable' => '1',
                'weight' => '8',
                'autoload' => '1',
                'created' => '2019-04-14 16:15:34',
                'modified' => '2019-04-14 16:15:34',
            ],
        ];

        $table = $this->table('settings_configurations');
        $table->insert($data);
        foreach($table->getData() as $data) {
            try {
                $table->getAdapter()->insert($table, $data);
            } catch (PDOException $exception) {
                continue;
            }
        }
    }
}
