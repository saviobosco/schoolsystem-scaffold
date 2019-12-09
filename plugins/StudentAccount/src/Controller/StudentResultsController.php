<?php
namespace StudentAccount\Controller;

use StudentAccount\Controller\AppController;
use Cake\Core\Plugin;
use Cake\ORM\TableRegistry;
use Cake\Datasource\Exception\RecordNotFoundException;
/**
 * StudentResults Controller
 * @property \ResultSystem\Model\Table\StudentsTable $Students
 * @property \ResultSystem\Model\Table\SubjectsTable $Subjects
 * @property \ResultSystem\Model\Table\TermsTable $Terms
 * @property \ResultSystem\Model\Table\StudentResultPinsTable $StudentResultPins
 * @property \ResultSystem\Model\Table\ResultGradeInputsTable $ResultGradeInputs
 * @property \ResultSystem\Model\Table\ResultRemarkInputsTable $ResultRemarkInputs
 * @property \ResultSystem\Model\Table\StudentPublishResultsTable $StudentPublishResults
 * @property \ResultSystem\Model\Table\StudentClassCountsTable $StudentClassCounts
 */
class StudentResultsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('ResultSystem.Students');
        $this->loadModel('ResultSystem.ResultGradeInputs');
        $this->loadModel('ResultSystem.ResultRemarkInputs');
        $this->loadModel('ResultSystem.ResultRemarks');
        $this->loadModel('ResultSystem.Terms');
        $this->loadModel('ResultSystem.Sessions');
        $this->loadModel('ResultSystem.Subjects');
        $this->loadModel('ResultSystem.StudentPublishResults');
    }

    public function view()
    {
        $queryData = $this->request->getQuery();
        $session = $queryData;
        $session['id'] = $this->Auth->user('student_id');

        try {
            $sessions = $this->Students->Sessions->find('list')->toArray();
            $terms = $this->Terms->find('list')->toArray();
            $classes = $this->Students->Classes->find('list')->toArray();
            $this->set(compact('sessions','terms','classes'));


            $remarkInputs = $this->ResultRemarkInputs->getValidRemarkInputs($session['session_id']);
            $this->loadModel('ResultSystem.StudentClassCounts');
            $studentsCount = $this->StudentClassCounts->getStudentsClassCount($session['session_id'], $session['class_id'], $session['term_id']);
            $this->loadModel('ResultSystem.Subjects');
            $subjectClassAverages = $this->Subjects->getSubjectClassAverages($session['session_id'], $session['class_id'], $session['term_id']);
            $this->loadModel('ResultSystem.StudentPublishResults');
            $studentResultPublishStatus = $this->StudentPublishResults->getStudentResultPublishStatus($session['id'], $session['session_id'], $session['class_id'], $session['term_id']);
            // if the SkillsGrading Plugin is Loaded
            if (Plugin::loaded('SkillsGradingSystem')) {
                // Loads the Affective and Psychomotor Skills Table
                $affectiveDispositionTable = TableRegistry::get('SkillsGradingSystem.StudentsAffectiveDispositionScores');
                $psychomotorSkillsTable = TableRegistry::get('SkillsGradingSystem.StudentsPsychomotorSkillScores');
                // Finds the student Record in the Affective score table
                $studentAffectiveDispositions = $affectiveDispositionTable->getStudentAffectiveDepositions($session['id'], $session['session_id'], $session['class_id'], $session['term_id']);
                // Finds the student record in the Psychomotor score table
                $studentPsychomotorSkills = $psychomotorSkillsTable->getStudentPsychomotorSkills($session['id'], $session['session_id'], $session['class_id'], $session['term_id']);
                // setting the variables
                $this->set(compact('studentAffectiveDispositions','studentPsychomotorSkills'));
            }
            if ((isset($session['term_id']) && 4 === (int)$session['term_id']) ) {
                $session['term_id'] = 4;
                $student = $this->Students
                    ->find()
                    ->enableHydration(false)
                    ->select(['id','first_name','last_name','class_id','photo'])
                    ->where(['id' => $session['id'] ])
                    ->first();
                $studentAnnualResults = $this->Students->getStudentAnnualResultOnly($student['id'],$session);
                // get student annual position
                $studentPosition = $this->Students->getStudentPosition($student['id'],$session['session_id'], $session['class_id'], $session['term_id']);
                // get student annual subject positions
                $studentSubjectPositions = $this->Students->getStudentSubjectPositions($student['id'],$session['session_id'],$session['class_id'], $session['term_id']);
                //get the student remark
                $studentRemark = $this->Students->getStudentGeneralRemark($student['id'],$session['session_id'],$session['class_id'],$session['term_id']);
                $this->set(compact('student',
                    'studentAnnualResults',
                    'remarkInputs',
                    'studentRemark',
                    'fees',
                    'subjects',
                    'studentSubjectPositions',
                    'studentPosition',
                    'studentResultPublishStatus',
                    'studentsCount',
                    'nextTerm'
                ));
                $this->set('_serialize', ['student']);
                $this->render('ResultSystem./CheckResult/annual_result');
            } else {
                $student = $this->Students
                    ->find()
                    ->enableHydration(false)
                    ->select(['id','first_name','last_name','class_id','photo'])
                    ->where(['id' => $session['id'] ])
                    ->first();
                $studentTermlyResults = $this->Students->getStudentTermlyResultOnly($student['id'], $session);
                //dd($studentTermlyResults);
                //get the student remark
                $studentRemark = $this->Students->getStudentGeneralRemark($student['id'],$session['session_id'], $session['class_id'], $session['term_id']);
                // get the student position
                $studentPosition = $this->Students->getStudentPosition($student['id'], $session['session_id'], $session['class_id'], $session['term_id']);
                // gets the student subject positions
                $studentSubjectPositions = $this->Students->getStudentSubjectPositions($student['id'], $session['session_id'], $session['class_id'], $session['term_id']);
                $resultGradeInputs = $this->ResultGradeInputs->getResultGradeInputs($session['session_id']);
                $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs($resultGradeInputs);
                $gradeInputsForTableHead = $this->ResultGradeInputs->getValidGradeInputsWithAllData($resultGradeInputs);
                $this->set(compact('student',
                    'studentTermlyResults',
                    'gradeInputs',
                    'remarkInputs',
                    'gradeInputsForTableHead',
                    'subjects',
                    'studentSubjectPositions',
                    'studentPosition',
                    'studentsCount',
                    'fees',
                    'studentRemark',
                    'subjectClassAverages',
                    'studentResultPublishStatus',
                    'nextTerm'));
                $this->set('_serialize', ['student']);
                $this->render('ResultSystem./CheckResult/termly_result');
            }
        } catch ( RecordNotFoundException $e  ) {
            $this->render('ResultSystem./Element/Error/recordnotfound');
        } catch ( \Exception $error) {
            $this->Flash->error('Error occurred: '.$error->getMessage());
        }
    }
}
