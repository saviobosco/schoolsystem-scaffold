<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/28/16
 * Time: 3:24 PM
 */
namespace ResultSystem\View\Helper;

use Cake\View\Helper;
use Cake\I18n\Time;

class ResultHelper extends Helper
{
    public $helpers = ['Number'];
    public function studentRemark($studentRemark)
    {
        if (!empty($studentRemark)) {
            return "
                    <div style='border-bottom: 1px solid #000000;'>
                         <p class='general-remark'> $studentRemark </p>
                    </div>";
        } else {
            return "
            <div style='border-bottom: 1px solid #000000; margin-top:20px;'>
                &nbsp;
            </div>
            ";
        }
    }

    public function nextTermDate($date)
    {
        if (empty($date)) {
            return '';
        }
        return (new Time(@$date))->format('l jS \\of F, Y');
    }

    public function displayFees ($fees)
    {
        if (!empty($fees)) {
            echo "
            <table class='table fees-table table-bordered'>
                       <thead>
                            <tr>
                                <th> Fees </th>
                                <th> Amount</th>
                            </tr>
                       </thead>
                        <tbody>";
                         foreach ($fees as $fee) {
                            echo "<tr>
                                <td>".  h($fee->type) ."</td>
                                <td> ".$this->Number->format($fee->amount) ."</td>
                            </tr> ";
                        }
                        echo "</tbody>
                    </table> " ;
        }
    }

}