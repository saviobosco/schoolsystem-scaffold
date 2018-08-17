<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 8/17/18
 * Time: 9:06 AM
 */

namespace ResultSystem\ResultProcessing;

use Cake\ORM\TableRegistry;
use Cake\I18n\Number;
trait ResultProcessingTrait
{
    public $grades = null;
    public $remarks = null;
    protected $_busy = false;

    protected function _initialize()
    {
        $resultGradingTable = TableRegistry::get('GradingSystem.ResultGradingSystems');
        $allRecords = $resultGradingTable->getAllRecords();
        $this->grades = $allRecords->combine('score','grade')->toArray();
        $this->remarks = $allRecords->combine('grade','remark')->toArray();
    }

    protected function _setBusy($status)
    {
        $this->_busy = $status;
    }

    protected function _getBusy()
    {
        return $this->_busy;
    }

    public function isBusy()
    {
        return $this->_getBusy();
    }

    public function startProcessing()
    {
        $this->_setBusy(true);
    }

    public function stopProcessing()
    {
        $this->_setBusy(false);
    }

    protected function _determineNumberPrecision($value)
    {
        if ( !is_float($value) ) {
            return (int)$value;
        }
        return Number::precision($value,2);
    }
}