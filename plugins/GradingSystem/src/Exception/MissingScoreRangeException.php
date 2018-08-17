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
    protected $_messageTemplate = 'Seems that the score range for %d is missing.';
}