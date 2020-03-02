<?php
use Migrations\AbstractMigration;

class InitializeApplication extends AbstractMigration
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
        $this->table('classes')
            ->addColumn('class', 'string', [
                'default' => null,
                'limit' => 30,
                'null' => false,
            ])
            ->addColumn('block_id', 'integer', [
                'default' => null,
                'limit' => 4,
                'null' => false,
            ])
            ->addColumn('sort_order', 'integer',[
              'default' => 0,
                'null' => false
            ])
            ->addColumn('next_grade', 'integer', [
                'default' => null,
                'null' => true
            ])
            ->addIndex(
                [
                    'block_id',
                ]
            )
            ->create();



        $this->table('blocks')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->create();



        $this->table('sessions')
            ->addColumn('session', 'string', [
                'default' => null,
                'limit' => 30,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('settings_configurations')
            ->addColumn('name', 'string', [
                'default' => '',
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('value', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])

            ->addColumn('description', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])

            ->addColumn('type', 'string', [
                'default' => '',
                'limit' => 50,
                'null' => false,
            ])

            ->addColumn('editable', 'boolean', [
                'default' => true,
                'limit' => null,
                'null' => false,
            ])

            ->addColumn('weight', 'integer', [
                'default' => '0',
                'limit' => 11,
                'null' => false,
            ])

            ->addColumn('autoload', 'boolean', [
                'default' => true,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();


        $this->table('states')
            ->addColumn('state', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->create();

        $this->table('religions')
            ->addColumn('religion', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('default_selection', 'boolean', [
                'default' => null,
                'null' => true
            ])
            ->create();

        $this->table('nationalities')
            ->addColumn('nationality', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('default_selection', 'boolean', [
                'default' => null,
                'null' => true
            ])
            ->create();

        $this->table('medical_issues')
            ->addColumn('issue', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->create();

        $this->table('students', ['id' => false, 'primary_key' => ['id']])
             ->addForeignKey(
                 'class_id',
                 'classes',
                 'id',
                 [
                     'update' => 'CASCADE',
                     'delete' => 'CASCADE'
                 ])

            ->addForeignKey(
                'religion_id',
                'religions',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])
            ->addForeignKey(
                'nationality_id',
                'nationalities',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ])

            ->addColumn('id', 'string', [
                'default' => null,
                'limit' => 30,
                'null' => false,
            ])

            ->addColumn('first_name', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('middle_name', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('last_name', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])

            ->addColumn('gender', 'string', [
                'default' => '',
                'limit' => 255,
                'null' => true,
            ])

            ->addColumn('date_of_birth', 'date', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])

            ->addColumn('class_id', 'integer', [
                'default' => null,
                'limit' => 2,
                'null' => false,
            ])

            ->addColumn('student_type_id', 'string', [
                'default' => null,
                'limit' => 3,
                'null' => true,
            ])

            ->addColumn('state_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])

            ->addColumn('l_g_a', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])

            ->addColumn('hometown', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])

            ->addColumn('nationality_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])

            ->addColumn('religion_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
            ])

            ->addColumn('more_information_about_religion', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])

            ->addColumn('session_admitted', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])

            ->addColumn('date_admitted', 'date', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])

            ->addColumn('state_cee_score', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])

            ->addColumn('former_school', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])

            ->addColumn('year_of_graduation', 'year', [
                'default' => null,
                'null' => true,
            ])

            ->addColumn('blood_group', 'string', [
                'default' => null,
                'limit' => '10',
                'null' => true
            ])

            ->addColumn('genotype', 'char', [
                'default' => null,
                'limit' => '3',
                'null' => true
            ])

            ->addColumn('medical_issues', 'string', [
                'default' => null,
                'limit' => '1000',
                'null' => true
            ])

            ->addColumn('more_medical_information', 'text', [
                'default' => null,
                'null' => true
            ])

            ->addColumn('sponsor_full_name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])

            ->addColumn('sponsor_contact_address', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])

            ->addColumn('sponsor_phone_number', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])

            ->addColumn('sponsor_email_address', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])

            ->addColumn('sponsor_relationship', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('sponsor_occupation', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])

            ->addColumn('photo', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])

            ->addColumn('status', 'integer', [
                'default' => '1',
                'limit' => 3,
                'null' => false,
            ])
            ->addTimestamps('created', 'modified')
            ->addIndex(
                ['class_id', 'religion_id', 'nationality_id']
            )
            ->create();






        $this->table('subjects')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])

            ->addColumn('block_id', 'integer', [
                'default' => null,
                'limit' => 4,
                'null' => false,
            ])

            ->create();



        $this->table('terms')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 30,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();


        $this->table('users', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('username', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('password', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('first_name', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('last_name', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('token', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('token_expires', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('api_token', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('activation_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('tos_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('active', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('is_superuser', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('role', 'string', [
                'default' => 'user',
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('record_id', 'string', [
                'default' => null,
                'limit' => 30,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'record_id',
                ]
            )
            ->create();

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

        $table = $this->table('student_types');
        $table->addColumn('name', 'string', [
        'default' => null,
        'limit' => 100,
        'null' => false,
        ])
        ->addColumn('default_selection', 'boolean', [
            'default' => null,
            'null' => true
        ])
        ->create();

    }
}
