<?php
namespace ResultSystem\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StudentAnnualResultsFixture
 *
 */
class StudentAnnualResultsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'student_id' => ['type' => 'string', 'length' => 30, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'subject_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'first_term' => ['type' => 'float', 'length' => null, 'precision' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'second_term' => ['type' => 'float', 'length' => null, 'precision' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'third_term' => ['type' => 'float', 'length' => null, 'precision' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'total' => ['type' => 'float', 'length' => null, 'precision' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'average' => ['type' => 'float', 'length' => null, 'precision' => null, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'remark' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'class_id' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'session_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'grade' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
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
            'id' => 1,
            'student_id' => '001',
            'subject_id' => 1,
            'first_term' => 92,
            'second_term' => null,
            'third_term' => null,
            'total' => 92,
            'average' => 1,
            'remark' => '',
            'class_id' => 1,
            'session_id' => 1,
            'grade' => ''
        ],
        [
            'id' => 2,
            'student_id' => '001',
            'subject_id' => 2,
            'first_term' => 82,
            'second_term' => null,
            'third_term' => null,
            'total' => 82,
            'average' => 1,
            'remark' => '',
            'class_id' => 1,
            'session_id' => 1,
            'grade' => ''
        ],
        [
            'id' => 3,
            'student_id' => '001',
            'subject_id' => 3,
            'first_term' => 74,
            'second_term' => null,
            'third_term' => null,
            'total' => 74,
            'average' => 1,
            'remark' => '',
            'class_id' => 1,
            'session_id' => 1,
            'grade' => ''
        ],
        // second student
        [
            'id' => 4,
            'student_id' => '002',
            'subject_id' => 1,
            'first_term' => 62,
            'second_term' => null,
            'third_term' => null,
            'total' => 62,
            'average' => 1,
            'remark' => '',
            'class_id' => 1,
            'session_id' => 1,
            'grade' => ''
        ],
        [
            'id' => 5,
            'student_id' => '002',
            'subject_id' => 2,
            'first_term' => 52,
            'second_term' => null,
            'third_term' => null,
            'total' => 74,
            'average' => 1,
            'remark' => '',
            'class_id' => 1,
            'session_id' => 1,
            'grade' => ''
        ],
        [
            'id' => 6,
            'student_id' => '002',
            'subject_id' => 3,
            'first_term' => 35,
            'second_term' => null,
            'third_term' => null,
            'total' => 35,
            'average' => 1,
            'remark' => '',
            'class_id' => 1,
            'session_id' => 1,
            'grade' => ''
        ],
        // third student
        [
            'id' => 7,
            'student_id' => '003',
            'subject_id' => 1,
            'first_term' => 63,
            'second_term' => null,
            'third_term' => null,
            'total' => 63,
            'average' => 1,
            'remark' => '',
            'class_id' => 1,
            'session_id' => 1,
            'grade' => ''
        ],
        [
            'id' => 8,
            'student_id' => '003',
            'subject_id' => 2,
            'first_term' => 54.5,
            'second_term' => null,
            'third_term' => null,
            'total' => 54.5,
            'average' => 1,
            'remark' => '',
            'class_id' => 1,
            'session_id' => 1,
            'grade' => ''
        ],
        [
            'id' => 9,
            'student_id' => '003',
            'subject_id' => 3,
            'first_term' => 42,
            'second_term' => null,
            'third_term' => null,
            'total' => 42,
            'average' => 1,
            'remark' => '',
            'class_id' => 1,
            'session_id' => 1,
            'grade' => ''
        ],
    ];
}
