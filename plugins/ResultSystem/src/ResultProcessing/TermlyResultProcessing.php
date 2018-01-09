<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/26/16
 * Time: 12:10 AM
 */

namespace ResultSystem\ResultProcessing;

use Cake\ORM\TableRegistry;
//use Queue\Shell\Task\QueueTask;
use GradingSystem\Model\Table\ResultGradingSystemsTable;
use ResultSystem\Model\Entity\GradeableTrait;
use Cake\I18n\Number;

/**
 * Class TermlyResultProcessing
 * @package ResultSystem\ResultProcessing
 *
 */
class TermlyResultProcessing
{
    use GradeableTrait;
    /**
     * @var bool
     *  This status indicates the status of the processor
     */
    protected $status = false;


    public function __construct()
    {
        // sets the status of the processor as true
        $this->_setStatus();
    }

    protected function _determineNumberPrecision($value)
    {
        if ( !is_float($value) ) {
            return (int)$value;
        }
        return Number::precision($value,2);
    }

    /**
     * @param $class_id
     * @param $term_id
     * @param $session_id
     * @param $no_of_subjects
     * @return mixed
     *  This function calculate the total result of a student for a particular
     * term. It collects the result data of each subject offered by a student
     * from the student_termly_results table , sums it and divides the sum by the
     *number of subjects offered to get the average.
     * Then it enters the total and average into the student_termly_positions table
     *for further processing .
     */
    public function calculateTermlyTotalAndAverage($class_id,$term_id,$session_id,$no_of_subjects)
    {
        $returnData = []; // this is the return value
        // Initializes the All required tables
        $studentTable = TableRegistry::get('App.Students')->find('all');
        $termlyResultTable = TableRegistry::get('StudentTermlyResults');
        $termlyPositionTable = TableRegistry::get('StudentTermlyPositions');

        // loads the grade and remark table
        $resultGradingTable = TableRegistry::get('GradingSystem.ResultGradingSystems');

        // gets the grade from the Grade table
        $grades = $resultGradingTable->getGrades();

        // gets the remark from the table .
        $remarks = $resultGradingTable->find('all')->combine('grade','remark')->toArray();

        $students = $studentTable->where(['class_id' => $class_id ,'session_id'=>$session_id])->toArray();

        // iterates through the student Array sets
        foreach ($students as $student ) {
            // gets the student subject
            $subjects = $termlyResultTable->find('all')->where(['student_id'=>$student->id,
                'class_id'=>$class_id,
                'term_id' => $term_id,
                'session_id' => $session_id
            ])->toArray();
            // gets the subject count used to check a student has any subject result
            $subjectCount = count($subjects);

            /* Check if the Student has any subject result for that year
               If the student does not have , continue with the next student
            */

            if ( $subjectCount <= 0 ) {
                continue;
            }

            // check if the student subjects is greater that the supplied $no_of_students
            if ( $subjectCount > $no_of_subjects) {
                $studentId = $student['id'];
                $returnData['subjectCountIssues'][] = ["Student with admission number $studentId has $subjectCount subjects. "];
                unset($studentId);
            }
            // initializes the sum variable .
            $sum = 0 ;
            for ($num = 0; $num < $subjectCount ; $num++ ) {
                $sum += $subjects[$num]['total'] ;
            }
            // Calculating average
            $average = $this->_determineNumberPrecision($sum / $no_of_subjects ) ;

            // check to know if the record already exists in the table .
            $studentTotal = $termlyPositionTable->find('all')->where(['student_id' => $student->id,
                'class_id' => $class_id,
                'term_id' => $term_id,
                'session_id' => $session_id
            ])->first();

            // if the record does not exist , Create a new record
            if ($studentTotal == null ) {
                $studentTotal = $termlyPositionTable->newEntity(['student_id' => $student->id,
                    'total' => $sum ,
                    'average' => $average,
                    'grade'   => $remarks[$this->calculateGrade($average,$grades)],
                    'class_id' => $class_id,
                    'term_id' => $term_id,
                    'session_id' => $session_id]);
            } else {
                // else update the existing record
                $newData = ['student_id' => $student->id,
                    'total' => $sum ,
                    'average' => $average,
                    'grade'   => $remarks[$this->calculateGrade($average,$grades)],
                    'class_id' => $class_id,
                    'term_id' => $term_id,
                    'session_id' => $session_id];

                $studentTotal = $termlyPositionTable->patchEntity($studentTotal,$newData);
            }

            // save the record to database
            if ($termlyPositionTable->save($studentTotal) ) {
            }
        }
        return $returnData;
    }

    /**
     * @param $class_id
     * @param $term_id
     * @param $session_id
     * @return bool
     *  This function calculates the positions of the student .
     * It selects the students in DESC order and grouped by total .
     * Then the data is looped through entering the records according into the
     * the database . Example if two students has the same total score , they will
     * have the same position.
     */
    public function calculateTermlyPosition($class_id,$term_id,$session_id)
    {
        // Initializes the All required tables
        $termlyPositionTable = TableRegistry::get('StudentTermlyPositions');

        $students = $termlyPositionTable->find('all')->where(['class_id'=>$class_id,
            'term_id' => $term_id,
            'session_id' => $session_id
        ])->orderDesc('total')->groupBy('total')->toArray();

        $position = 1;
        foreach ($students as $key => $value ) {

            foreach($value as $student ) {
                $student['position'] = $position ;

                $termlyPositionTable->save($student);
            }

            // Increment the position variable .
            $position++;
        }
        return true;
    }

    public function calculateStudentTermlySubjectPosition($class_id,$term_id,$session_id)
    {
        //Initialize all required Tables
        $classTable = TableRegistry::get('App.Classes');
        $subjectTable = TableRegistry::get('App.Subjects');
        $termlyResultTable = TableRegistry::get('StudentTermlyResults');
        $termlySubjectPositionTable = TableRegistry::get('StudentTermlySubjectPositions');

        // find the block the class_id is under. Either junior or senior
        $classDetail = $classTable->find('all')->where(['id'=>$class_id])->first();
        $block_id = $classDetail['block_id'];

        $subjects = $subjectTable->find('all')->where(['block_id'=>$block_id])->toArray();

        // loops through each particular subject
        // and find the students under that course for each particular class,
        // term and session .

        foreach ( $subjects as $subject ) {
            $studentsUnderTheSubject = $termlyResultTable->find('all')->where(['subject_id' => $subject['id'],
                'class_id' => $class_id,
                'term_id' => $term_id,
                'session_id' => $session_id
            ])->order(['total'=>'DESC'])->groupBy('total')->toArray();

            $position = 1;

            // If there are no students under the subject .. jump to the next subject
            if ( empty($studentsUnderTheSubject) ) {
                continue;
            }


            foreach ($studentsUnderTheSubject as $key => $value ) {

                foreach ( $value as $studentStudyingTheSubject ) {

                    $studentSubjectPosition = $termlySubjectPositionTable->find('all')->where(['student_id' => $studentStudyingTheSubject['student_id'],
                        'subject_id' => $studentStudyingTheSubject['subject_id'],
                        'class_id'   => $class_id,
                        'term_id'    => $term_id,
                        'session_id' => $session_id
                    ])->first();

                    if ( $studentSubjectPosition == null ) {

                        $studentSubjectPosition = $termlySubjectPositionTable->newEntity(['student_id' => $studentStudyingTheSubject['student_id'],
                            'subject_id' => $studentStudyingTheSubject['subject_id'],
                            'total'      => $studentStudyingTheSubject['total'],
                            'position'   => $position,
                            'class_id'   => $class_id,
                            'term_id'    => $term_id,
                            'session_id' => $session_id
                        ]);

                    } else {

                        $newData = (['student_id' => $studentStudyingTheSubject['student_id'],
                            'subject_id' => $studentStudyingTheSubject['subject_id'],
                            'total'      => $studentStudyingTheSubject['total'],
                            'position'   => $position,
                            'class_id'   => $class_id,
                            'term_id'    => $term_id,
                            'session_id' => $session_id
                        ]);

                        $studentSubjectPosition = $termlySubjectPositionTable->patchEntity($studentSubjectPosition,$newData);
                    }

                    $termlySubjectPositionTable->save($studentSubjectPosition);
                }
                // increment the position variable
                $position++;
            }
        }
        return true;

    }

    public function calculateTermlyPositionBasedOnClassDemarcation($class_id,$term_id,$session_id)
    {
        // Initializes the required tables
        $studentTable = TableRegistry::get('App.Students');
        $classDemarcationTable = TableRegistry::get('App.ClassDemarcations');
        $termlyPositionTable = TableRegistry::get('StudentTermlyPositions');
        $termlyPositionOnClassDemarcationTable = TableRegistry::get('StudentTermlyPositionOnClassDemarcations');

        $classDemarcations = $classDemarcationTable->find('all')->where(['class_id' => $class_id])->toArray();

        // loops through each class demarcations
        // and inputs the total of each students under a particular class demarcation
        // using the class_id passed value .
        foreach ( $classDemarcations as $classDemarcation ) {

            $studentsInEachClassDemarcation = $studentTable->find('all')->where([
                'class_demarcation_id' => $classDemarcation['id'],
                'session_id'          => $session_id
            ])->toArray();

            // This foreach expression is used to input the total from the termlyPositionTable in the termlyPositionBasedOnClassDemarcation

            foreach ( $studentsInEachClassDemarcation as $studentInClassDemarcation ) {
                $studentDetailsInTermlyPositionTable = $termlyPositionTable->find('all')->where([
                    'student_id' => $studentInClassDemarcation['id'],
                    'class_id'   => $class_id,
                    'term_id'    => $term_id,
                    'session_id' => $session_id

                ])->first();

                // if the student does not have a termly position data for that particular term
                // skip the student
                if ($studentDetailsInTermlyPositionTable == null ) {
                    continue;
                }
                //$this->out($studentDetailsInTermlyPositionTable);

                // Input the collected details in the termly position on class demarcation table

                $studentDetailsInTermlyPositionOnClassDemarcationTable = $termlyPositionOnClassDemarcationTable->find('all')->where([
                    'student_id' => $studentDetailsInTermlyPositionTable['student_id'],
                    'class_id'  => $class_id,
                    'term_id'   => $term_id,
                    'class_demarcation_id' => $classDemarcation['id'],
                    'session_id' => $session_id
                ])->first();

                if ( $studentDetailsInTermlyPositionOnClassDemarcationTable == null ) {

                    $studentDetailsInTermlyPositionOnClassDemarcationTable = $termlyPositionOnClassDemarcationTable->newEntity(['student_id' => $studentDetailsInTermlyPositionTable['student_id'],
                        'total'      => $studentDetailsInTermlyPositionTable['total'],
                        'average'   => $studentDetailsInTermlyPositionTable['average'],
                        'class_id' => $class_id,
                        'class_demarcation_id' => $classDemarcation['id'],
                        'term_id' => $term_id,
                        'session_id' => $session_id
                    ]);
                } else {
                    $newData = ['student_id' => $studentDetailsInTermlyPositionTable['student_id'],
                        'total'      => $studentDetailsInTermlyPositionTable['total'],
                        'average'   => $studentDetailsInTermlyPositionTable['average'],
                        'class_id' => $class_id,
                        'class_demarcation_id' => $classDemarcation['id'],
                        'term_id' => $term_id,
                        'session_id' => $session_id
                    ];

                    $studentDetailsInTermlyPositionOnClassDemarcationTable = $termlyPositionOnClassDemarcationTable->patchEntity($studentDetailsInTermlyPositionOnClassDemarcationTable,$newData);
                }
                $termlyPositionOnClassDemarcationTable->save($studentDetailsInTermlyPositionOnClassDemarcationTable );
            }

        }

        // calculates the positions of each students in each class demarcations based on the total

        foreach ( $classDemarcations as $classDemarcation ) {

            $studentsInEachClassDemarcation = $termlyPositionOnClassDemarcationTable->find('all')->where(['class_id' => $class_id,
                'class_demarcation_id' => $classDemarcation['id'],
                'term_id'            => $term_id,
                'session_id'         => $session_id
            ])->orderDesc('total')->groupBy('total')->toArray();

            $position = 1;

            foreach($studentsInEachClassDemarcation as $key => $value ) {

                foreach ( $value as $studentInClassDemarcation ) {
                    $studentInClassDemarcation['position'] = $position ;

                    $termlyPositionOnClassDemarcationTable->save($studentInClassDemarcation);

                }
                $position++;
            }
        }
        return true;
    }

    public function calculateTermlySubjectPositionOnClassDemarcation( $class_id,$term_id,$session_id )
    {
        //Initialize all required Tables
        $classTable = TableRegistry::get('App.Classes');
        $subjectTable = TableRegistry::get('App.Subjects');
        $studentTable = TableRegistry::get('App.Students');
        $classDemarcationTable = TableRegistry::get('App.ClassDemarcations');
        $termlySubjectPositionTable = TableRegistry::get('StudentTermlySubjectPositions');
        $termlySubjectPositionOnClassDemarcationTable = TableRegistry::get('StudentTermlySubjectPositionOnClassDemarcations');

        // find the block the class_id is under. Either junior or senior
        $classDetail = $classTable->find('all')->where(['id'=>$class_id])->first();
        $block_id = $classDetail['block_id'];

        // find all the subjects studied by that class using the block id.
        $subjects = $subjectTable->find('all')->where(['block_id'=>$block_id])->toArray();

        $classDemarcations = $classDemarcationTable->find('all')->where(['class_id' => $class_id])->toArray();

        // calculates the students in each class demarcation and categories with the different subjects.
        foreach ( $classDemarcations as $classDemarcation ) {

            $studentsInEachClassDemarcation = $studentTable->find('all')->where(['class_demarcation_id' => $classDemarcation['id'],
                'session_id'          => $session_id
            ])->toArray();

            // This foreach expression is used to input the total from the termlyPositionTable in the termlyPositionBasedOnClassDemarcation

            foreach ( $studentsInEachClassDemarcation as $studentInClassDemarcation ) {

                foreach($subjects as $subject ) {
                    $studentSubjectDetailInTermlySubjectPositionTable = $termlySubjectPositionTable->find('all')->where([
                        'student_id' => $studentInClassDemarcation['id'],
                        'subject_id' => $subject['id'],
                        'class_id'   => $class_id,
                        'term_id'    => $term_id,
                        'session_id' => $session_id
                    ])->toArray();

                    // if the student has no data in the termly_subject_position_table
                    // skip the table

                     if ( $studentSubjectDetailInTermlySubjectPositionTable == null )
                     {
                         continue;
                     }
                    //$this->out($studentSubjectDetailInTermlySubjectPositionTable);

                    // Building the data to Enter into the termlySubjectPositionOnClassDemarcationTable

                    // first is to check if the data exists in the table using the
                    // $student_id , $subject_id , $class_id , $term_id, $session_id

                    $studentSubjectDetailInTermlySubjectPositionOnClassDemarcationTable = $termlySubjectPositionOnClassDemarcationTable->find('all')
                        ->where(['student_id' => $studentInClassDemarcation['id'],
                            'subject_id' => $subject['id'],
                            'class_id'   => $class_id,
                            'class_demarcation_id' => $classDemarcation['id'],
                            'term_id'    => $term_id,
                            'session_id' => $session_id
                        ])->first();

                    if ( $studentSubjectDetailInTermlySubjectPositionOnClassDemarcationTable == null ) {

                        $studentSubjectDetailInTermlySubjectPositionOnClassDemarcationTable = $termlySubjectPositionOnClassDemarcationTable->newEntity(['student_id' => $studentInClassDemarcation['id'],
                            'subject_id' => $subject['id'],
                            'total'      => $studentSubjectDetailInTermlySubjectPositionTable[0]['total'],
                            'class_id'   => $class_id,
                            'class_demarcation_id' => $classDemarcation['id'],
                            'term_id'    => $term_id,
                            'session_id' => $session_id
                        ]);

                    } else {
                        $newData = ['student_id' => $studentInClassDemarcation['id'],
                            'subject_id' => $subject['id'],
                            'total'      => $studentSubjectDetailInTermlySubjectPositionTable[0]['total'],
                            'class_id'   => $class_id,
                            'class_demarcation_id' => $classDemarcation['id'],
                            'term_id'    => $term_id,
                            'session_id' => $session_id
                        ];
                        $studentSubjectDetailInTermlySubjectPositionOnClassDemarcationTable = $termlySubjectPositionOnClassDemarcationTable->patchEntity($studentSubjectDetailInTermlySubjectPositionOnClassDemarcationTable,$newData);

                    }
                    $termlySubjectPositionOnClassDemarcationTable->save($studentSubjectDetailInTermlySubjectPositionOnClassDemarcationTable);
                }
            }

        }

        // Calculate the students in a particular subject under a class demarcation .

        foreach ($subjects as $subject ) {
            // get the students in a subject under a particular class demarcation
            //$this->hr();
            foreach ( $classDemarcations as $classDemarcation ) {

                $studentsUnderTheSubjectInClassDemarcation = $termlySubjectPositionOnClassDemarcationTable->find('all')
                    ->where(['subject_id' => $subject['id'],
                        'class_demarcation_id' => $classDemarcation['id'],
                        'class_id'            => $class_id,
                        'term_id'             => $term_id,
                        'session_id'         => $session_id
                    ])->orderDesc('total')->groupBy('total')->toArray();

                $position = 1;
                foreach ( $studentsUnderTheSubjectInClassDemarcation as $key => $value ) {

                    foreach ( $value as $studentUnderTheSubjectInClassDemarcation ) {
                        $studentUnderTheSubjectInClassDemarcation['position'] = $position ;

                        //$this->out($studentUnderTheSubjectInClassDemarcation);

                        $termlySubjectPositionOnClassDemarcationTable->save($studentUnderTheSubjectInClassDemarcation);
                    }
                    $position++;
                }
            }

        }
        return true;

    }

    /**
     * @param $class_id
     * @param $term_id
     * @param $session_id
     * @return bool
     */
    public function calculateSubjectClassAverage($class_id,$term_id,$session_id)
    {
        //Initialize all required Tables
        $classTable = TableRegistry::get('App.Classes');
        $subjectTable = TableRegistry::get('App.Subjects');
        $termlyResultTable = TableRegistry::get('StudentTermlyResults');
        $subjectClassAverageTable = TableRegistry::get('SubjectClassAverages');

        // find the block the class_id is under. Either junior or senior
        $classDetail = $classTable->find('all')->where(['id'=>$class_id])->first();
        $block_id = $classDetail['block_id'];

        $subjects = $subjectTable->find('all')->where(['block_id'=>$block_id])->toArray();

        // loops through each particular subject
        // and find the students under that course for each particular class,
        // term and session .
        foreach ( $subjects as $subject ) {
            $studentsUnderTheSubject = $termlyResultTable->find('all')->select(['total'])->where(['subject_id' => $subject['id'],
                'class_id' => $class_id,
                'term_id' => $term_id,
                'session_id' => $session_id
            ])->toArray();

            // if the class does not contain any data
            // skip the class
            if ( $studentsUnderTheSubject == null ){
                break;
            }
            $studentCount = count($studentsUnderTheSubject);

            //$this->out($subject->id);
            //$this->out($studentsUnderTheSubject);

            // Initialize the sum variable
            $sum = 0;
            for ($num = 0; $num < $studentCount ; $num++ ) {
                $sum += $studentsUnderTheSubject[$num]['total'] ;
            }

            // if the sum variable is 0 skip the current loop
            // it means that the particular subject was not done by the class
            if ( $sum === (int)0 ) {
                continue;
            }

            $class_average = $this->_determineNumberPrecision($sum / $studentCount) ;
            //$this->out($class_average);

            $subjectClassAverage = $subjectClassAverageTable->find('all')->where([
                'subject_id' => $subject->id,
                'class_id' => $class_id,
                'term_id' => $term_id,
                'session_id' => $session_id
            ])->first();

            // if the record does not exist , Create a new record
            if ($subjectClassAverage == null ) {
                $subjectClassAverage = $subjectClassAverageTable->newEntity([
                    'subject_id' => $subject->id,
                    'student_count' => $studentCount,
                    'class_average' => $class_average,
                    'class_id' => $class_id,
                    'term_id' => $term_id,
                    'session_id' => $session_id]);
            } else {
                // else update the existing record
                $newData = [
                    'student_count' => $studentCount,
                    'total' => $sum ,
                    'class_average' => $class_average ,
                ];

                $subjectClassAverage = $subjectClassAverageTable->patchEntity($subjectClassAverage,$newData);
            }
            $subjectClassAverageTable->save($subjectClassAverage);

            return true;
        }

        return false;
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