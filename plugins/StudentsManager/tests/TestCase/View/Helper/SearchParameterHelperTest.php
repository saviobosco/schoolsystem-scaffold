<?php
namespace StudentsManager\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use StudentsManager\View\Helper\SearchParameterHelper;

/**
 * StudentsManager\View\Helper\SearchParameterHelper Test Case
 */
class SearchParameterHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \StudentsManager\View\Helper\SearchParameterHelper
     */
    public $SearchParameter;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->SearchParameter = new SearchParameterHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SearchParameter);

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
