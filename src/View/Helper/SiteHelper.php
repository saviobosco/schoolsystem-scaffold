<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 4/21/16
 * Time: 10:50 PM
 */

namespace App\View\Helper;


use Cake\View\Helper\HtmlHelper;
/**
 * Site helper
 * @property \Cake\View\Helper\HtmlHelper $Html
 * @property \Cake\View\Helper\FormHelper $Form
 */
class SiteHelper extends HtmlHelper
{
    var $helpers = ['Url', 'Text','Form'];

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

    public function datePickerInput($name,$options = [])
    {
        $options = $options + [
                'data-type' => 'datepicker-autoClose',
                'type' => 'text',
                'templates'=>[
                    'label' => '',
                    'inputContainer' => '<div class=" col-12-6 m-b-15 input-group {{type}}{{required}}">  {{content}} <span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>',
                    'input' => '<input class="form-control" type="{{type}}" name="{{name}}"{{attrs}}/>'
                ]
            ];
        return
            $this->Form->label($name) . // Joining both of them
            $this->Form->control($name,$options);
    }


}