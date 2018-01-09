<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 7/1/16
 * Time: 5:23 PM
 */

namespace ResultSystem\Controller\Traits;


trait SearchParameterTrait
{

    protected function _getDefaultValue($passed_value,$default_value)
    {
        if (empty($passed_value)) {
            return $default_value;
        }
        return $passed_value;
    }

}