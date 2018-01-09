<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/3/17
 * Time: 12:00 PM
 */

namespace App\View\Helper;


use Cake\View\Helper\HtmlHelper;

class LoggedInHelper extends HtmlHelper
{
    var $helpers = ['Url', 'Text'];
    /**
     * @param array|string $path
     * @param array $options
     * @return null|string
     */
    public function css($path, array $options = [])
    {
        $options += ['pathPrefix' =>'assets/loggedIn/css/' ];
        return parent::css($path , $options);
    }

    /**
     * @param array|string $path
     * @param array $options
     * @return null|string
     */
    public function script($path , array $options = [])
    {
        $options += ['pathPrefix' => 'assets/loggedIn/js/' ];
        return parent::script($path , $options);
    }

}