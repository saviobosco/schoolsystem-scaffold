<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\SchoolAssetHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\SchoolAssetHelper Test Case
 */
class SchoolAssetHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\SchoolAssetHelper
     */
    public $SchoolAsset;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->SchoolAsset = new SchoolAssetHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SchoolAsset);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
