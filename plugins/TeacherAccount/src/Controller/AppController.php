<?php

namespace TeacherAccount\Controller;

use App\Controller\AppController as BaseController;
use Cake\Core\Configure;

class AppController extends BaseController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->setConfig('authorize', ['Controller']);
    }

    public function isAuthorized()
    {
        if ($this->Auth->user('role') === 'teacher') {
            return true;
        }
        $this->Flash->error('You are not authorised to access this section.');
        return false;
    }

}
