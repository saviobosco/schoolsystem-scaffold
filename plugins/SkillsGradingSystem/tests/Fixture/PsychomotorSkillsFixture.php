<?php
namespace SkillsGradingSystem\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PsychomotorSkillsFixture
 *
 */
class PsychomotorSkillsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'name' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
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
            'name' => 'Hand Writing',
            'created' => '2016-09-12 15:34:16',
            'modified' => '2016-09-12 15:34:16'
        ],
        [
            'id' => 2,
            'name' => 'Handling of Tools',
            'created' => '2016-09-12 15:34:16',
            'modified' => '2016-09-12 15:34:16'
        ],
    ];
}
