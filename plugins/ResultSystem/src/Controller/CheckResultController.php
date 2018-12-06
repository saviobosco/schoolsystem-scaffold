<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 11/1/18
 * Time: 11:37 PM
 */

namespace ResultSystem\Controller;

use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\ORM\TableRegistry;
use ResultSystem\Model\Entity\StudentResultPin;
/**
 * Class StudentsController
 * @package FrontEnd\Controller
 * @property \ResultSystem\Model\Table\StudentsTable $Students
 * @property \ResultSystem\Model\Table\SubjectsTable $Subjects
 * @property \ResultSystem\Model\Table\TermsTable $Terms
 * @property \ResultSystem\Model\Table\StudentResultPinsTable $StudentResultPins
 * @property \ResultSystem\Model\Table\ResultGradeInputsTable $ResultGradeInputs
 * @property \ResultSystem\Model\Table\ResultRemarkInputsTable $ResultRemarkInputs
 * @property \ResultSystem\Model\Table\StudentPublishResultsTable $StudentPublishResults
 * @property \ResultSystem\Model\Table\StudentClassCountsTable $StudentClassCounts
 */
class CheckResultController extends AppController
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
        Configure::write('allTerms',true); // Todo: Remove this , its a testing feature
        // allow all actions
        $this->Auth->allow();
    }

    public function checkResult()
    {
        if ($this->request->is(['patch', 'post', 'put']) ) {
            $postData = $this->request->getData();
            $pin = $this->Students->StudentResultPins->checkPin($postData['pin']);
            /* checks if the variable contains a value */
            if($pin !== null){
                if($this->_checkRequestData($pin,$postData)) {
                    $RequestSession = $this->request->getSession();
                    $sessionData = $RequestSession->read('Student');
                    return $this->redirect([
                        'action' => 'viewStudentResult',
                        '?' => [
                            'session_id' => $sessionData['session_id'],
                            'class_id' => $sessionData['class_id'],
                            'term_id' => $sessionData['term_id'],
                        ]
                    ]);
                }
            } else {
                $this->Flash->error(__('Incorrect registration number or Invalid pin'), ['key' => 'check_result']);
            }
        }
        return $this->redirect($this->request->referer());
    }

    /**
     * @param StudentResultPin $pin
     * @param $postData
     * @return bool
     * This function is the used to authenticate the students without terms
     */
    protected function _checkRequestData(StudentResultPin $pin,$postData)
    {
        $session = $this->request->session();
        if(!empty($pin->student_id)){
            // the submitted number against the stored number
            if ($pin->student_id != $postData['reg_number']) {
                $this->Flash->error(__('Incorrect registration number or Invalid pin'), ['key' => 'check_result']);
                return false;
            }
            // check if the session is Ok
            if ($pin->session_id !==  (int) $postData['session_id']) {
                $this->Flash->error(__('This pin belongs to you but the session is incorrect. Check and try again'), ['key' => 'check_result']);
                return false;
            }
            // Check if the class is ok
            if ( $pin->class_id !== (int) $postData['class_id'] ) {
                $this->Flash->error(__('This pin belongs to you but the class is incorrect. Check and try again'), ['key' => 'check_result']);
                return false;
            }

            if ( !Configure::read('allTerms')){ // Todo: change to the real term
                // Check if the term is Ok
                if ($pin->term_id !== (int) $postData['term_id']) {
                    $this->Flash->error(__('This pin belongs to you but the term is incorrect. Check and try again'), ['key' => 'check_result']);
                    return false;
                }
            }

            // If all checks are true(OK) set the user sessions .
            $session->write([
                'Student.id' => $pin->student_id,
                'Student.session_id' => $postData['session_id'],
                'Student.class_id' => $postData['class_id'],
                'Student.term_id' => $postData['term_id'],
            ]); // write to session and return true
            return true;

        }else{
            $student = $this->Students->find()->where(['id'=>$postData['reg_number']])->first();
            if (empty($student)){
                $this->Flash->error(__('Incorrect registration number or Invalid pin'), ['key' => 'check_result']);
                return false;
            }
            //update student in resultPins table
            if ($this->Students->StudentResultPins->updateStudentPin($pin,$student->id,$postData['session_id'],$postData['class_id'],$postData['term_id'])) {
                $session->write(['Student.id'=> $student->id,
                    'Student.session_id' => $postData['session_id'],
                    'Student.class_id' => $postData['class_id'],
                    'Student.term_id' => $postData['term_id'],
                ]);
                return true;
            }
            return false;
        }
    }

    public function viewStudentResult()
    {
        if ($this->request->getSession()->check('Student') !== true ){
            return $this->redirect(['action'=>'checkResult']);
        }
        $session = $this->request->getSession()->read('Student');
        $queryData = $this->request->getQuery();

        try {
            $sessions = $this->Students->Sessions->find('list')->toArray();
            $terms = $this->Terms->find('list')->toArray();
            $classes = $this->Students->Classes->find('list')->toArray();
            $this->set(compact('sessions','terms','classes'));

            $subjects = $this->Subjects->find('list')->toArray();
            $resultGradeInputs = $this->ResultGradeInputs->getResultGradeInputs();
            $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs($resultGradeInputs);
            $gradeInputsForTableHead = $this->ResultGradeInputs->getValidGradeInputsWithAllData($resultGradeInputs);
            $remarkInputs = $this->ResultRemarkInputs->getValidRemarkInputs();
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
            if (isset($session['term_id']) && 4 === (int)$session['term_id']) {

                $student = $this->Students
                    ->find()
                    ->enableHydration(false)
                    ->select(['id','first_name','last_name','class_id','photo','photo_dir'])
                    ->where(['id' => $session['id'] ])
                    ->first();
                $studentAnnualResults = $this->Students->getStudentAnnualResultOnly($student['id'],$session);
                // get student annual position
                $studentPosition = $this->Students->getStudentAnnualPosition($student['id'],$session);
                // get student annual subject positions
                $studentSubjectPositions = $this->Students->getStudentAnnualSubjectPositions($student['id'],$session['session_id'],$session['class_id']);
                //get the student remark
                $studentRemark = $this->Students->getStudentGeneralRemark($student['id'],$session['session_id'],$session['class_id'],$session['term_id']);
                //$fees = $this->_getSchoolFees($this->request->query['session_id'],$this->request->query['term_id']);
                //$nextTerm = $this->_getTermTimeTable($this->request->query['session_id'],$this->request->query['term_id']);
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
                $this->render('/Students/view_student_annual_result_for_admin');
            } else {
                $student = $this->Students
                    ->find()
                    ->enableHydration(false)
                    ->select(['id','first_name','last_name','class_id','photo','photo_dir'])
                    ->where(['id' => $session['id'] ])
                    ->first();
                $studentTermlyResults = $this->Students->getStudentTermlyResultOnly($student['id'], $session);
                //get the student remark
                $studentRemark = $this->Students->getStudentGeneralRemark($student['id'],$session['session_id'], $session['class_id'], $session['term_id']);
                // get the student position
                $studentPosition = $this->Students->getStudentTermlyPosition($student['id'], $session['session_id'], $session['class_id'], $session['term_id']);
                // gets the student subject positions
                $studentSubjectPositions = $this->Students->getStudentTermlySubjectPositions($student['id'], $session['session_id'], $session['class_id'], $session['term_id']);
                //$fees = $this->_getSchoolFees($this->request->query['session_id'],$this->request->query['term_id']);
                // Next Term
                //$nextTerm = $this->_getTermTimeTable($this->request->query['session_id'],$this->request->query['term_id']);
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
                $this->render('/Students/view_student_termly_result_for_admin');
            }
        } catch ( \PDOException $e  ) {
            $this->render('/Element/Error/recordnotfound');
        }
    }

    public function destroySession()
    {
        $this->request->getSession()->delete('Student');
        $this->Flash->success(__('Your session was successfully deactivated '));
        return $this->redirect(['action'=>'checkResult']);
    }
}