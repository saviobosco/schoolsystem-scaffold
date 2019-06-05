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
        $this->loadComponent('Auth', [
            'loginAction' => [
                'plugin' => 'StudentAccount',
                'controller' => 'Login',
                'action' => 'index'
            ],
            'loginRedirect' => [
                'plugin' => 'StudentAccount',
                'controller' => 'Dashboard',
                'action' => 'index'
            ],
            'unauthorizedRedirect' => [
                'plugin' => 'StudentAccount',
                'controller' => 'Login',
                'action' => 'index'
            ]
        ]);
    }

    public function beforeFilter(Event $event)
    {
        if(!empty($this->request->getSession()->read('Auth.User.id'))) {
            return $this->viewBuilder()->setTheme('SeanTheme')->setLayout('student_account');
        }
        return $this->viewBuilder()->setTheme('SeanTheme')->setLayout('custom');
    }
}
