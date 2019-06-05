<?php

namespace ParentAccount\Controller;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->setConfig('authorize', ['Controller']);
    }

    public function isAuthorized()
    {
        if ($this->Auth->user('role') === 'parent') {
            return true;
        }
        return false;
    }
}
