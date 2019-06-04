<?php
namespace ResultSystem\View\Cell;

use Cake\Core\Plugin;
use Cake\View\Cell;
use Cake\ORM\TableRegistry;

/**
 * ResultGrades cell
 */
class ResultGradesCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
        if (Plugin::loaded('GradingSystem')) {
            $resultGradingTable = TableRegistry::get('GradingSystem.ResultGradingSystems');
            $resultGradings = $resultGradingTable->query()->select(['grade', 'score'])->orderAsc('cal_order')->combine('grade', 'score')->toArray();
            $this->set(compact('resultGradings'));
        }
    }
}
