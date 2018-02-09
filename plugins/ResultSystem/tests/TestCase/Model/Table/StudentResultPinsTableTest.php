<?php
namespace ResultSystem\Test\TestCase\Model\Table;

use Cake\Event\EventList;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ResultSystem\Model\Table\StudentResultPinsTable;

/**
 * ResultSystem\Model\Table\StudentResultPinsTable Test Case
 */
class StudentResultPinsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ResultSystem\Model\Table\StudentResultPinsTable
     */
    public $StudentResultPins;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.student_result_pins',
        'plugin.result_system.students',
        'plugin.result_system.sessions',
        'plugin.result_system.classes',
        'plugin.result_system.terms',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StudentResultPins') ? [] : ['className' => 'ResultSystem\Model\Table\StudentResultPinsTable'];
        $this->StudentResultPins = TableRegistry::get('StudentResultPins', $config);
        $this->StudentResultPins->eventManager()->setEventList(new EventList());
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentResultPins);

        parent::tearDown();
    }

    /**
     * Test savePin method
     *
     * @return void
     */
    public function testSavePin()
    {
        $postData = [
            'number_to_generate' => 1,
            'save_to_database' => 1
        ];
        $this->assertEquals(1,$this->StudentResultPins->savePins($postData));
        $this->assertEventFired('Model.afterSave', $this->StudentResultPins->getEventManager());
    }

    /**
     * Test checkPin method
     *
     * @return void
     */
    public function testCheckPin()
    {
        $this->assertInstanceOf(Entity::class,$this->StudentResultPins->checkPin(123456));
    }

    /**
     * Test updateStudentPin method
     *
     * @return void
     */
    public function testUpdateStudentPin()
    {
        $pin = $this->StudentResultPins->get(123456);
        $this->assertEquals(true,$this->StudentResultPins->updateStudentPin($pin,'001',1,1,1));
    }
}
