<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SubjectsFixture
 *
 */
class SubjectsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'block_id' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
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
            'name' => 'MATHEMATICS',
            'block_id' => 1
        ],
        [
            'id' => 2,
            'name' => 'ENGLISH LANGUAGE',
            'block_id' => 1
        ],
        [
            'id' => 3,
            'name' => 'IGBO LANGUAGE',
            'block_id' => 1
        ],
        [
            'id' => 4,
            'name' => 'PHYSICAL AND HEALTH EDUCATION',
            'block_id' => 1
        ],
        [
            'id' => 5,
            'name' => 'FRENCH',
            'block_id' => 1
        ],
        [
            'id' => 6,
            'name' => 'CIVIC EDUCATION',
            'block_id' => 1
        ],
        [
            'id' => 7,
            'name' => 'HOME ECONOMICS',
            'block_id' => 1
        ],
        [
            'id' => 8,
            'name' => 'CHRISTAIN RELIGIOUS STUDIES',
            'block_id' => 1
        ],
        [
            'id' => 9,
            'name' => 'LATIN',
            'block_id' => 1
        ],
        [
            'id' => 10,
            'name' => 'LITERATURE IN ENGLISH',
            'block_id' => 1
        ],
        [
            'id' => 11,
            'name' => 'SOCIAL STUDIES',
            'block_id' => 1
        ],
        [
            'id' => 12,
            'name' => 'HUMANITIES',
            'block_id' => 1
        ],
    ];
}
