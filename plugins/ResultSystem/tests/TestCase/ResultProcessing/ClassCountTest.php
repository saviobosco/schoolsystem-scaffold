<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 8/18/18
 * Time: 1:11 PM
 */

namespace TestCase\ResultProcessing;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestCase;
use ResultSystem\ResultProcessing\ClassCount;

class ClassCountTest extends IntegrationTestCase
{
    /**
     * Test subject
     *
     * @var \ResultSystem\ResultProcessing\ClassCount
     */
    public $classCount ;
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.students',
        'plugin.result_system.sessions',
        'plugin.result_system.classes',
        'plugin.result_system.terms',
        'plugin.result_system.student_class_counts',
    ];

    public function setUp()
    {
        parent::setUp();
        $this->classCount = new ClassCount();
    }

    public function tearDown()
    {
        unset($this->classCount);
        parent::tearDown();
    }

    /** @test */
    public function testGetStudentNumberInClasses()
    {
        $this->classCount->getStudentNumberInClasses(1, 1, 1);
        $classCountTable = TableRegistry::get('ResultSystem.StudentClassCounts');
        $classCounts = $classCountTable->find()->combine('class_id','student_count')->toArray();
        $this->assertEquals(3, $classCounts[1]);
    }

}