<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/26/16
 * Time: 12:10 AM
 */

namespace ResultSystem\ResultProcessing;

use Cake\ORM\TableRegistry;
use GradingSystem\Exception\MissingScoreRangeException;

/**
 * Class TermlyResultProcessing
 * @package ResultSystem\ResultProcessing
 *
 */
class TermlyResultProcessing
{
    use ResultProcessingTrait;

    public function __construct()
    {
        $this->_initialize();
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
        $returnData = null; // this is the return value
        // Initializes the All required tables
        $termlyResultTable = TableRegistry::get('ResultSystem.StudentTermlyResults');
        $positionTable = TableRegistry::get('ResultSystem.StudentPositions');

        $studentsTermlyResultsQuery = $termlyResultTable->find('all');
        $studentsTermlyResults = $studentsTermlyResultsQuery
            ->select(['student_id','total','class_id','term_id','session_id'])
            ->where([
                'term_id' => $term_id,
                'class_id' => $class_id,
                'session_id' => $session_id
            ])
            ->groupBy('student_id');

        if($studentsTermlyResults->isEmpty()) {
            $returnData['error'] = 'No Student found';
            return $returnData;
        }

        foreach ( $studentsTermlyResults as $student_id => $subjects) {
            $subjectCount = count($subjects);
            if ( $subjectCount <= 0 ) {
                continue;
            }
            // check if the student subjects is greater that the supplied $no_of_students
            if ( $subjectCount < $no_of_subjects OR $subjectCount > $no_of_subjects) {
                $studentId = $student_id;
                $returnData['subjectCountIssues'][] = "Student with Id <strong>$studentId</strong> has <strong>$subjectCount</strong> subjects.";
                unset($studentId);
            }
            $sum = 0 ;
            for ($num = 0; $num < $subjectCount ; $num++ ) {
                $sum += $subjects[$num]['total'] ;
            }
            $average = $this->_determineNumberPrecision($sum / $no_of_subjects ) ;
            // check to know if the record already exists in the table .
            try {
                // get from table
                // if null create new
                // else patch and check if dirty
                // else continue
                $studentTotal = $positionTable->find('all')->where(['student_id' => $student_id,
                    'class_id' => $class_id,
                    'term_id' => $term_id,
                    'session_id' => $session_id
                ])->first();

                // if the record does not exist , Create a new record
                if ($studentTotal == null ) {
                    $studentTotal = $positionTable->newEntity(['student_id' => $student_id,
                        'total' => $sum ,
                        'average' => $average,
                        'grade'   => $this->remarks[$this->calculateGrade($average,$this->grades)],
                        'class_id' => $class_id,
                        'term_id' => $term_id,
                        'session_id' => $session_id]);
                } else {
                    // else update the existing record
                    $newData = ['student_id' => $student_id,
                        'total' => $sum ,
                        'average' => $average,
                        'grade'   => $this->remarks[$this->calculateGrade($average,$this->grades)],
                        'class_id' => $class_id,
                        'term_id' => $term_id,
                        'session_id' => $session_id];

                    $studentTotal = $positionTable->patchEntity($studentTotal,$newData);
                }
                if ($studentTotal->isNew() || $studentTotal->isDirty()) {
                    $positionTable->save($studentTotal);
                }
            } catch (MissingScoreRangeException $exception) {
                $returnData['subjectCountIssues'][] = $exception->getMessage();
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
        $PositionTable = TableRegistry::get('ResultSystem.StudentPositions');
        $termlyPositionTableSchema = $PositionTable->getSchema()->setColumnType('total', 'string');
        TableRegistry::clear();
        $PositionTable = TableRegistry::get('ResultSystem.StudentPositions', [
            'schema' => $termlyPositionTableSchema
        ]);

        $studentsGroupByTotal = $PositionTable->find('all')
            ->select(['id','class_id','term_id','session_id','student_id','total','position'])
            ->where([
                'term_id' => $term_id,
                'class_id'=>$class_id,
            'session_id' => $session_id
        ])->orderDesc('total')
            ->groupBy('total');
        if ($studentsGroupByTotal->isEmpty()) {
            return false;
        }
        $position = 1;
        foreach ($studentsGroupByTotal as  $studentsWithSameTotal ) {
            foreach($studentsWithSameTotal as $student ) {
                $student = $PositionTable->patchEntity($student, ['position' => $position]);
                if ($student->isDirty()) {
                    $PositionTable->save($student);
                }
            }
            $position += count($studentsWithSameTotal);
        }
        return true;
    }

    public function calculateStudentTermlySubjectPosition($class_id,$term_id,$session_id)
    {
        //Initialize all required Tables
        $termlyResultTable = TableRegistry::get('ResultSystem.StudentTermlyResults');
        $termlyResultTableSchema = $termlyResultTable->getSchema()->setColumnType('total', 'string');
        TableRegistry::clear();
        $termlyResultTable = TableRegistry::get('ResultSystem.StudentTermlyResults', [
            'schema' => $termlyResultTableSchema
        ]);
        $classTable = TableRegistry::get('ResultSystem.Classes');
        $subjectTable = TableRegistry::get('ResultSystem.Subjects');
        $subjectPositionTable = TableRegistry::get('ResultSystem.StudentSubjectPositions');

        // find the block the class_id is under. Either junior or senior
        $classDetail = $classTable->find('all')->where(['id'=>$class_id])->first();
        $block_id = $classDetail['block_id'];
        $subjects = $subjectTable->find('all')->where(['block_id'=>$block_id]);
        // loops through each particular subject
        // and find the students under that course for each particular class,
        // term and session .
        if ($subjects->isEmpty()) {
            return false;
        }
        foreach ( $subjects as $subject ) {
            $studentsUnderTheSubject = $termlyResultTable->find('all')
                ->select(['subject_id','student_id','total','class_id','term_id','session_id'])
                ->where([
                    'term_id' => $term_id,
                    'session_id' => $session_id,
                    'subject_id' => $subject['id'],
                    'class_id' => $class_id
            ])->order(['total'=>'DESC'])
                ->groupBy('total');
            // If there are no students under the subject .. jump to the next subject
            if ( $studentsUnderTheSubject->isEmpty()) {
                continue;
            }
            $position = 1;
            foreach ($studentsUnderTheSubject as  $totalGroup) {
                foreach ($totalGroup as $studentStudyingTheSubject) {

                    $studentSubjectPosition = $subjectPositionTable->find('all')->where([
                        'student_id' => $studentStudyingTheSubject['student_id'],
                        'subject_id' => $studentStudyingTheSubject['subject_id'],
                        'class_id'   => $class_id,
                        'term_id'    => $term_id,
                        'session_id' => $session_id
                    ])->first();

                    if ( $studentSubjectPosition == null ) {
                        $studentSubjectPosition = $subjectPositionTable->newEntity(['student_id' => $studentStudyingTheSubject['student_id'],
                            'subject_id' => $studentStudyingTheSubject['subject_id'],
                            'total'      => $studentStudyingTheSubject['total'],
                            'position'   => $position,
                            'class_id'   => $class_id,
                            'term_id'    => $term_id,
                            'session_id' => $session_id
                        ]);
                    } else {
                        $newData = ([
                            'total'      => $studentStudyingTheSubject['total'],
                            'position'   => $position,
                        ]);
                        $studentSubjectPosition = $subjectPositionTable->patchEntity($studentSubjectPosition,$newData);
                    }
                    if ($studentSubjectPosition->isNew() || $studentSubjectPosition->isDirty()) {
                        $subjectPositionTable->save($studentSubjectPosition);
                    }
                }
                // increment the position variable
                $position += count($totalGroup);
            }
        }
        return true;
    }

    /**
     * @param $class_id
     * @param $term_id
     * @param $session_id
     * @return bool
     * @deprecated
     */
    public function calculateTermlyPositionBasedOnClassDemarcation($class_id,$term_id,$session_id)
    {
        // Initializes the required tables
        $studentTable = TableRegistry::get('ResultSystem.Students');
        $classDemarcationTable = TableRegistry::get('ResultSystem.ClassDemarcations');
        $termlyPositionTable = TableRegistry::get('ResultSystem.StudentTermlyPositions');
        $termlyPositionOnClassDemarcationTable = TableRegistry::get('ResultSystem.StudentTermlyPositionOnClassDemarcations');

        $classDemarcations = $classDemarcationTable->find('all')->where(['class_id' => $class_id])->toArray();
        // loops through each class demarcations
        // and inputs the total of each students under a particular class demarcation
        // using the class_id passed value .
        foreach ( $classDemarcations as $classDemarcation ) {
            $studentsInEachClassDemarcation = $studentTable->find('all')->where([
                'class_demarcation_id' => $classDemarcation['id'],
                'status' => 1
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
                // Input the collected details in the termly position on class demarcation table
                $studentDetailsInTermlyPositionOnClassDemarcationTable = $termlyPositionOnClassDemarcationTable->findOrCreate([
                    'student_id' => $studentDetailsInTermlyPositionTable['student_id'],
                    'class_id'  => $class_id,
                    'term_id'   => $term_id,
                    'class_demarcation_id' => $classDemarcation['id'],
                    'session_id' => $session_id
                ]);
                $newData = ['student_id' => $studentDetailsInTermlyPositionTable['student_id'],
                    'total'      => $studentDetailsInTermlyPositionTable['total'],
                    'average'   => $studentDetailsInTermlyPositionTable['average'],
                    'class_id' => $class_id,
                    'class_demarcation_id' => $classDemarcation['id'],
                    'term_id' => $term_id,
                    'session_id' => $session_id
                ];
                $studentDetailsInTermlyPositionOnClassDemarcationTable = $termlyPositionOnClassDemarcationTable->patchEntity($studentDetailsInTermlyPositionOnClassDemarcationTable,$newData);
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

    /**
     * @param $class_id
     * @param $term_id
     * @param $session_id
     * @return bool
     * @deprecated
     */
    public function calculateTermlySubjectPositionOnClassDemarcation( $class_id,$term_id,$session_id )
    {
        //Initialize all required Tables
        $classTable = TableRegistry::get('ResultSystem.Classes');
        $subjectTable = TableRegistry::get('ResultSystem.Subjects');
        $studentTable = TableRegistry::get('ResultSystem.Students');
        $classDemarcationTable = TableRegistry::get('ResultSystem.ClassDemarcations');
        $termlySubjectPositionTable = TableRegistry::get('ResultSystem.StudentTermlySubjectPositions');
        $termlySubjectPositionOnClassDemarcationTable = TableRegistry::get('ResultSystem.StudentTermlySubjectPositionOnClassDemarcations');
        // find the block the class_id is under. Either junior or senior
        $classDetail = $classTable->find('all')->where(['id'=>$class_id])->first();
        $block_id = $classDetail['block_id'];
        // find all the subjects studied by that class using the block id.
        $subjects = $subjectTable->find('all')->where(['block_id'=>$block_id])->toArray();

        $classDemarcations = $classDemarcationTable->find('all')->where(['class_id' => $class_id])->toArray();

        // calculates the students in each class demarcation and categories with the different subjects.
        foreach ( $classDemarcations as $classDemarcation ) {
            $studentsInEachClassDemarcation = $studentTable->find('all')
                ->where([
                    'class_demarcation_id' => $classDemarcation['id'],
                    'status' => 1
            ])->toArray();
            // This foreach expression is used to input the total from the termlyPositionTable in the termlyPositionBasedOnClassDemarcation
            foreach ( $studentsInEachClassDemarcation as $studentInClassDemarcation ) {
                foreach($subjects as $subject ) {
                    $studentSubjectDetailInTermlySubjectPositionTable = $termlySubjectPositionTable->find('all')
                        ->where([
                        'student_id' => $studentInClassDemarcation['id'],
                        'subject_id' => $subject['id'],
                        'class_id'   => $class_id,
                        'term_id'    => $term_id,
                        'session_id' => $session_id
                    ])->toArray();

                    // if the student has no data in the termly_subject_position_table
                    // skip the table

                     if ( $studentSubjectDetailInTermlySubjectPositionTable === null )
                     {
                         continue;
                     }
                    // Building the data to Enter into the termlySubjectPositionOnClassDemarcationTable
                    // first is to check if the data exists in the table using the
                    // $student_id , $subject_id , $class_id , $term_id, $session_id
                    $studentSubjectDetailInTermlySubjectPositionOnClassDemarcationTable = $termlySubjectPositionOnClassDemarcationTable->findOrCreate([
                            'student_id' => $studentInClassDemarcation['id'],
                            'subject_id' => $subject['id'],
                            'class_id'   => $class_id,
                            'class_demarcation_id' => $classDemarcation['id'],
                            'term_id'    => $term_id,
                            'session_id' => $session_id
                        ]);
                    $newData = ['student_id' => $studentInClassDemarcation['id'],
                        'subject_id' => $subject['id'],
                        'total'      => $studentSubjectDetailInTermlySubjectPositionTable[0]['total'],
                        'class_id'   => $class_id,
                        'class_demarcation_id' => $classDemarcation['id'],
                        'term_id'    => $term_id,
                        'session_id' => $session_id
                    ];
                    $studentSubjectDetailInTermlySubjectPositionOnClassDemarcationTable = $termlySubjectPositionOnClassDemarcationTable->patchEntity($studentSubjectDetailInTermlySubjectPositionOnClassDemarcationTable,$newData);
                    $termlySubjectPositionOnClassDemarcationTable->save($studentSubjectDetailInTermlySubjectPositionOnClassDemarcationTable);
                }
            }
        }
        // Calculate the students in a particular subject under a class demarcation .
        foreach ($subjects as $subject ) {
            // get the students in a subject under a particular class demarcation
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
        $termlyResultTable = TableRegistry::get('ResultSystem.StudentTermlyResults');
        $subjectClassAverageTable = TableRegistry::get('ResultSystem.SubjectClassAverages');

        $studentsUnderTheSubject = $termlyResultTable->find('all')->select(['subject_id','total'])->where([
            'class_id' => $class_id,
            'term_id' => $term_id,
            'session_id' => $session_id
        ])
            ->enableHydration(false)
            ->groupBy('subject_id');
        if ($studentsUnderTheSubject->isEmpty()) {
            return false;
        }
        foreach ($studentsUnderTheSubject as $subject_id => $studentsTotal) {
            if (empty($studentsTotal)){
                continue;
            }
            $studentCount = count($studentsTotal);
            // Initialize the sum variable
            $sum = 0;
            for ($num = 0; $num < $studentCount ; $num++ ) {
                $sum += $studentsTotal[$num]['total'] ;
            }
            $class_average = $this->_determineNumberPrecision($sum / $studentCount);
            $subjectClassAverage = $subjectClassAverageTable->newEntity(
                [
                    'subject_id' => $subject_id,
                    'class_id' => $class_id,
                    'term_id' => $term_id,
                    'session_id' => $session_id,
                    'student_count' => $studentCount,
                    'total' => $sum ,
                    'class_average' => $class_average ,
                ]
            );
            $subjectClassAverageTable->save($subjectClassAverage);
        }
        return true;
    }

}