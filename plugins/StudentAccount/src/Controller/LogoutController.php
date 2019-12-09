<?php
namespace StudentAccount\Controller;

use StudentAccount\Controller\AppController;

/**
 * LogoutController Controller
 *
 */
class LogoutController extends AppController
{
    public function index()
    {
        return $this->redirect($this->Auth->logout());
    }
}
