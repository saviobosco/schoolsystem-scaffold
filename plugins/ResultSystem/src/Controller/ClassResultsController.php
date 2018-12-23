<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 12/19/18
 * Time: 12:51 PM
 */

namespace ResultSystem\Controller;

/**
 * Class ClassSubjectsController
 * @package ResultSystem\Controller
 * @property \ResultSystem\Model\Table\StudentTermlySubjectPositionsTable $StudentTermlySubjectPositions
 * @property \ResultSystem\Model\Table\StudentsTable $Students
 * @property \ResultSystem\Model\Table\SubjectsTable $Subjects
 * @property \ResultSystem\Model\Table\StudentTermlyPositionsTable $StudentTermlyPositions
 * @property \ResultSystem\Model\Table\StudentAnnualPositionsTable $StudentAnnualPositions
 * @property \ResultSystem\Model\Table\StudentTermlyResultsTable $StudentTermlyResults
 * @property \ResultSystem\Model\Table\StudentAnnualResultsTable $StudentAnnualResults
 * @property \ResultSystem\Model\Table\SessionsTable $Sessions
 * @property \ResultSystem\Model\Table\ClassesTable $Classes
 * @property \ResultSystem\Model\Table\TermsTable $Terms
 */

class ClassResultsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('ResultSystem.StudentTermlyResults');
        $this->loadModel('ResultSystem.StudentAnnualResults');
        $this->loadModel('ResultSystem.StudentTermlySubjectPositions');
        $this->loadModel('ResultSystem.StudentTermlyPositions');
        $this->loadModel('ResultSystem.StudentAnnualPositions');
        $this->loadModel('ResultSystem.StudentAnnualResults');
        $this->loadModel('ResultSystem.Students');
        $this->loadModel('ResultSystem.Subjects');
        $this->loadModel('ResultSystem.Sessions');
        $this->loadModel('ResultSystem.Classes');
        $this->loadModel('ResultSystem.Terms');
    }

    public function index()
    {
        $sessions = $this->Students->Sessions->find('list')->toArray();
        $classes = $this->Students->Classes->find('list')->toArray();
        $terms = $this->Terms->find('list')->toArray();
        $this->set(compact('sessions','classes', 'terms'));
        $queryData = $this->request->getQuery();
        if (empty($queryData)) {
            return ;
        }
        $class = $this->Classes->query()->where(['id' => $queryData['class_id']])->first();
        $subjects = $this->Subjects->query()->where(['block_id' => $class['block_id']])->combine('id','name')->toArray();
        if (isset($queryData['term_id']) && !empty($queryData['term_id']) && (int)$queryData['term_id'] === 4) {
            $studentResults = $this->StudentAnnualResults->query()
                ->enableHydration(false)
                ->select(['total','student_id','subject_id','class_id','session_id'])
                ->where([
                    'StudentAnnualResults.session_id' => $queryData['session_id'],
                    'StudentAnnualResults.class_id' => $queryData['class_id']
                ])
                ->combine('subject_id',
                    function($entity) {
                        return $entity;
                    },
                    function($entity) {
                        return $entity['student_id'];
                    }
                )->toArray();
            if (isset($queryData['include_positions']) && (int)$queryData['include_positions'] === 1) {
                $students = $this->StudentAnnualPositions->query()
                    ->enableHydration(false)
                    ->select(['student_id','total','position','Students.first_name','Students.last_name'])
                    ->where([
                        'StudentAnnualPositions.session_id' => $queryData['session_id'],
                        'StudentAnnualPositions.class_id' => $queryData['class_id'],
                    ])
                    ->contain(['Students'])
                    ->orderAsc('position')
                    ->combine('student_id', function($entity) {return $entity;})
                    ->toArray();
                if (empty($students)) {
                    $this->Flash->error('Students positions not found!');
                }
            } else {
                $students = $this->StudentAnnualResults->query()
                    ->enableHydration(false)
                    ->select(['student_id','Students.first_name','Students.last_name'])
                    ->distinct('student_id')
                    ->contain(['Students'])
                    ->where([
                        'StudentAnnualResults.session_id' => $queryData['session_id'],
                        'StudentAnnualResults.class_id' => $queryData['class_id'],
                    ])
                    ->combine('student_id', function($entity) {return $entity;})
                    ->toArray();
            }
        } else {
            $studentResults = $this->StudentTermlyResults->query()
                ->enableHydration(false)
                ->select(['total','student_id','subject_id','class_id','session_id','term_id'])
                ->where([
                    'StudentTermlyResults.session_id' => $queryData['session_id'],
                    'StudentTermlyResults.class_id' => $queryData['class_id'],
                    'StudentTermlyResults.term_id' => $queryData['term_id']
                ])
                ->combine('subject_id',
                    function($entity) {
                        return $entity;
                    },
                    function($entity) {
                        return $entity['student_id'];
                    }
                )->toArray();
            if (isset($queryData['include_positions']) && (int)$queryData['include_positions'] === 1) {
                $students = $this->StudentTermlyPositions->query()
                    ->enableHydration(false)
                    ->select(['student_id','total','position','Students.first_name','Students.last_name'])
                    ->where([
                        'StudentTermlyPositions.session_id' => $queryData['session_id'],
                        'StudentTermlyPositions.class_id' => $queryData['class_id'],
                        'StudentTermlyPositions.term_id' => $queryData['term_id'],
                    ])
                    ->contain(['Students'])
                    ->orderAsc('position')
                    ->combine('student_id', function($entity) {return $entity;})
                    ->toArray();
                if (empty($students)) {
                    $this->Flash->error('Students positions not found!');
                }
            } else {
                $students = $this->StudentTermlyResults->query()
                    ->enableHydration(false)
                    ->select(['student_id','Students.first_name','Students.last_name'])
                    ->distinct('student_id')
                    ->contain(['Students'])
                    ->where([
                        'StudentTermlyResults.session_id' => $queryData['session_id'],
                        'StudentTermlyResults.class_id' => $queryData['class_id'],
                        'StudentTermlyResults.term_id' => $queryData['term_id'],
                    ])
                    ->combine('student_id', function($entity) {return $entity;})
                    ->toArray();
            }
        }
        $this->set(compact('studentResults','subjects','students','studentsPositions'));
    }

}