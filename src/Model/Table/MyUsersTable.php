<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/5/16
 * Time: 5:54 PM
 */

namespace App\Model\Table;


use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use CakeDC\Users\Model\Table\UsersTable;

class MyUsersTable extends UsersTable
{

    public function initialize(array $config)
    {
        parent::initialize($config);


    }


}