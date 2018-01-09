<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 7/16/17
 * Time: 11:48 AM
 */

namespace TestCase\View\Helper;


use App\View\Helper\SearchParameterHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * Class SearchParameterHelperTest
 * @package TestCase\View\Helper
 * @property \App\View\Helper\SearchParameterHelper $helper
 */
class SearchParameterHelperTest extends TestCase
{
    public $helper = null;

    // Here we instantiate our helper
    public function setUp()
    {
        parent::setUp();
        $View = new View();
        $this->helper = new SearchParameterHelper($View);
    }

    public function testGetDefaultValue()
    {
        $this->assertEquals(1, $this->helper->getDefaultValue(null,1));
        $this->assertEquals(3, $this->helper->getDefaultValue(3,1));
    }

}