<?php
namespace FinanceManager\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Receipt helper
 */
class PaymentHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];


    public function calculateTotal($payments, $column)
    {
        if ( empty($payments)) {
            return 0;
        }
        $amount = 0;
        foreach ( $payments as $payment ) {
            $amount += $payment["$column"];
        }
        return $amount;
    }

    public function calculateArrearsTotal($arrears)
    {
        $amount = 0;
        foreach ( $arrears as $arrear ) {
            $amount += ($arrear['amount_remaining']) ? $arrear['amount_remaining'] : $arrear['fee']['amount'] ;
        }
        return $amount;
    }

    public function calculateFeesBalance($payments)
    {
        $balance = 0;
        foreach ( $payments as $payment ) {
            $balance += $payment['amount_remaining'];
        }
        return $balance;
    }

    public function displayPaidStatus($status)
    {
        if ($status ) {
            return '<span class="text-success"> Paid </span>';
        } else {
            return '<span class="text-danger"> No </span>';
        }
    }
}
