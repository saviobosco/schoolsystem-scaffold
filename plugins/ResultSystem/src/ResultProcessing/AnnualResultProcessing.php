<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/26/16
 * Time: 3:38 PM
 */

namespace ResultSystem\ResultProcessing;

use Cake\ORM\TableRegistry;
use GradingSystem\Exception\MissingScoreRangeException;

class AnnualResultProcessing
{
    use ResultProcessingTrait;


    public function __construct()
    {
        $this->_initialize();
    }


    /**
     * @param $class_id
     * @param $session_id
     * @return $returnData
     */
    public function calculateAnnualTotals($class_id, $session_id)
    {
        $returnData = null;
        // Initialize the required tables
        $annualResultTable = TableRegistry::get('ResultSystem.StudentAnnualResults');
        $annualPositionTable = TableRegistry::get('ResultSystem.StudentAnnualPositions');

        $StudentTotalForAllTermlySubjects = $annualResultTable->find('all')
            ->where([
                'class_id'   => $class_id,
                'session_id' => $session_id
            ])
            ->groupBy('student_id');
        if ($StudentTotalForAllTermlySubjects->isEmpty()) {
            return false;
        }

        foreach ($StudentTotalForAllTermlySubjects as $student_id => $studentAnnualTotalForASubject) {
            $subjectsCount = count($studentAnnualTotalForASubject);
            if (0 === $subjectsCount) {
                continue;
            }
            $sumOfSubjectsTotal = 0;
            $sumOfSubjectsAverage = 0;
            $subjectCount = 0;

            try {
                for($num = 0; $num < $subjectsCount; $num++) {
                    // deleting empty columns.
                    if (!$studentAnnualTotalForASubject[$num]['first_term'] AND ! $studentAnnualTotalForASubject[$num]['second_term'] AND ! $studentAnnualTotalForASubject[$num]['third_term'] ) {
                        $annualResultTable->delete($studentAnnualTotalForASubject[$num]);
                        continue;
                    }
                    $averageDivision = 0;
                    if ($studentAnnualTotalForASubject[$num]['first_term']) { $averageDivision++; }
                    if ($studentAnnualTotalForASubject[$num]['second_term']) { $averageDivision++; }
                    if ($studentAnnualTotalForASubject[$num]['third_term']) { $averageDivision++; }
                    $studentAnnualTotalForASubject[$num]['total'] = $studentAnnualTotalForASubject[$num]['first_term'] +
                        $studentAnnualTotalForASubject[$num]['second_term'] + $studentAnnualTotalForASubject[$num]['third_term'];
                    $studentAnnualTotalForASubject[$num]['average'] = $this->_determineNumberPrecision( $studentAnnualTotalForASubject[$num]['total'] / $averageDivision) ;
                    // calculates the grade
                    $studentAnnualTotalForASubject[$num]['grade'] = $this->calculateGrade($studentAnnualTotalForASubject[$num]['average'], $this->grades);
                    // calculate the remark
                    $studentAnnualTotalForASubject[$num]['remark'] = $this->remarks[$studentAnnualTotalForASubject[$num]['grade']];

                    $annualResultTable->save($studentAnnualTotalForASubject[$num]);
                    $sumOfSubjectsTotal += $studentAnnualTotalForASubject[$num]['total'];
                    $sumOfSubjectsAverage += $studentAnnualTotalForASubject[$num]['average'];
                    $subjectCount++;
                }
                $subjectAverage = $this->_determineNumberPrecision($sumOfSubjectsAverage / $subjectCount);
                $studentAnnualPosition = $annualPositionTable->newEntity(
                    [
                        'student_id' => $student_id,
                        'total'      => $sumOfSubjectsTotal,
                        'average'    => $subjectAverage,
                        'grade'     => $this->remarks[$this->calculateGrade($subjectAverage,$this->grades)],
                        'class_id'  => $class_id,
                        'session_id' => $session_id
                    ]
                );
                $annualPositionTable->save($studentAnnualPosition);

            } catch (MissingScoreRangeException $exception) {
                $returnData['subjectCountIssues'][] = $exception->getMessage();
            }

        }
        return $returnData;
    }

    public function calculateAnnualPosition($class_id,$session_id)
    {
        // Initializes the All required tables
        $annualPositionTable = TableRegistry::get('ResultSystem.StudentAnnualPositions');
        $annualResultsTotal = $annualPositionTable->find('all')
            ->select(['total','class_id','session_id','student_id'])
            ->where([
            'class_id'=>$class_id,
            'session_id' => $session_id
            ])
            ->order(['total'=>'DESC'])
            ->groupBy('total');
        if ($annualResultsTotal->isEmpty()) {
            return false;
        }
        $position = 1;
        foreach ($annualResultsTotal as  $totalGroup ) {
            foreach($totalGroup as $student) {
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
        $subjects = $subjectTable->find('all')->where(['block_id'=>$classDetail['block_id']]);
        // loops through each particular subject
        // and find the students under that course for each particular class,
        // term and session .
        if ($subjects->isEmpty()) {
            return false;
        }
        foreach ( $subjects as $subject ) {
            $studentsStudyingTheSubject = $annualResultTable->find('all')->where([
                'subject_id' => $subject['id'],
                'class_id' => $class_id,
                'session_id' => $session_id
                ])
                ->order(['total'=>'DESC'])
                ->groupBy('total');
            if ($studentsStudyingTheSubject->isEmpty()) {
                continue;
            }
            $position = 1;
            foreach ( $studentsStudyingTheSubject as $key => $value ) {
                foreach ( $value as $studentStudyingTheSubject ) {
                    $studentSubjectPosition = $annualSubjectPositionTable->newEntity(
                        [
                            'student_id' => $studentStudyingTheSubject['student_id'],
                            'subject_id' => $studentStudyingTheSubject['subject_id'],
                            'class_id'   => $class_id,
                            'session_id' => $session_id,
                            'total'      => $studentStudyingTheSubject['total'],
                            'position'   => $position,
                        ]
                    );
                    $annualSubjectPositionTable->save($studentSubjectPosition);
                }
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

}