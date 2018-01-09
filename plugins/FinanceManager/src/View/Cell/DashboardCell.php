<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 10/21/17
 * Time: 1:18 PM
 */

namespace FinanceManager\View\Cell;


use Cake\View\Cell;

/**
 * Class DashboardCell
 * @package App\View\Cell
 *
 *
 * @property \FinanceManager\Model\Table\FeeCategoriesTable $FeeCategories
 * @property \FinanceManager\Model\Table\IncomesTable $Incomes
 * @property \FinanceManager\Model\Table\ExpendituresTable $Expenditures
 */
class DashboardCell extends Cell
{
    public function getNumberOfStudents()
    {
        $this->loadModel('FinanceManager.Students');
        $students = $this->Students->find('all');
        $this->set('students', $students->count());
    }

    public function getNumberOfSessions()
    {
        $this->loadModel('FinanceManager.Sessions');
        $sessions = $this->Sessions->find();
        $this->set('sessions', $sessions->count());
    }

    public function getIncomeSources()
    {
        // get fee income ordered by fee category
        $this->loadModel('FinanceManager.FeeCategories');
        $incomeSources = $this->FeeCategories->find('IncomeByFeeCategories');

        $this->set(compact('incomeSources'));
    }

    public function getTotalIncome()
    {
        // load the income Table
        $this->loadModel('FinanceManager.Incomes');
        $incomes = $this->Incomes->find();
        $totalIncome = 0;
        foreach ( $incomes as $income ) {
            $totalIncome += $income->amount;
        }
        $this->set(compact('totalIncome'));
    }

    public function getTotalExpenditure()
    {
        // load the income Table
        $this->loadModel('FinanceManager.Expenditures');
        $Expenses = $this->Expenditures->find();
        $totalExpenses = 0;
        foreach ( $Expenses as $expense ) {
            $totalExpenses += $expense->amount;
        }
        $this->set(compact('totalExpenses'));
    }

}