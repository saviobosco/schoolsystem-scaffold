<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 4/21/16
 * Time: 10:50 PM
 */

namespace App\View\Helper;


use Cake\View\Helper\HtmlHelper;

class PluginsHelper extends HtmlHelper
{
    var $helpers = ['Url', 'Text'];

    /**
     * @param array|string $path
     * @param array $options
     * @return null|string
     */
    public function css($path, array $options = [])
    {
        $options += ['pathPrefix' => 'assets/plugins/' ];
        return parent::css($path , $options);
    }

    /**
     * @param array|string $path
     * @param array $options
     * @return null|string
     */
    public function script($path , array $options = [])
    {
        $options += ['pathPrefix' => 'assets/plugins/' ];
        return parent::script($path , $options);
    }



}