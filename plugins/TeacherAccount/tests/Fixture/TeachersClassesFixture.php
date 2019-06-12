<?php
namespace TeacherAccount\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TeachersClassesFixture
 *
 */
class TeachersClassesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'teacher_id' => ['type' => 'string', 'length' => 36, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_0900_ai_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'class_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'teachers_classes_teacher_id' => ['type' => 'index', 'columns' => ['teacher_id'], 'length' => []],
            'teachers_classes_class_id' => ['type' => 'index', 'columns' => ['class_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'teachers_classes_ibfk_1' => ['type' => 'foreign', 'columns' => ['teacher_id'], 'references' => ['users', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'teachers_classes_ibfk_2' => ['type' => 'foreign', 'columns' => ['class_id'], 'references' => ['classes', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_0900_ai_ci'
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
            'teacher_id' => '2',
            'class_id' => 1
        ],
    ];
}
