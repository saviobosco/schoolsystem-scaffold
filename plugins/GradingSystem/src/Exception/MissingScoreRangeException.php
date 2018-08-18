<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 8/17/18
 * Time: 12:35 PM
 */

namespace GradingSystem\Exception;


use Cake\Core\Exception\Exception;

class MissingScoreRangeException extends Exception
{
    protected $_messageTemplate = 'Seems the Score Range for <strong>%d</strong> is Missing.';
}