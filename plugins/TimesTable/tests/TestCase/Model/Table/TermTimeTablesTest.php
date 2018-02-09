<?php
namespace TimesTable\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use TimesTable\Model\Table\TermTimeTables;

/**
 * TimesTable\Model\Table\TermTimeTables Test Case
 */
class TermTimeTablesTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \TimesTable\Model\Table\TermTimeTables
     */
    public $TermTimeTables;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TermTimes') ? [] : ['className' => 'TimesTable\Model\Table\TermTimeTables'];
        $this->TermTimeTables = TableRegistry::get('TermTimes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TermTimeTables);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
