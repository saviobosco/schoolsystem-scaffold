<?php
namespace App\View\Cell;

use Cake\ORM\TableRegistry;
use Cake\View\Cell;

/**
 * NewsUpdates cell
 */
class NewsUpdatesCell extends Cell
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
        $newsUpdatesTable = TableRegistry::get('Dashboard.NewsUpdates');
        $newsUpdates = $newsUpdatesTable->query()
            ->where(['status' => 1])
            ->orderDesc('default_post')
            ->orderDesc('created')
            ->toArray();
        $this->set(compact('newsUpdates'));
    }
}
