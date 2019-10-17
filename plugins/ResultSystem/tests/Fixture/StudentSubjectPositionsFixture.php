<?php
namespace ResultSystem\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StudentSubjectPositionsFixture
 *
 */
class StudentSubjectPositionsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'subject_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'student_id' => ['type' => 'string', 'length' => 30, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'total' => ['type' => 'float', 'length' => null, 'precision' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'position' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'class_id' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'term_id' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'session_id' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'su_student_id' => ['type' => 'index', 'columns' => ['student_id'], 'length' => []],
            'su_subject_id' => ['type' => 'index', 'columns' => ['subject_id'], 'length' => []],
            'su_session_id' => ['type' => 'index', 'columns' => ['session_id'], 'length' => []],
            'su_class_id' => ['type' => 'index', 'columns' => ['class_id'], 'length' => []],
            'term_id' => ['type' => 'index', 'columns' => ['term_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'student_subject_positions_ibfk_1' => ['type' => 'foreign', 'columns' => ['student_id'], 'references' => ['students', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'student_subject_positions_ibfk_2' => ['type' => 'foreign', 'columns' => ['subject_id'], 'references' => ['subjects', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'student_subject_positions_ibfk_3' => ['type' => 'foreign', 'columns' => ['session_id'], 'references' => ['sessions', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'student_subject_positions_ibfk_4' => ['type' => 'foreign', 'columns' => ['class_id'], 'references' => ['classes', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'student_subject_positions_ibfk_5' => ['type' => 'foreign', 'columns' => ['term_id'], 'references' => ['terms', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_unicode_ci'
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
            'subject_id' => 1,
            'student_id' => '001',
            'total' => 1,
            'position' => 1,
            'class_id' => 1,
            'term_id' => 1,
            'session_id' => 1
        ],
    ];
}
