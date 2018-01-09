<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 1/7/18
 * Time: 4:16 PM
 */

use FinanceManager\Event\FinanceManagerEventListener;
use Cake\Event\EventManager;
EventManager::instance()->on(new FinanceManagerEventListener());