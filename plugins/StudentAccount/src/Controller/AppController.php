<?php

namespace StudentAccount\Controller;

use Cake\Controller\Controller as BaseController;
use Cake\Event\Event;

class AppController extends BaseController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth');

        $this->Auth->setConfig('authorize', ['Controller']);
        $this->Auth->setConfig('authenticate', [
            'Form' => [
                'userModel' => 'StudentAccount.StudentLogins'
            ]
        ]);
        $this->Auth->setConfig('loginRedirect', [
            'plugin' => 'StudentAccount',
            'controller' => 'Dashboard',
            'action' => 'index'
        ]);

        $this->Auth->setConfig('logoutRedirect', [
            'plugin' => 'StudentAccount',
            'controller' => 'Login',
            'action' => 'index'
        ]);

        $this->Auth->setConfig('loginAction', [
            'plugin' => 'StudentAccount',
            'controller' => 'Login',
            'action' => 'index'
        ]);
    }

    public function isAuthorized()
    {
        return true;
    }

    public function beforeFilter(Event $event) {
        if(!empty($this->request->getSession()->read('Auth.User.id'))) {
            $this->viewBuilder()->setLayout('student_account');
        }
        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
        }
    }
}
