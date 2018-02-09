<?php
namespace BankSystem\Test\TestCase\Model\Table;

use BankSystem\Model\Table\StudentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * BankSystem\Model\Table\StudentsTable Test Case
 */
class StudentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \BankSystem\Model\Table\StudentsTable
     */
    public $Students;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.bank_system.students',
        'plugin.bank_system.religions',
        'plugin.bank_system.classes',
        'plugin.bank_system.class_demarcations',
        'plugin.bank_system.states',
        'plugin.bank_system.account_holders',
        'plugin.bank_system.account_types',
        'plugin.bank_system.receipts',
        'plugin.bank_system.student_annual_position_on_class_demarcations',
        'plugin.bank_system.student_annual_positions',
        'plugin.bank_system.student_annual_results',
        'plugin.bank_system.student_annual_subject_position_on_class_demarcations',
        'plugin.bank_system.student_annual_subject_positions',
        'plugin.bank_system.student_fees',
        'plugin.bank_system.student_general_remarks',
        'plugin.bank_system.student_publish_results',
        'plugin.bank_system.student_result_pins',
        'plugin.bank_system.student_termly_position_on_class_demarcations',
        'plugin.bank_system.student_termly_positions',
        'plugin.bank_system.student_termly_results',
        'plugin.bank_system.student_termly_subject_position_on_class_demarcations',
        'plugin.bank_system.student_termly_subject_positions',
        'plugin.bank_system.students_affective_disposition_scores',
        'plugin.bank_system.students_psychomotor_skill_scores'
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
