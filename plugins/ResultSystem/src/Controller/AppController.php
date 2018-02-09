<?php

namespace ResultSystem\Controller;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Saviobosco/Excel.ImportExcel');
        $this->loadComponent('ResultSystem.ResultSystem');
        $this->loadComponent('Csrf');
    }
}
