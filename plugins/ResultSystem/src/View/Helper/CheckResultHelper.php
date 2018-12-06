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
        $sessions = (TableRegistry::getTableLocator()->get('ResultSystem.Sessions'))->find('list');
        $classes = (TableRegistry::getTableLocator()->get('ResultSystem.Classes'))->find('list');
        $terms = (TableRegistry::getTableLocator()->get('ResultSystem.Terms'))->find('list');
        return $this->_View->element(
            'ResultSystem.CheckResult/check_result',
            compact('sessions', 'classes', 'terms')
        );
        // and render the element
    }
}