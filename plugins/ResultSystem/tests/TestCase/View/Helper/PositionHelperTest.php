<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 7/16/17
 * Time: 12:48 PM
 */

namespace TestCase\View\Helper;


use Cake\TestSuite\TestCase;
use Cake\View\View;
use ResultSystem\View\Helper\PositionHelper;

/**
 * Class PositionHelperTest
 * @package TestCase\View\Helper
 * @property \ResultSystem\View\Helper\PositionHelper $helper
 */
class PositionHelperTest extends TestCase
{
    public $helper = null;

    public function setUp()
    {
        parent::setUp();
        $View = new View();
        $this->helper = new PositionHelper($View);
    }

    public function testFormatPositionOutput()
    {
        $this->assertEquals('1st',$this->helper->formatPositionOutput(1));
        $this->assertEquals('2nd',$this->helper->formatPositionOutput(2));
        $this->assertEquals('3rd',$this->helper->formatPositionOutput(3));
        $this->assertEquals('21st',$this->helper->formatPositionOutput(21));
        $this->assertEquals('24th',$this->helper->formatPositionOutput(24));
        $this->assertEquals('4th',$this->helper->formatPositionOutput(4));
        $this->assertEquals('11th',$this->helper->formatPositionOutput(11));
        $this->assertEquals('112th',$this->helper->formatPositionOutput(112));
        $this->assertEquals('213th',$this->helper->formatPositionOutput(213));
    }

}