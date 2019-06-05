<?php

namespace StudentAccount\Controller;

use App\Controller\AppController as BaseController;
use Cake\Event\Event;

class AppController extends BaseController
{

    public function initialize()
    {
        parent::initialize();
        $this->Auth->setConfig('authorize', ['Controller']);
    }

    public function isAuthorized()
    {
        if ($this->Auth->user('role') === 'student') {
            return true;
        }
        return false;
    }
}
