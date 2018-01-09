<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/6/17
 * Time: 10:56 AM
 */

namespace App\Controller\Component;


use Cake\Controller\Component;

class SavioboscoFlashComponent extends Component
{
    public function message($message,array $options = []) {
        if (empty($options['class'])) {
            $class = 'alert-info';
        } else {
            $class = $options['class'];
        }
        return "<div class='alert {$class}' >".$this->getFaIcon($options['class']).' '. $message .' <span class="close" data-dismiss="alert">x</span></div>';
    }

    protected function getFaIcon($class)
    {
        switch ($class) {
            case 'alert-success':
                return '<i class="fa fa-check-circle"></i>';
            break;
            case 'alert-danger':
                return '<i class="fa fa-exclamation-triangle"></i>';
            break;
            case 'alert-warning':
                return '<i class="fa-exclamation-circle"></i>';
            break;
            case 'alert-info':
                return '<i class="fa fa-exclamation"></i>';
            break;
            default:
                return '';
        }
    }

}