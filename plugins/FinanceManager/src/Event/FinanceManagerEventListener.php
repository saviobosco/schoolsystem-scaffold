<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 1/7/18
 * Time: 2:13 PM
 */

namespace FinanceManager\Event;


use Cake\Event\EventListenerInterface;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use FinanceManager\Model\Table\StudentFeePaymentsTable;
use StudentsManager\Model\Table\StudentsTable;

class FinanceManagerEventListener implements EventListenerInterface
{

    /**
     * Returns a list of events this object is implementing. When the class is registered
     * in an event manager, each individual method will be associated with the respective event.
     *
     * ### Example:
     *
     * ```
     *  public function implementedEvents()
     *  {
     *      return [
     *          'Order.complete' => 'sendEmail',
     *          'Article.afterBuy' => 'decrementInventory',
     *          'User.onRegister' => ['callable' => 'logRegistration', 'priority' => 20, 'passParams' => true]
     *      ];
     *  }
     * ```
     *
     * @return array associative array or event key names pointing to the function
     * that should be called in the object when the respective event is fired
     */
    public function implementedEvents()
    {
        return [
            StudentsTable::EVENT_ADDED_STUDENT => 'createStudentFees',
            StudentFeePaymentsTable::EVENT_AFTER_EACH_FEE_PAYMENT => 'recordIncomeByFeeAndFeeCategories',
            StudentFeePaymentsTable::EVENT_AFTER_FEES_PAYMENT => 'recordIncome',
            StudentFeePaymentsTable::EVENT_DELETED_PAYMENT_FEE_ITEM => 'decrementIncomeByFeeAndFeeCategories'
        ];
    }

    /**
     * @param $event
     * @param $student
     * Create the student fees record
     */
    public function createStudentFees($event, $student )
    {
        if ( $event->isStopped() === false ) {
            $studentTable = TableRegistry::get('FinanceManager.Students');
            $studentTable->createStudentFeesByClassIdAndSessionId($student['id'],$student['class_id'],$student['session_id']);
        }
    }

    public function recordIncomeByFeeAndFeeCategories($event,$paymentItem)
    {
        if ($event->isStopped()) {
            return false;
        }
        // Recording fee
        if ( !empty($paymentItem->fee_id)) {
            $feesTable = TableRegistry::get('FinanceManager.Fees');
            $fee = $feesTable->find()->where(['id'=>$paymentItem->fee_id])->first();
            $fee->amount_earned += $paymentItem->amount_paid;
            $feesTable->save($fee);
        }

        // Recording Income to Fee Category
        if ( !empty($paymentItem->fee_category_id)) {
            $feeCategoriesTable = TableRegistry::get('FinanceManager.FeeCategories');
            $feeCategory = $feeCategoriesTable->find()->where(['id'=>$paymentItem->fee_category_id])->first();
            $feeCategory->income_amount += $paymentItem->amount_paid;
            $feeCategoriesTable->save($feeCategory);
        }
    }

    public function decrementIncomeByFeeAndFeeCategories($event,$paymentItem)
    {
        if ($event->isStopped()) {
            return false;
        }
        // Recording fee
        if ( !empty($paymentItem->fee_id)) {
            $feesTable = TableRegistry::get('FinanceManager.Fees');
            $fee = $feesTable->find()->where(['id'=>$paymentItem->fee_id])->first();
            $fee->amount_earned -= $paymentItem->amount_paid;
            $feesTable->save($fee);
        }

        // Recording Income to Fee Category
        if ( !empty($paymentItem->fee_category_id)) {
            $feeCategoriesTable = TableRegistry::get('FinanceManager.FeeCategories');
            $feeCategory = $feeCategoriesTable->find()->where(['id'=>$paymentItem->fee_category_id])->first();
            $feeCategory->income_amount -= $paymentItem->amount_paid;
            $feeCategoriesTable->save($feeCategory);
        }
    }

    // record Income
    public function recordIncome($event,$receipt)
    {
        if ($event->isStopped()) {
            return false;
        }
        $incomeTable = TableRegistry::get('FinanceManager.Incomes');
        $dateCreated = new Time();
        $income = $incomeTable->newEntity([
            'amount' => $receipt->total_amount_paid,
            'week' => $dateCreated->toWeek(),
            'month' => $dateCreated->month,
            'year' => $dateCreated->year,
            'receipt_id' => $receipt->id
        ]);
        // Record it to database
        $incomeTable->save($income);
    }
}