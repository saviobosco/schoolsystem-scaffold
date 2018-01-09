<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/5/16
 * Time: 5:55 PM
 */

namespace App\Model\Entity;


use CakeDC\Users\Model\Entity\User;

class MyUser extends User
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'is_superuser' => true,
        'role' => true,
    ];

    protected function _getFullName() {
        return $this->_properties['first_name'].' '.$this->_properties['last_name'];
    }

}