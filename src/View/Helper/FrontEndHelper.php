<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/19/17
 * Time: 12:00 PM
 *
 * This file is used to include the Frontend Css and Script file and
 * every other file required to render the front End..
 */

namespace App\View\Helper;


use Cake\View\Helper\HtmlHelper;

class FrontEndHelper extends HtmlHelper
{
    var $helpers = ['Url', 'Text'];

    /**
     * @param array|string $path
     * @param array $options
     * @return null|string
     */
    public function css($path, array $options = [])
    {
        $options += ['pathPrefix' => 'assets/frontEnd/css/' ];
        return parent::css($path , $options);
    }

    /**
     * @param array|string $path
     * @param array $options
     * @return null|string
     */
    public function script($path , array $options = [])
    {
        $options += ['pathPrefix' => 'assets/frontEnd/js/' ];
        return parent::script($path , $options);
    }


}