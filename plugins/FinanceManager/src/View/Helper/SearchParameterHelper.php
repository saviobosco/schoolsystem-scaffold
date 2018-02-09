<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 7/17/16
 * Time: 5:18 PM
 */

namespace App\View\Helper;


use Cake\View\Helper;

class SearchParameterHelper extends Helper
{
    public function getDefaultValue($value = null,$default_value)
    {
        if(empty($value)){
            return $default_value;
        }
        return $value;
    }

    function getDefaultYear($year = null){
        if(empty($year)){
            return date('Y');
        }
        return $year;
    }
}