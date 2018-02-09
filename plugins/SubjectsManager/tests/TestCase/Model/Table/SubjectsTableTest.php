<?php
namespace SubjectsManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use SubjectsManager\Model\Table\SubjectsTable;

/**
 * SubjectsManager\Model\Table\SubjectsTable Test Case
 */
class SubjectsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \SubjectsManager\Model\Table\SubjectsTable
     */
    public $Subjects;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.subjects_manager.subjects',
        'plugin.subjects_manager.blocks',
        'plugin.subjects_manager.student_annual_results',
        'plugin.subjects_manager.student_annual_subject_position_on_class_demarcations',
        'plugin.subjects_manager.student_annual_subject_positions',
        'plugin.subjects_manager.student_termly_results',
        'plugin.subjects_manager.student_termly_subject_position_on_class_demarcations',
        'plugin.subjects_manager.student_termly_subject_positions',
        'plugin.subjects_manager.subject_class_averages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Subjects') ? [] : ['className' => SubjectsTable::class];
        $this->Subjects = TableRegistry::get('Subjects', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Subjects);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
