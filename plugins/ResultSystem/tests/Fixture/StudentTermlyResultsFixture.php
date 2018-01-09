<?php
namespace ResultSystem\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StudentTermlyResultsFixture
 *
 */
class StudentTermlyResultsFixture extends TestFixture
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
        'subject_id' => ['type' => 'string', 'length' => 30, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'first_test' => ['type' => 'float', 'length' => 3, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'second_test' => ['type' => 'float', 'length' => 3, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'third_test' => ['type' => 'float', 'length' => 3, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'exam' => ['type' => 'float', 'length' => 3, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'total' => ['type' => 'float', 'length' => 3, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'grade' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'remark' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'principal_comment' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'head_teacher_comment' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'class_id' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'term_id' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'session_id' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
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
            'student_id' => 'SMS/2017/001',
            'subject_id' => 1,
            'first_test' => 9,
            'second_test' => 8,
            'third_test' => 10,
            'exam' => 65,
            'total' => 80,
            'grade' => null,
            'remark' => null,
            'principal_comment' => 'Lorem ipsum dolor sit amet',
            'head_teacher_comment' => 'Lorem ipsum dolor sit amet',
            'class_id' => 1,
            'term_id' => 1,
            'session_id' => 1
        ],
        [
            'id' => 2,
            'student_id' => 'SMS/2017/001',
            'subject_id' => 2,
            'first_test' => 10,
            'second_test' => 7,
            'third_test' => 5,
            'exam' => 60,
            'total' => 85,
            'grade' => null,
            'remark' => 'Lorem ipsum dolor ',
            'principal_comment' => 'Lorem ipsum dolor sit amet',
            'head_teacher_comment' => 'Lorem ipsum dolor sit amet',
            'class_id' => 1,
            'term_id' => 1,
            'session_id' => 1
        ],
        [
            'id' => 3,
            'student_id' => 'SMS/2017/001',
            'subject_id' => 3,
            'first_test' => 10,
            'second_test' => 9,
            'third_test' => 10,
            'exam' => 70,
            'total' => 90,
            'grade' => null,
            'remark' => 'Lorem ipsum dolor ',
            'principal_comment' => 'Lorem ipsum dolor sit amet',
            'head_teacher_comment' => 'Lorem ipsum dolor sit amet',
            'class_id' => 1,
            'term_id' => 1,
            'session_id' => 1
        ],

        /* This is for the second */

        [
            'id' => 4,
            'student_id' => 'SMS/2017/002',
            'subject_id' => 1,
            'first_test' => 10,
            'second_test' => 4,
            'third_test' => 7,
            'exam' => 45,
            'total' => 79,
            'grade' => null,
            'remark' => 'Lorem ipsum dolor ',
            'principal_comment' => 'Lorem ipsum dolor sit amet',
            'head_teacher_comment' => 'Lorem ipsum dolor sit amet',
            'class_id' => 1,
            'term_id' => 1,
            'session_id' => 1
        ],
        [
            'id' => 5,
            'student_id' => 'SMS/2017/002',
            'subject_id' => 2,
            'first_test' => 8,
            'second_test' => 5,
            'third_test' => 6,
            'exam' => 55,
            'total' => 75,
            'grade' => null,
            'remark' => 'Lorem ipsum dolor ',
            'principal_comment' => 'Lorem ipsum dolor sit amet',
            'head_teacher_comment' => 'Lorem ipsum dolor sit amet',
            'class_id' => 1,
            'term_id' => 1,
            'session_id' => 1
        ],
        [
            'id' => 6,
            'student_id' => 'SMS/2017/002',
            'subject_id' => 3,
            'first_test' => 10,
            'second_test' => 4,
            'third_test' => 6,
            'exam' => 23,
            'total' => 68,
            'grade' => null,
            'remark' => 'Lorem ipsum dolor ',
            'principal_comment' => 'Lorem ipsum dolor sit amet',
            'head_teacher_comment' => 'Lorem ipsum dolor sit amet',
            'class_id' => 1,
            'term_id' => 1,
            'session_id' => 1
        ],
    ];
}
