<?php
namespace ResultSystem\View\Cell;

use Cake\Core\Plugin;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\View\Cell;

/**
 * SchoolTermTimeTable cell
 */
class SchoolTermTimeTableCell extends Cell
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
        if (Plugin::loaded('TimesTable')) {
            // check if the session and term id is set
            $getData = $this->request->getQuery();
            if ((isset($getData['session_id']) && isset($getData['term_id']) && (!empty($getData['session_id']) && !empty($getData['term_id'])))) {
                try {
                    $termTimeTablesTable = TableRegistry::get('TimesTable.TermTimeTables');
                    $openingDate = $termTimeTablesTable->query()
                        ->enableHydration(false)
                        ->select(['start_date'])
                        ->where([
                            'result_session_id'=>$getData['session_id'],
                            'result_term_id' => $getData['term_id']
                        ])->first();
                    if ($openingDate) {
                        $this->set(['opening_date' => (new Time($openingDate['start_date']))->format('l jS \\of F, Y') ]);
                    }
                } catch ( \Exception $exception) {
                    // sub due error
                }
            }

        }
    }
}
