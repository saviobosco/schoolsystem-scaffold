<?php
namespace StudentsManager\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;
use Faker\Factory;
/**
 * StudentsFixture
 *
 */
class StudentsFixture extends TestFixture
{

    public $import = ['table' => 'students'];

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => '001',
            'first_name' => 'Omebe',
            'last_name' => 'Johnbosco',
            'class_id' => 1,
            'created' => '2018-01-07 13:55:32',
            'modified' => '2018-01-07 13:55:32',
            'status' => 0
        ],
        [
            'id' => '002',
            'first_name' => 'Omebe',
            'last_name' => 'Ebuka',
            'class_id' => 1,
            'created' => '2018-01-07 13:55:32',
            'modified' => '2018-01-07 13:55:32',
            'status' => 1
        ]
    ];

}
