<?php
namespace StudentsManager\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * SearchParameter helper
 */
class SearchParameterHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

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
