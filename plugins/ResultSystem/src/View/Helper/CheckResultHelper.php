<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 11/2/18
 * Time: 9:37 AM
 */

namespace ResultSystem\View\Helper;


use Cake\ORM\TableRegistry;
use Cake\View\Helper;

class CheckResultHelper extends Helper
{

    public function showCheckResultForm()
    {
        return $this->_View->element(
            'ResultSystem.CheckResult/check_result'
        );
        // and render the element
    }
}