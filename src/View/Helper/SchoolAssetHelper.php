<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Settings\Core\Setting;

/**
 * SchoolAsset helper
 * @property $Html
 */
class SchoolAssetHelper extends Helper
{
    public $helpers = ['Html'];

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function getSchoolLogo()
    {
        if (Setting::check('Application.school_logo')) {
            return $this->Html->image(Setting::read('Application.school_logo'));
        }
        return '';
    }

    public function getSchoolBanner()
    {
        if (Setting::check('Application.image_banner')) {
            return $this->Html->image(Setting::read('Application.image_banner'), ['class' => 'img-responsive']);
        }
        return '';
    }

}
