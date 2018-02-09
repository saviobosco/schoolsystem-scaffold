<?php
namespace FinanceManager\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Currency helper
 * @property \Cake\View\Helper\NumberHelper $Number
 */
class CurrencyHelper extends Helper
{

    var $helpers = ['Number'];

    public $currencyType = [
        'Naira' => '&#8358;',
        // Add more currency value types
    ];

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function displayCurrency($money,$currencyType = null ,$option = [])
    {
        if (!isset($currencyType)) {
            $type = 'Naira';
        }
        return $this->currencyType[$type].$this->Number->format($money,['places'=>2,'precision'=>2,/*'useIntlCode'=>true*/]);
    }

}
