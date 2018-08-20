<?php
namespace FinanceManager\Test\TestCase\Model\Table;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use FinanceManager\Model\Table\StudentFeesTable;

/**
 * FinanceManager\Model\Table\StudentFeesTable Test Case
 */
class StudentFeesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \FinanceManager\Model\Table\StudentFeesTable
     */
    public $StudentFees;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.finance_manager.student_fees',
        'plugin.finance_manager.students',
        'plugin.finance_manager.classes',
        'plugin.finance_manager.fees',
        'plugin.finance_manager.fee_categories',
        'plugin.finance_manager.student_fee_payments',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StudentFees') ? [] : ['className' => StudentFeesTable::class];
        $this->StudentFees = TableRegistry::get('StudentFees', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentFees);

        parent::tearDown();
    }

    /**
     * Test deleteStudentFee method
     *
     * @return void
     */
    public function testDeleteStudentFeeFailedCauseOfPaidFees()
    {
        $studentFee = $this->StudentFees->get(1);
        $this->assertNotTrue($this->StudentFees->deleteStudentFee($studentFee));
    }

    /** @test */
    public function testDeleteStudentFee()
    {
        $studentFee = $this->StudentFees->get(3);
        $this->assertTrue($this->StudentFees->deleteStudentFee($studentFee));
        $fee = $this->StudentFees->Fees->get($studentFee->fee_id);
        $this->assertEquals(25000, $fee->income_amount_expected);
        $this->assertEquals(1, $fee->number_of_students);
    }


}
