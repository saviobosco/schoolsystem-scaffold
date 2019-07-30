<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 1/30/18
 * Time: 10:48 AM
 */

namespace TestCase\Controller\Component;

use Cake\TestSuite\TestCase;
use ResultSystem\Controller\Component\ResultSystemComponent;
use Cake\Controller\ComponentRegistry;

/**
 * Class ResultSystemComponentTest
 * @package TestCase\Controller\Component
 */
class ResultSystemComponentTest extends TestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.result_system.subjects',
        'plugin.result_system.classes',
    ];

    public $component = null;
    public $controller = null;

    public function setUp()
    {
        parent::setUp();
        // Setup our component and fake test controller
        $this->controller = $this->getMockBuilder('Cake\Controller\Controller')
            ->setMethods(null)
            ->getMock();
        $registry = new ComponentRegistry($this->controller);
        $this->component = new ResultSystemComponent($registry);
    }

    public function testFormatArrayData()
    {
        $passedData = [
            0 => [
                'student_id' => '001',
                'English' => 6,
                'Mathematics' => 8
            ],
            1 => [
                'student_id' => '003',
                'English' => 4,
                'Mathematics' => 10
            ]
        ];
        $expected = [
            'students_data' => [
                0 => [
                    'student_id' => '001',
                    'subject_id' => 1,
                    'first_test' => 6,
                    'class_id' => '1',
                    'term_id' => '1',
                    'session_id' => '1'
                ],
                1 => [
                    'student_id' => '001',
                    'subject_id' => 2,
                    'first_test' => 8,
                    'class_id' => '1',
                    'term_id' => '1',
                    'session_id' => '1'
                ],
                2 => [
                    'student_id' => '003',
                    'subject_id' => 1,
                    'first_test' => 4,
                    'class_id' => '1',
                    'term_id' => '1',
                    'session_id' => '1'
                ],
                3 => [
                    'student_id' => '003',
                    'subject_id' => 2,
                    'first_test' => 10,
                    'class_id' => '1',
                    'term_id' => '1',
                    'session_id' => '1'
                ]
            ]
        ];
        $this->assertEquals($expected,$this->component->formatArrayData($passedData,'first_test',1,1,1));
    }

    public function testProcessSubmittedResults()
    {
        $postData = [
            15 => [
                'first_test' => '66',
                'second_test' => '66',
                'third_test' => '66',
                'exam' => '66',
                'student_id' => '001',
                'subject_id' => '1',
                'class_id' => '1',
                'term_id' => '1',
                'session_id' => '1'
            ],
            16 => [
                'first_test' => '',
                'second_test' => '',
                'third_test' => '',
                'exam' => '',
                'student_id' => '001',
                'subject_id' => '1',
                'class_id' => '1',
                'term_id' => '1',
                'session_id' => '1'
            ]
        ];
        $grade = [
            'first_test' => 'In House Assesment (10%)',
            'second_test' => 'Hosue Assesment (10%)',
            'third_test' => 'Third Test (10%)',
            'exam' => 'Examination (60%)'
        ];
        $expected = [
            15 => [
                'first_test' => '66',
                'second_test' => '66',
                'third_test' => '66',
                'exam' => '66',
                'student_id' => '001',
                'subject_id' => '1',
                'class_id' => '1',
                'term_id' => '1',
                'session_id' => '1'
            ]
        ];
        $this->assertEquals($expected,$this->component->processSubmittedResults($postData,$grade));
    }

    public function testProcessSubmittedResultsWithNullPassed()
    {
        $grade = [
            'first_test' => 'In House Assesment (10%)',
            'second_test' => 'Hosue Assesment (10%)',
            'third_test' => 'Third Test (10%)',
            'exam' => 'Examination (60%)'
        ];
        $this->assertEquals([],$this->component->processSubmittedResults( null,$grade));
    }
}