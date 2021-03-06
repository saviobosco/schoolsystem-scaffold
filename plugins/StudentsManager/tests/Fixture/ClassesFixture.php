<?php
namespace StudentsManager\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ClassesFixture
 *
 */
class ClassesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'class' => ['type' => 'string', 'length' => 30, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'block_id' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'no_of_subjects' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'block_id' => ['type' => 'index', 'columns' => ['block_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'classes_ibfk_1' => ['type' => 'foreign', 'columns' => ['block_id'], 'references' => ['blocks', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
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
            'class' => 'Lorem ipsum dolor sit amet',
            'block_id' => 1,
            'created' => '2018-01-07 13:59:49',
            'modified' => '2018-01-07 13:59:49',
            'no_of_subjects' => 1
        ],
        [
            'id' => 2,
            'class' => 'Lorem ipsum dolor sit amet',
            'block_id' => 1,
            'created' => '2018-01-07 13:59:49',
            'modified' => '2018-01-07 13:59:49',
            'no_of_subjects' => 1
        ],
        [
            'id' => 3,
            'class' => 'Lorem ipsum dolor sit amet',
            'block_id' => 1,
            'created' => '2018-01-07 13:59:49',
            'modified' => '2018-01-07 13:59:49',
            'no_of_subjects' => 1
        ],
        [
            'id' => 4,
            'class' => 'Lorem ipsum dolor sit amet',
            'block_id' => 1,
            'created' => '2018-01-07 13:59:49',
            'modified' => '2018-01-07 13:59:49',
            'no_of_subjects' => 1
        ],
    ];
}
