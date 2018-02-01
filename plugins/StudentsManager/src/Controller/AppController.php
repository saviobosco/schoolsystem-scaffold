<?php

namespace StudentsManager\Controller;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('StudentsManager.States');
        $this->loadModel('StudentsManager.Sessions');
        $this->loadModel('StudentsManager.Students');
    }

}
