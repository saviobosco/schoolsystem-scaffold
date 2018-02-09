<?php
namespace FinanceManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use FinanceManager\Model\Table\StudentFeePaymentsTable;

/**
 * FinanceManager\Model\Table\StudentFeePaymentsTable Test Case
 */
class StudentFeePaymentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \FinanceManager\Model\Table\StudentFeePaymentsTable
     */
    public $StudentFeePayments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.student_fee_payments',
        'plugin.finance_manager.student_fees',
        'plugin.finance_manager.students',
        'plugin.finance_manager.classes',
        'plugin.finance_manager.blocks',
        'plugin.finance_manager.class_demarcations',
        'plugin.finance_manager.student_annual_results',
        'plugin.finance_manager.student_termly_results',
        'plugin.finance_manager.receipts',
        'plugin.finance_manager.religions',
        'plugin.finance_manager.fees',
        'plugin.finance_manager.fee_categories',
        'plugin.finance_manager.terms',
        'plugin.finance_manager.student_class_counts',
        'plugin.finance_manager.student_general_remarks',
        'plugin.finance_manager.student_publish_results',
        'plugin.finance_manager.student_result_pins',
        'plugin.finance_manager.student_termly_position_on_class_demarcations',
        'plugin.finance_manager.student_termly_positions',
        'plugin.finance_manager.student_termly_subject_position_on_class_demarcations',
        'plugin.finance_manager.student_termly_subject_positions',
        'plugin.finance_manager.students_affective_disposition_scores',
        'plugin.finance_manager.students_psychomotor_skill_scores',
        'plugin.finance_manager.subject_class_averages',
        'plugin.finance_manager.sessions',
        'plugin.finance_manager.result_remarks',
        'plugin.finance_manager.student_annual_position_on_class_demarcations',
        'plugin.finance_manager.student_annual_positions',
        'plugin.finance_manager.student_annual_subject_position_on_class_demarcations',
        'plugin.finance_manager.student_annual_subject_positions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StudentFeePayments') ? [] : ['className' => StudentFeePaymentsTable::class];
        $this->StudentFeePayments = TableRegistry::get('StudentFeePayments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentFeePayments);

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
