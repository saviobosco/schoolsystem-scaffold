<?php
/**
 *
 */
namespace UsersManager\Exception;

use Cake\Core\Exception\Exception;



class UserExistsException extends Exception
{
    protected $_messageTemplate = 'The user with username %s exists.';
}
