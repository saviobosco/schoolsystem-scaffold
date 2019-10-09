<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MedicalIssuesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MedicalIssuesTable Test Case
 */
class MedicalIssuesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MedicalIssuesTable
     */
    public $MedicalIssues;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.medical_issues'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MedicalIssues') ? [] : ['className' => MedicalIssuesTable::class];
        $this->MedicalIssues = TableRegistry::get('MedicalIssues', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MedicalIssues);

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
