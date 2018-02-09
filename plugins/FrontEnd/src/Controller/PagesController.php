<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/14/17
 * Time: 9:40 AM
 */

namespace FrontEnd\Controller;


use Cake\Event\Event;

class PagesController extends AppController
{
    public function beforeFilter(Event $event) {
        $this->Auth->allow(['homepage']);
    }


    public function homepage() {
        $this->set(compact('title'));
    }

}