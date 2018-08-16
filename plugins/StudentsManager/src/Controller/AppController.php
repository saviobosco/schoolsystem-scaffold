<?php

namespace StudentsManager\Controller;

use Cake\Event\Event;
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

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['pushData']);
    }

}
