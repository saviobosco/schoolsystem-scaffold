<?php
namespace ResultSystem\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StudentsFixture
 *
 */
class StudentsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'string', 'length' => 30, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'first_name' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'last_name' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'date_of_birth' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'gender' => ['type' => 'string', 'length' => 10, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'state_of_origin' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'religion' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'home_residence' => ['type' => 'string', 'length' => 70, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'guardian' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'relationship_to_guardian' => ['type' => 'string', 'length' => 30, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'occupation_of_guardian' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'guardian_phone_number' => ['type' => 'string', 'length' => 15, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'session_id' => ['type' => 'string', 'length' => 11, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'class_id' => ['type' => 'integer', 'length' => 2, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'class_demarcation_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'photo' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'photo_dir' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'status' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'session_admitted_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'graduated' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => 'indicated if the student has graduated', 'precision' => null, 'autoIncrement' => null],
        'graduated_session_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'Session the Student Graduated', 'precision' => null, 'autoIncrement' => null],
        'state_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'unique_id' => ['type' => 'unique', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 'SMS/2017/001',
            'first_name' => 'Omebe',
            'last_name' => 'Johnbosco',
            'date_of_birth' => '2017-07-13',
            'gender' => 'Lorem ip',
            'state_of_origin' => 'Lorem ipsum dolor sit amet',
            'religion' => 'Lorem ipsum dolor sit amet',
            'home_residence' => 'Lorem ipsum dolor sit amet',
            'guardian' => 'Lorem ipsum dolor sit amet',
            'relationship_to_guardian' => 'Lorem ipsum dolor sit amet',
            'occupation_of_guardian' => 'Lorem ipsum dolor sit amet',
            'guardian_phone_number' => 'Lorem ipsum d',
            'session_id' => 'Lorem ips',
            'class_id' => 1,
            'class_demarcation_id' => 1,
            'photo' => 'Lorem ipsum dolor sit amet',
            'photo_dir' => 'Lorem ipsum dolor sit amet',
            'created' => '2017-07-13 04:17:58',
            'modified' => '2017-07-13 04:17:58',
            'status' => 1,
            'session_admitted_id' => 1,
            'graduated' => 1,
            'graduated_session_id' => 1,
            'state_id' => 1
        ],
        [
            'id' => 'SMS/2017/002',
            'first_name' => 'Lorem ipsum dolor sit amet',
            'last_name' => 'Lorem ipsum dolor sit amet',
            'date_of_birth' => '2017-07-13',
            'gender' => 'Lorem ip',
            'state_of_origin' => 'Lorem ipsum dolor sit amet',
            'religion' => 'Lorem ipsum dolor sit amet',
            'home_residence' => 'Lorem ipsum dolor sit amet',
            'guardian' => 'Lorem ipsum dolor sit amet',
            'relationship_to_guardian' => 'Lorem ipsum dolor sit amet',
            'occupation_of_guardian' => 'Lorem ipsum dolor sit amet',
            'guardian_phone_number' => 'Lorem ipsum d',
            'session_id' => 'Lorem ips',
            'class_id' => 1,
            'class_demarcation_id' => 1,
            'photo' => 'Lorem ipsum dolor sit amet',
            'photo_dir' => 'Lorem ipsum dolor sit amet',
            'created' => '2017-07-13 04:17:58',
            'modified' => '2017-07-13 04:17:58',
            'status' => 1,
            'session_admitted_id' => 1,
            'graduated' => 0,
            'graduated_session_id' => null,
            'state_id' => 1
        ],
        [
            'id' => 'SMS/2017/003',
            'first_name' => 'Lorem ipsum dolor sit amet',
            'last_name' => 'Lorem ipsum dolor sit amet',
            'date_of_birth' => '2017-07-13',
            'gender' => 'Lorem ip',
            'state_of_origin' => 'Lorem ipsum dolor sit amet',
            'religion' => 'Lorem ipsum dolor sit amet',
            'home_residence' => 'Lorem ipsum dolor sit amet',
            'guardian' => 'Lorem ipsum dolor sit amet',
            'relationship_to_guardian' => 'Lorem ipsum dolor sit amet',
            'occupation_of_guardian' => 'Lorem ipsum dolor sit amet',
            'guardian_phone_number' => 'Lorem ipsum d',
            'session_id' => 'Lorem ips',
            'class_id' => 3,
            'class_demarcation_id' => 1,
            'photo' => 'Lorem ipsum dolor sit amet',
            'photo_dir' => 'Lorem ipsum dolor sit amet',
            'created' => '2017-07-13 04:17:58',
            'modified' => '2017-07-13 04:17:58',
            'status' => 1,
            'session_admitted_id' => 1,
            'graduated' => 0,
            'graduated_session_id' => null,
            'state_id' => 1
        ],
        [
            'id' => 'SMS/2017/004',
            'first_name' => 'Lorem ipsum dolor sit amet',
            'last_name' => 'Lorem ipsum dolor sit amet',
            'date_of_birth' => '2017-07-13',
            'gender' => 'Lorem ip',
            'state_of_origin' => 'Lorem ipsum dolor sit amet',
            'religion' => 'Lorem ipsum dolor sit amet',
            'home_residence' => 'Lorem ipsum dolor sit amet',
            'guardian' => 'Lorem ipsum dolor sit amet',
            'relationship_to_guardian' => 'Lorem ipsum dolor sit amet',
            'occupation_of_guardian' => 'Lorem ipsum dolor sit amet',
            'guardian_phone_number' => 'Lorem ipsum d',
            'session_id' => 'Lorem ips',
            'class_id' => 3,
            'class_demarcation_id' => 1,
            'photo' => 'Lorem ipsum dolor sit amet',
            'photo_dir' => 'Lorem ipsum dolor sit amet',
            'created' => '2017-07-13 04:17:58',
            'modified' => '2017-07-13 04:17:58',
            'status' => 0,
            'session_admitted_id' => 1,
            'graduated' => 0,
            'graduated_session_id' => null,
            'state_id' => 1
        ],
        [
            'id' => 'SMS/2017/005',
            'first_name' => 'Lorem ipsum dolor sit amet',
            'last_name' => 'Lorem ipsum dolor sit amet',
            'date_of_birth' => '2017-07-13',
            'gender' => 'Lorem ip',
            'state_of_origin' => 'Lorem ipsum dolor sit amet',
            'religion' => 'Lorem ipsum dolor sit amet',
            'home_residence' => 'Lorem ipsum dolor sit amet',
            'guardian' => 'Lorem ipsum dolor sit amet',
            'relationship_to_guardian' => 'Lorem ipsum dolor sit amet',
            'occupation_of_guardian' => 'Lorem ipsum dolor sit amet',
            'guardian_phone_number' => 'Lorem ipsum d',
            'session_id' => 'Lorem ips',
            'class_id' => 3,
            'class_demarcation_id' => 1,
            'photo' => 'Lorem ipsum dolor sit amet',
            'photo_dir' => 'Lorem ipsum dolor sit amet',
            'created' => '2017-07-13 04:17:58',
            'modified' => '2017-07-13 04:17:58',
            'status' => 1,
            'session_admitted_id' => 1,
            'graduated' => 1,
            'graduated_session_id' => 1,
            'state_id' => 1
        ],
    ];
}
