<?php
namespace StudentsManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use StudentsManager\Model\Table\ReligionsTable;

/**
 * StudentsManager\Model\Table\ReligionsTable Test Case
 */
class ReligionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \StudentsManager\Model\Table\ReligionsTable
     */
    public $Religions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.students_manager.religions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Religions') ? [] : ['className' => ReligionsTable::class];
        $this->Religions = TableRegistry::get('Religions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Religions);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
