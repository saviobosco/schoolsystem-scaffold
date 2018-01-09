<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClassDemacationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClassDemacationsTable Test Case
 */
class ClassDemarcationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ClassDemarcationsTable
     */
    public $ClassDemarcations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.class_demarcations',
        'app.classes',
        'app.students',
        'app.sessions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ClassDemarcations') ? [] : ['className' => 'App\Model\Table\ClassDemacationsTable'];
        $this->ClassDemarcations = TableRegistry::get('ClassDemarcations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ClassDemarcations);

        parent::tearDown();
    }
}
