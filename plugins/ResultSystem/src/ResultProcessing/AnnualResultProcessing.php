<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/26/16
 * Time: 3:38 PM
 */

namespace ResultSystem\ResultProcessing;

use Cake\ORM\TableRegistry;
use ResultSystem\Model\Entity\GradeableTrait;
use Cake\I18n\Number;

class AnnualResultProcessing
{
    use GradeableTrait;

    /**
     * @var bool
     *  This status indicates the status of the processor
     */
    protected $status = false;


    public function __construct($class_id,$session_id)
    {
        $this->calculateAnnualTotals($class_id,$session_id);
        $this->inputTotalInAnnualPositionTable($class_id,$session_id);
        $this->calculateStudentAnnualSubjectPosition($class_id,$session_id);
        // sets the status of the processor as true
        $this->_setStatus();
    }

    /**
     * @param $value
     * @return int|string
     * The precision function is used to determine the decimal precision
     * of a Number eg . 70.555666 converted to 70.55.
     * This function uses the Number::precision static method .
     */
    protected function _determineNumberPrecision($value)
    {
        if ( !is_float($value) ) {
            return (int)$value;
        }
        return Number::precision($value,2);
    }


    /**
     * @param $class_id
     * @param $session_id
     */
    public function calculateAnnualTotals($class_id,$session_id)
    {
        // Initialize the required tables
        $studentTable = TableRegistry::get('ResultSystem.Students');
        $classTable   = TableRegistry::get('ResultSystem.Classes');
        $subjectTable = TableRegistry::get('ResultSystem.Subjects');
        $annualResultTable = TableRegistry::get('ResultSystem.StudentAnnualResults');


        // loads the grade and remark table
        $resultGradingTable = TableRegistry::get('GradingSystem.ResultGradingSystems');
        // gets the grade from the table
        $grades = $resultGradingTable->find('all')->combine('score','grade')->toArray();

        // gets the remark from the table .
        $remarks = $resultGradingTable->find('all')->combine('grade','remark')->toArray();
        // loads the class Details .
        $classDetail = $classTable->find('all')->where(['id' => $class_id])->first();
        // selects all the subjects from the subject table...
        $subjects = $subjectTable->find('all')->where(['block_id' => $classDetail['block_id']])->toArray();
        // finds all students in the students table using the class_id
        $studentsInAClass = $studentTable->find('all')
            ->where([
                'class_id' => $class_id
            ])->toArray();
        // This first loop , loops through the students
        // to select each student .
        foreach ( $studentsInAClass as $studentInAClass ) {
            // this second loop, loops through the subjects offered by a particular
            // student. it selects the first term, second term and third term scores ,
            // sums them and calculates the average.
            foreach ( $subjects as $subject ) {
                $studentTermlyTotalForSubjectInAllTerm = $annualResultTable->find('all')
                    ->where(['student_id' => $studentInAClass['id'],
                        'subject_id' => $subject['id'],
                        'class_id'   => $class_id,
                        'session_id' => $session_id
                    ])->toArray();
                // loops through the first term , second term and third term results and sums them
                // up.
                foreach ($studentTermlyTotalForSubjectInAllTerm as $studentAnnualTotalForASubject ) {
                    // set the total index in the array
                    // the total is first term + second term + third term
                    $studentAnnualTotalForASubject['total'] = $studentAnnualTotalForASubject['first_term'] +
                        $studentAnnualTotalForASubject['second_term'] + $studentAnnualTotalForASubject['third_term'];
                    $studentAnnualTotalForASubject['average'] = $this->_determineNumberPrecision( $studentAnnualTotalForASubject['total'] / 3) ;
                    // calculates the grade
                    $studentAnnualTotalForASubject['grade'] = $this->calculateGrade($studentAnnualTotalForASubject['average'], $grades);
                    // calculate the remark
                    $studentAnnualTotalForASubject['remark'] = $remarks[$studentAnnualTotalForASubject['grade']];
                    $annualResultTable->save($studentAnnualTotalForASubject);
                }
            }
        }
    }

    /**
     * @param $class_id
     * @param $session_id
     */
    public function inputTotalInAnnualPositionTable($class_id,$session_id)
    {
        // Initialize the required tables
        $studentTable = TableRegistry::get('ResultSystem.Students');
        $annualResultTable = TableRegistry::get('ResultSystem.StudentAnnualResults');
        $annualPositionTable = TableRegistry::get('ResultSystem.StudentAnnualPositions');
        // loads the grade and remark table
        $resultGradingTable = TableRegistry::get('GradingSystem.ResultGradingSystems');
        // gets the grade from the table
        $grades = $resultGradingTable->find('all')->combine('score','grade')->toArray();
        // gets the remark from the table .
        $remarks = $resultGradingTable->find('all')->combine('grade','remark')->toArray();

        $studentsInAClass = $studentTable->find('all')
            ->where(['class_id' => $class_id])->toArray();

        foreach ( $studentsInAClass as $studentInAClass ) {
            $studentTermlyTotalForSubjectInAllTerm = $annualResultTable->find('all')
                ->where(['student_id' => $studentInAClass['id'],
                    'class_id'   => $class_id,
                    'session_id' => $session_id
                ])->toArray();

            // Check if the student has any subject result
            // else break the current loop and continue to prevent error .
            if ( count($studentTermlyTotalForSubjectInAllTerm) <= 0 ) {
                continue;
            }
            // This value contains the sum of the subject totals
            $sumOfSubjectTotal = 0;
            $sumOfSubjectAverage = 0;
            foreach ($studentTermlyTotalForSubjectInAllTerm as $studentAnnualTotalInASubject) {

                $sumOfSubjectTotal += $studentAnnualTotalInASubject['total'];
            }
            // to calculate the subject Annual Average , You will add all the subjects averages
            // and divide by the number of the offered subjects
            foreach ($studentTermlyTotalForSubjectInAllTerm as $studentAnnualTotalInASubject) {
                $sumOfSubjectAverage += $studentAnnualTotalInASubject['average'];
            }
            $count = count($studentTermlyTotalForSubjectInAllTerm);
            $subjectAverage = $this->_determineNumberPrecision($sumOfSubjectAverage / $count);
            $studentDetailsInAnnualPositionTable = $annualPositionTable->findOrCreate(['student_id' => $studentInAClass['id'],
                    'class_id'    => $class_id,
                    'session_id' => $session_id
                ]);

            $newData = ['student_id' => $studentInAClass['id'],
                'total'      => $sumOfSubjectTotal,
                'average'    => $subjectAverage,
                'grade'     => $remarks[$this->calculateGrade($subjectAverage,$grades)],
                'class_id'  => $class_id,
                'session_id' => $session_id
            ];
            $studentDetailsInAnnualPositionTable = $annualPositionTable->patchEntity($studentDetailsInAnnualPositionTable,$newData);
            $annualPositionTable->save($studentDetailsInAnnualPositionTable);
        }
        // This function is used to calculate the student positions
        $this->calculateAnnualPosition($class_id,$session_id);
    }

    public function calculateAnnualPosition($class_id,$session_id)
    {
        // Initializes the All required tables
        $annualPositionTable = TableRegistry::get('ResultSystem.StudentAnnualPositions');
        $students = $annualPositionTable->find('all')->where(['class_id'=>$class_id,
            'session_id' => $session_id
        ])->order(['total'=>'DESC'])->groupBy('total')->toArray();
        $position = 1;
        foreach ($students as $key => $value ) {
            foreach($value as $student) {
                $student['position'] = $position ;
                $annualPositionTable->save($student);
            }
            // Increment the position variable .
            $position++;
        }
        return true;
    }

    public function calculateStudentAnnualSubjectPosition($class_id,$session_id)
    {
        //Initialize all required Tables
        $classTable = TableRegistry::get('ResultSystem.Classes');
        $subjectTable = TableRegistry::get('ResultSystem.Subjects');
        $annualResultTable = TableRegistry::get('ResultSystem.StudentAnnualResults');
        $annualSubjectPositionTable = TableRegistry::get('ResultSystem.StudentAnnualSubjectPositions');
        // find the block the class_id is under. Either junior or senior
        $classDetail = $classTable->find('all')->where(['id'=>$class_id])->first();
        // The block id is used to get all subjects belonging to a particular block
        $block_id = $classDetail['block_id'];
        $subjects = $subjectTable->find('all')->where(['block_id'=>$block_id])->toArray();
        // loops through each particular subject
        // and find the students under that course for each particular class,
        // term and session .
        foreach ( $subjects as $subject ) {
            $studentsStudyingTheSubject = $annualResultTable->find('all')->where([
                'subject_id' => $subject['id'],
                'class_id' => $class_id,
                'session_id' => $session_id
            ])->order(['total'=>'DESC'])->groupBy('total')->toArray();
            $position = 1;
            foreach ( $studentsStudyingTheSubject as $key => $value ) {
                foreach ( $value as $studentStudyingTheSubject ) {
                    $studentSubjectPosition = $annualSubjectPositionTable->findOrCreate([
                        'student_id' => $studentStudyingTheSubject['student_id'],
                        'subject_id' => $studentStudyingTheSubject['subject_id'],
                        'class_id'   => $class_id,
                        'session_id' => $session_id
                    ]);
                    $newData = [
                        'total'      => $studentStudyingTheSubject['total'],
                        'position'   => $position,
                    ];
                    $studentSubjectPosition = $annualSubjectPositionTable->patchEntity($studentSubjectPosition,$newData);
                    $annualSubjectPositionTable->save($studentSubjectPosition);
                }
                // increment the position variable
                $position++;
            }
        }
        return true;
    }


    public function calculateAnnualPositionBasedOnClassDemarcation($class_id,$session_id)
    {
        // Initializes the required tables
        $studentTable = TableRegistry::get('ResultSystem.Students');
        $classDemarcationTable = TableRegistry::get('ResultSystem.ClassDemarcations');
        $annualPositionTable = TableRegistry::get('ResultSystem.StudentAnnualPositions');
        $annualPositionOnClassDemarcationTable = TableRegistry::get('ResultSystem.StudentAnnualPositionOnClassDemarcations');
        $classDemarcations = $classDemarcationTable->find('all')->where(['class_id' => $class_id])->toArray();
        // loops through each class demarcations
        // and inputs the total of each students under a particular class demarcation
        // using the class_id passed value .
        foreach ( $classDemarcations as $classDemarcation ) {

            $studentsInEachClassDemarcation = $studentTable->find('all')->where([
                'class_demarcation_id' => $classDemarcation['id'],
            ])->toArray();
            // This foreach expression is used to input the total from the annualPositionTable into the annualPositionBasedOnClassDemarcation
            foreach ( $studentsInEachClassDemarcation as $studentInClassDemarcation ) {
                $studentDetailsInAnnualPositionTable = $annualPositionTable->find('all')->where([
                    'student_id' => $studentInClassDemarcation['id'],
                    'class_id'   => $class_id,
                    'session_id' => $session_id
                ])->first();
                // Check if the student has any data in annual the annual position table
                // if no data break the current loop and continue
                if ($studentDetailsInAnnualPositionTable == null ) {
                    continue;
                }
                // Input the collected details in the annual position on class demarcation table
                $studentDetailsInAnnualPositionOnClassDemarcationTable = $annualPositionOnClassDemarcationTable->findOrCreate([
                    'student_id' => $studentDetailsInAnnualPositionTable['student_id'],
                    'class_id'  => $class_id,
                    'class_demarcation_id' => $classDemarcation['id'],
                    'session_id' => $session_id
                ]);
                $newData = ['student_id' => $studentDetailsInAnnualPositionTable['student_id'],
                    'total'      => $studentDetailsInAnnualPositionTable['total'],
                    'average'   => $studentDetailsInAnnualPositionTable['average'],
                    'class_id' => $class_id,
                    'class_demarcation_id' => $classDemarcation['id'],
                    'session_id' => $session_id
                ];
                $studentDetailsInAnnualPositionOnClassDemarcationTable = $annualPositionOnClassDemarcationTable->patchEntity($studentDetailsInAnnualPositionOnClassDemarcationTable,$newData);
                $annualPositionOnClassDemarcationTable->save($studentDetailsInAnnualPositionOnClassDemarcationTable );
            }
        }
        // calculates the positions of each students in each class demarcations based on the total
        foreach ( $classDemarcations as $classDemarcation ) {
            $studentsInEachClassDemarcation = $annualPositionOnClassDemarcationTable->find('all')->where([
                'class_id' => $class_id,
                'class_demarcation_id' => $classDemarcation['id'],
                'session_id'         => $session_id
            ])->orderDesc('total')->toArray();
            $position = 1;
            foreach ( $studentsInEachClassDemarcation as $key => $value ) {
                foreach ( $value as $studentInClassDemarcation ) {
                    $studentInClassDemarcation['position'] = $position ;
                    $annualPositionOnClassDemarcationTable->save($studentInClassDemarcation);
                }
                $position++;
            }
        }
        return true;
    }


    public function calculateAnnualSubjectPositionOnClassDemarcation( $class_id,$session_id )
    {
        //Initialize all required Tables
        $classTable = TableRegistry::get('ResultSystem.Classes');
        $subjectTable = TableRegistry::get('ResultSystem.Subjects');
        $studentTable = TableRegistry::get('ResultSystem.Students');
        $classDemarcationTable = TableRegistry::get('ResultSystem.ClassDemarcations');
        $annualSubjectPositionTable = TableRegistry::get('ResultSystem.StudentAnnualSubjectPositions');
        $annualSubjectPositionOnClassDemarcationTable = TableRegistry::get('ResultSystem.StudentAnnualSubjectPositionOnClassDemarcations');

        // find the block the class_id is under. Either junior or senior
        $classDetail = $classTable->find('all')->where(['id'=>$class_id])->first();
        $block_id = $classDetail['block_id'];
        // find all the subjects studied by that class using the block id.
        $subjects = $subjectTable->find('all')->where(['block_id'=>$block_id])->toArray();
        $classDemarcations = $classDemarcationTable->find('all')->where(['class_id' => $class_id])->toArray();
        // calculates the students in each class demarcation and categories with the different subjects.
        foreach ( $classDemarcations as $classDemarcation ) {
            $studentsInEachClassDemarcation = $studentTable->find('all')->where([
                'class_demarcation_id' => $classDemarcation['id'],
            ])->toArray();
            // This foreach expression is used to input the total from the annualPositionTable into the annualPositionBasedOnClassDemarcation
            foreach ( $studentsInEachClassDemarcation as $studentInClassDemarcation ) {
                foreach ($subjects as $subject ) {
                    $studentSubjectDetailInAnnualSubjectPositionTable = $annualSubjectPositionTable->find('all')->where([
                        'student_id' => $studentInClassDemarcation['id'],
                        'subject_id' => $subject['id'],
                        'class_id'   => $class_id,
                        'session_id' => $session_id
                    ])->toArray();
                    // if the student has not record for a particular subject
                    // break the current loop and continue
                    if (count($studentSubjectDetailInAnnualSubjectPositionTable) <= 0 ) {
                        continue;
                    }
                    // Building the data to Enter into the termlySubjectPositionOnClassDemarcationTable
                    // first is to check if the data exists in the table using the
                    // $student_id , $subject_id , $class_id , $term_id, $session_id

                    $studentSubjectDetailInAnnualSubjectPositionOnClassDemarcationTable = $annualSubjectPositionOnClassDemarcationTable->findOrCreate([
                            'student_id' => $studentInClassDemarcation['id'],
                            'subject_id' => $subject['id'],
                            'class_id'   => $class_id,
                            'class_demarcation_id' => $classDemarcation['id'],
                            'session_id' => $session_id
                        ]);
                    $newData = ['student_id' => $studentInClassDemarcation['id'],
                        'subject_id' => $subject['id'],
                        'total'      => $studentSubjectDetailInAnnualSubjectPositionTable[0]['total'],
                        'class_id'   => $class_id,
                        'class_demarcation_id' => $classDemarcation['id'],
                        'session_id' => $session_id
                    ];
                    $studentSubjectDetailInAnnualSubjectPositionOnClassDemarcationTable = $annualSubjectPositionOnClassDemarcationTable->patchEntity($studentSubjectDetailInAnnualSubjectPositionOnClassDemarcationTable,$newData);
                    $annualSubjectPositionOnClassDemarcationTable->save($studentSubjectDetailInAnnualSubjectPositionOnClassDemarcationTable);
                }
            }
        }
        // Calculate the students positions in a particular subject under a particular class demarcation .
        foreach ($subjects as $subject ) {
            // get the students in a subject under a particular class demarcation
            //$this->hr();
            foreach ( $classDemarcations as $classDemarcation ) {
                $studentsUnderTheSubjectInClassDemarcation = $annualSubjectPositionOnClassDemarcationTable->find('all')
                    ->where(['subject_id' => $subject['id'],
                        'class_demarcation_id' => $classDemarcation['id'],
                        'class_id'            => $class_id,
                        'session_id'         => $session_id
                    ])->orderDesc('total')->toArray();
                $position = 1;
                foreach ( $studentsUnderTheSubjectInClassDemarcation as $key => $value ) {
                    foreach ($value as $studentUnderTheSubjectInClassDemarcation ) {
                        $studentUnderTheSubjectInClassDemarcation['position'] = $position ;
                        $annualSubjectPositionOnClassDemarcationTable->save($studentUnderTheSubjectInClassDemarcation);
                    }
                    $position++;
                }
            }
        }
        return true;
    }

    protected function _setStatus()
    {
        $this->status = true;
    }

    public function getStatus()
    {
        return $this->status;
    }

}