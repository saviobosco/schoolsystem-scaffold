<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 12/15/17
 * Time: 1:22 AM
 */

namespace FrontEnd\Controller;
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
 * @property \ResultSystem\Model\Table\ResultRemarksTable $ResultRemarks
 * @property \ResultSystem\Model\Table\StudentPublishResultsTable $StudentPublishResults
 * @property \ResultSystem\Model\Table\StudentClassCountsTable $StudentClassCounts
 */
class StudentsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('ResultSystem.Students');
        $this->loadModel('ResultSystem.ResultGradeInputs');
        $this->loadModel('ResultSystem.ResultRemarkInputs');
        $this->loadModel('ResultSystem.ResultRemarks');

        Configure::write('allTerms',true); // Todo: Remove this , its a testing feature
    }

    public function checkResult()
    {
        if ($this->request->is(['patch', 'post', 'put']) ) {
            $postData = $this->request->getData();
            $pin = $this->Students->StudentResultPins->checkPin($postData['pin']);
            /* checks if the variable contains a value */
            if($pin !== null){
                if($this->_checkStudentResultAuthenticationKeys($pin,$postData)) {
                    // if everything is ok redirect to result page
                    //echo 'This is good'; exit;
                    return $this->redirect(['action' => 'viewStudentResult']);
                }
            } else {
                $this->Flash->error(__('Incorrect registration number or Invalid pin'));
            }
        }
        $sessions = $this->Students->Sessions->find('list',['limit' => 200 ]);
        $classes = $this->Students->Classes->find('list',['limit' => 200 ]);
        $this->loadModel('ResultSystem.Terms');
        $terms = $this->Terms->find('list',['limit'=> 4 ]);
        $this->set(compact('sessions','terms','classes'));
    }

    /**
     * @param StudentResultPin $pin
     * @param $postData
     * @return bool
     * This function is the used to authenticate the students without terms
     */
    protected function _checkStudentResultAuthenticationKeys(StudentResultPin $pin,$postData)
    {
        $session = $this->request->session();
        if(!empty($pin->student_id)){
            // the submitted number against the stored number
            if ($pin->student_id != $postData['reg_number']) {
                $this->Flash->error(__('Incorrect registration number or Invalid pin'));
                return false;
            }
            // check if the session is Ok
            if ($pin->session_id !==  (int) $postData['session_id']) {
                $this->Flash->error(__('This pin belongs to you but the session is incorrect. Check and try again'));
                return false;
            }
            // Check if the class is ok
            if ( $pin->class_id !== (int) $postData['class_id'] ) {
                $this->Flash->error(__('This pin belongs to you but the class is incorrect. Check and try again'));
                return false;
            }

            if ( !Configure::read('allTerms')){ // Todo: change to the real term
                // Check if the term is Ok
                if ($pin->term_id !== (int) $postData['term_id']) {
                    $this->Flash->error(__('This pin belongs to you but the term is incorrect. Check and try again'));
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
                $this->Flash->error(__('Incorrect registration number or Invalid pin'));
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

        try {
            // writes the session instance to a variable named session
            $session = $this->request->getSession()->read('Student');
            $queryData = $this->request->getQuery();

            if ( ($session['term_id'] == 4) OR (isset($queryData['term_id']) && $queryData['term_id'] == 4) ) {

                $student = $this->Students->get($session['id'], [
                    'contain' => [
                        'Sessions',
                        'Classes',
                        'StudentAnnualResults' => [
                            'conditions' => [
                                'StudentAnnualResults.session_id' => $session['session_id'],
                                'StudentAnnualResults.class_id' => $session['class_id'],
                            ]
                        ],
                    ]
                ]);
                // get student annual position
                $studentPosition = $this->Students->StudentAnnualPositions->find('all')
                    ->where(['student_id' => $student->id,
                        'session_id' => $session['session_id'],
                        'class_id' => $session['class_id'],
                    ])->first();

                // get student annual subject positions
                $studentAnnualSubjectPositions = $this->Students->getStudentAnnualSubjectPositions($student->id,$session['session_id'],$session['class_id']);

                // if the SkillsGrading Plugin is Loaded
                if (Plugin::loaded('SkillsGradingSystem')) {
                    // Loads the Affective and Psychomotor Skills Table
                    $affectiveDispositionTable = TableRegistry::get('SkillsGradingSystem.StudentsAffectiveDispositionScores');
                    $psychomotorSkillsTable = TableRegistry::get('SkillsGradingSystem.StudentsPsychomotorSkillScores');

                    // Finds the student Record in the Affective score table
                    $studentAffectiveDispositions = $affectiveDispositionTable->getStudentAffectiveDepositions($student->id,$session['session_id'],$session['class_id'],4);


                    // Finds the student record in the Psychomotor score table
                    $studentPsychomotorSkills = $psychomotorSkillsTable->getStudentPsychomotorSkills($student->id,$session['session_id'],$session['class_id'],4);

                    // setting the variables
                    $this->set(compact('studentAffectiveDispositions','studentPsychomotorSkills'));
                }

                //Getting Result Publish Status
                $this->loadModel('ResultSystem.StudentPublishResults');
                $studentResultPublishStatus = $this->StudentPublishResults->getStudentResultPublishStatus($student->id,$session['session_id'],$session['class_id'],4);

                // loads additional table classes ..
                $this->loadModel('ResultSystem.Subjects');
                $this->loadModel('Terms');
                $sessions = $this->Students->Sessions->find('list',['limit' => 200])->toArray();
                $classes = $this->Students->Classes->find('list',['limit' => 200])->toArray();
                $subjects = $this->Subjects->find('list',['limit'=> 200])->toArray();
                $terms = $this->Terms->find('list',['limit'=> 200])->toArray();
                $searchTerms = $this->Terms->find('list',['limit'=> 2])->where(['id >= '=> 3 ])->toArray();
                $this->set(compact('student','sessions','classes','subjects','terms','searchTerms','studentAnnualSubjectPositions','studentPosition','studentResultPublishStatus'));
                $this->set('_serialize', ['student']);
                $this->render('view_student_annual_result');
            } else {

                $student = $this->Students->get($session['id'], [
                    'contain' => [
                        'Sessions',
                        'Classes',
                        'StudentTermlyResults' => [
                            'conditions' => [
                                'StudentTermlyResults.session_id' =>$session['session_id'],
                                'StudentTermlyResults.class_id' => $session['class_id'],
                                'StudentTermlyResults.term_id' => $session['term_id']
                            ]
                        ],
                    ]
                ]);

                // get the student position
                $studentPosition = $this->Students->getStudentTermlyPosition($student->id,$session['session_id'],$session['class_id'],$session['term_id']);

                //get the student remark
                $studentRemark = $this->Students->getStudentGeneralRemark($student->id,$session['session_id'],$session['class_id'],$session['term_id']);

                // gets the student subject positions
                $studentSubjectPositions = $this->Students->getStudentTermlySubjectPositions($student->id,$session['session_id'],$session['class_id'],$session['term_id']);

                //Getting Result Publish Status
                $this->loadModel('ResultSystem.StudentPublishResults');
                $studentResultPublishStatus = $this->StudentPublishResults->getStudentResultPublishStatus($student->id,$session['session_id'],$session['class_id'],$session['term_id']);


                // if the SkillsGrading Plugin is Loaded
                if (Plugin::loaded('SkillsGradingSystem')) {
                    // Loads the Affective and Psychomotor Skills Table
                    $affectiveDispositionTable = TableRegistry::get('SkillsGradingSystem.StudentsAffectiveDispositionScores');
                    $psychomotorSkillsTable = TableRegistry::get('SkillsGradingSystem.StudentsPsychomotorSkillScores');

                    // Finds the student Record in the Affective score table
                    $studentAffectiveDispositions = $affectiveDispositionTable->getStudentAffectiveDepositions($student->id,$session['session_id'],$session['class_id'],$session['term_id']);


                    // Finds the student record in the Psychomotor score table
                    $studentPsychomotorSkills = $psychomotorSkillsTable->getStudentPsychomotorSkills($student->id,$session['session_id'],$session['class_id'],$session['term_id']);

                    // setting the variables
                    $this->set(compact('studentAffectiveDispositions','studentPsychomotorSkills'));
                }

                $this->loadModel('ResultSystem.StudentClassCounts');
                $studentsCount = $this->StudentClassCounts->getStudentsClassCount($session['session_id'],$session['class_id'],$session['term_id']);

                // loads additional table classes ..
                $this->loadModel('ResultSystem.Subjects');
                $this->loadModel('Terms');

                $sessions = $this->Students->Sessions->find('list')->toArray();
                $classes = $this->Students->Classes->find('list')->toArray();
                $subjects = $this->Subjects->find('list',['limit'=> 200])->toArray();
                $terms = $this->Terms->find('list',['limit'=> 4])->toArray();
                $searchTerms = $this->Terms->find('list',['limit'=> 2])->where(['id >= '=> 3 ])->toArray();
                $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs();
                $remarkInputs = $this->ResultRemarkInputs->getValidRemarkInputs();
                $resultRemarkDetails = $this->ResultRemarks->getResultRemarkFullNameWithPassedDetails($session['session_id'],$session['class_id']);
                $gradeInputsForTableHead = $this->ResultGradeInputs->getValidGradeInputsWithAllData();
                $this->set(compact('student',
                    'gradeInputs',
                    'remarkInputs',
                    'resultRemarkDetails',
                    'gradeInputsForTableHead',
                    'sessions',
                    'classes',
                    'subjects',
                    'terms',
                    'searchTerms',
                    'studentSubjectPositions',
                    'studentSubjectPositionsOnClassDemarcation',
                    'studentPosition',
                    'studentsCount',
                    'studentResultPublishStatus',
                    'studentRemark'
                ));
                $this->set('_serialize', ['student']);

                $this->render('view_student_termly_result');
            }

        } catch ( \PDOException $e ) {
            $this->render('/Element/Error/recordnotfound');
        }
    }

    protected function getDefaultValue($expectValue,$defaultValue)
    {
        if(isset($expectValue) AND !empty($expectValue)) {
            return $expectValue;
        } else {
            return $defaultValue;
        }
    }

    public function destroySession()
    {
        $this->request->getSession()->delete('Student');
        $this->Flash->success(__('Your session was successfully deactivated '));
        return $this->redirect(['action'=>'checkResult']);
    }
}