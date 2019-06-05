<?php
namespace StudentAccount\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use StudentAccount\Model\Table\StudentsTable;

/**
 * StudentAccount\Model\Table\StudentsTable Test Case
 */
class StudentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \StudentAccount\Model\Table\StudentsTable
     */
    public $Students;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.student_account.students',
        'plugin.student_account.religions',
        'plugin.student_account.classes',
        'plugin.student_account.class_demarcations',
        'plugin.student_account.states',
        'plugin.student_account.account_holders',
        'plugin.student_account.receipts',
        'plugin.student_account.student_annual_position_on_class_demarcations',
        'plugin.student_account.student_annual_positions',
        'plugin.student_account.student_annual_results',
        'plugin.student_account.student_annual_subject_position_on_class_demarcations',
        'plugin.student_account.student_annual_subject_positions',
        'plugin.student_account.student_fees',
        'plugin.student_account.student_general_remarks',
        'plugin.student_account.student_publish_results',
        'plugin.student_account.student_result_pins',
        'plugin.student_account.student_termly_position_on_class_demarcations',
        'plugin.student_account.student_termly_positions',
        'plugin.student_account.student_termly_results',
        'plugin.student_account.student_termly_subject_position_on_class_demarcations',
        'plugin.student_account.student_termly_subject_positions',
        'plugin.student_account.students_affective_disposition_scores',
        'plugin.student_account.students_psychomotor_skill_scores'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Students') ? [] : ['className' => StudentsTable::class];
        $this->Students = TableRegistry::get('Students', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Students);

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
