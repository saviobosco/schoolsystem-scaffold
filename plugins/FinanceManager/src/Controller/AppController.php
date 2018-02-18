<?php

namespace FinanceManager\Controller;

use App\Controller\AppController as BaseController;
use Muffin\Footprint\Auth\FootprintAwareTrait;


class AppController extends BaseController
{

    use FootprintAwareTrait;

    public function initialize()
    {
        parent::initialize();
        // for the footprint
        $this->_userModel = 'UsersManager.Accounts';
        $this->loadComponent('Csrf');
    }
}
