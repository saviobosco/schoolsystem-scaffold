<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 11/1/18
 * Time: 11:37 PM
 */

namespace ResultSystem\Controller;

use Cake\Cache\Cache;
use Cake\Chronos\Chronos;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\TableRegistry;
use ResultSystem\Model\Entity\StudentResultPin;
use Settings\Core\Setting;
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
        $this->loadModel('ResultSystem.StudentPublishResults');
        // allow all actions
        $this->Auth->allow();
    }

    public function checkResult()
    {
        if ($this->request->is(['patch', 'post', 'put']) ) {
            $postData = $this->request->getData();
            $admission_number = (isset($postData['admission_number']) && !empty($postData['admission_number'])) ? $postData['admission_number'] : false ;
            $pin = (isset($postData['pin']) && !empty($postData['pin'])) ? $postData['pin'] : false ;
            $class_id = (isset($postData['class_id']) && !empty($postData['class_id'])) ? $postData['class_id'] : false ;
            $session_id = (isset($postData['session_id']) && !empty($postData['session_id'])) ? $postData['session_id'] : false ;
            $term_id = (isset($postData['term_id']) && !empty($postData['term_id'])) ? $postData['term_id'] : false ;

            if ($admission_number && $pin && $class_id && $session_id && $term_id) {
                $pin = $this->Students->StudentResultPins->checkPin($postData['pin']);
                /* checks if the variable contains a value */
                if($pin !== null){
                    if($this->_checkRequestData($pin,$postData)) {
                        $RequestSession = $this->request->getSession();
                        $sessionData = $RequestSession->read('Student');
                        return $this->redirect([
                            'action' => 'viewStudentResult',
                            '?' => [
                                'id' => $sessionData['id'],
                                'session_id' => $sessionData['session_id'],
                                'class_id' => $sessionData['class_id'],
                                'term_id' => $sessionData['term_id'],
                                'ts' => $sessionData['ts']
                            ]
                        ]);
                    }
                } else {
                    $this->Flash->error(__('Invalid pin'));
                }
            } else {
                // missing required data
            }
        }
        return $this->redirect($this->request->referer());
    }

    /**
     * @param StudentResultPin $pin
     * @param $postData
     * @return bool
     */
    protected function _checkRequestData(StudentResultPin $pin,$postData)
    {
        if(!empty($pin->student_id)){
            // the submitted number against the stored number
            if ($pin->student_id !== $postData['admission_number']) {
                $this->Flash->error(__('Sorry this pin has been used by another student.'));
                return false;
            }
            // check if the session is Ok
            if ($pin->session_id !==  (int) $postData['session_id']) {
                $this->Flash->error(__('This pin has been used by you, but the session selected is incorrect. Please try again'));
                return false;
            }
            // Check if the class is ok
            if ( $pin->class_id !== (int) $postData['class_id'] ) {
                $this->Flash->error(__('This pin has been used by you, but the class selected is incorrect. Please try again'));
                return false;
            }

            if (! Setting::read('Application.use_result_pin_for_all_terms')){
                // Check if the term is Ok
                if ($pin->term_id !== (int) $postData['term_id']) {
                    $this->Flash->error(__('This pin has been used by you, but the term selected is incorrect. Please try again'));
                    return false;
                }
            }
            // If all checks are true(OK) set the user sessions .
            $this->storeResultDetails([
                'id' => $pin->student_id,
                'session_id' => $postData['session_id'],
                'class_id' => $postData['class_id'],
                'term_id' => $postData['term_id'],
            ]);
            return true;

        }else{
            $student = $this->Students->find()->where(['id'=>$postData['admission_number']])->first();
            if (empty($student)){
                $this->Flash->error(__('The registration number does not exist.'));
                return false;
            }
            //update student in resultPins table
            if ($this->Students->StudentResultPins->updateStudentPin($pin,$student->id,$postData['session_id'],$postData['class_id'],$postData['term_id'])) {
                $this->storeResultDetails([
                    'id'=> $student->id,
                    'session_id' => $postData['session_id'],
                    'class_id' => $postData['class_id'],
                    'term_id' => $postData['term_id'],
                ]);
                return true;
            }
            return false;
        }
    }

    /**
     * Todo: optimize code. Get only student Current Term, Session and term
     */
    public function viewStudentResult()
    {
        $queryData = $this->request->getQuery();
        $session = Cache::read(@$queryData['id'].'-'.@$queryData['ts']); // Used the cache to store the session data.
        if (!$session) {
            return $this->redirect($this->request->referer());
        }
        // if the user is in third term result, the system can also show the annual result
        // if the user changes the term from the query
        if (3 === (int) $session['term_id'] && 4 === (int) $queryData['term_id']) {
            $session['term_id'] = 4;
        }
        try {
            $sessions = $this->Students->Sessions->find('list')->toArray();
            $terms = $this->Terms->find('list')->toArray();
            $classes = $this->Students->Classes->find('list')->toArray();
            $this->set(compact('sessions','terms','classes'));


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
            if ((isset($session['term_id']) && 4 === (int)$session['term_id']) ) {
                $session['term_id'] = 4;
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
                $this->render('/CheckResult/annual_result');
            } else {
                $student = $this->Students
                    ->find()
                    ->enableHydration(false)
                    ->select(['id','first_name','last_name','class_id','photo','photo_dir'])
                    ->where(['id' => $session['id'] ])
                    ->first();
                $studentTermlyResults = $this->Students->getStudentTermlyResultOnly($student['id'], $session);
                //dd($studentTermlyResults);
                //get the student remark
                $studentRemark = $this->Students->getStudentGeneralRemark($student['id'],$session['session_id'], $session['class_id'], $session['term_id']);
                // get the student position
                $studentPosition = $this->Students->getStudentTermlyPosition($student['id'], $session['session_id'], $session['class_id'], $session['term_id']);
                // gets the student subject positions
                $studentSubjectPositions = $this->Students->getStudentTermlySubjectPositions($student['id'], $session['session_id'], $session['class_id'], $session['term_id']);
                $resultGradeInputs = $this->ResultGradeInputs->getResultGradeInputs();
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
                $this->render('/CheckResult/termly_result');
            }
        } catch ( RecordNotFoundException $e  ) {
            $this->render('/Element/Error/recordnotfound');
        } catch ( \Exception $error) {
            $this->Flash->error('Error occurred: '.$error->getMessage());
            $this->render('/Students/view_student_termly_result_for_admin');
        }
    }

    protected function storeResultDetails($data)
    {
        $timestamp = Chronos::now()->timestamp;
        Cache::write($data['id'].'-'.$timestamp,[
            'id'=> $data['id'],
            'session_id' => $data['session_id'],
            'class_id' => $data['class_id'],
            'term_id' => $data['term_id']
        ]);
        $this->request->getSession()->write([
            'Student.id'=> $data['id'],
            'Student.session_id' => $data['session_id'],
            'Student.class_id' => $data['class_id'],
            'Student.term_id' => $data['term_id'],
            'Student.ts' => $timestamp
        ]);
    }

    public function getStudent()
    {
        $this->response = $this->response->withType('application/json');
        $queryData = $this->request->getQuery();
        if (!$this->request->is('get')) {
            return $this->response->withStatus(405)->withStringBody(json_encode(['Error' => 'Method not allowed']));
        }
        if (isset($queryData['student_id']) && !empty($queryData['student_id'])) {
            // get the student
            $student = $this->Students->query()
                ->select(['id', 'first_name', 'last_name', 'class_id'])
                ->contain(['Classes' => function($query) {
                    $query->select(['id', 'class']);
                    return $query;
                } ])
                ->where(['Students.id' => $queryData['student_id']])
                ->first();
            if ($student) {
                return $this->response->withStatus(200)
                    ->withStringBody(json_encode($student));
            } else {
                return $this->response->withStatus(404)
                    ->withStringBody(json_encode(['Error' => 'Student Record Not Found!']));
            }
        } else {
            return $this->response->withStatus(400)
                ->withStringBody(json_encode(['Error' => 'Missing required detail']));
        }
    }

    public function getStudentResultSessions()
    {
        $this->response = $this->response->withType('application/json');
        $queryData = $this->request->getQuery();
        if (!$this->request->is('get')) {
            return $this->response->withStatus(405)->withStringBody(json_encode(['Error' => 'Method not allowed']));
        }
        if ((isset($queryData['student_id']) && !empty($queryData['student_id'])) &&
            (isset($queryData['class_id']) && !empty($queryData['class_id']))
        ) {
            $currentSession = Setting::read('Application.current_session');
            $studentPublishedResultSessions = $this->StudentPublishResults->query()
                ->select(['session_id'])
                ->distinct(['session_id'])
                ->contain(['Sessions' => function($query) {
                    $query->select(['id', 'session']);
                    return $query;
                }])
                ->where([
                    'student_id' => $queryData['student_id'],
                    'class_id' => $queryData['class_id'],
                    'status' => 1
                ])
                //->orderDesc('StudentPublishResults.created')
                ->all()
                ->map(function($value) use ($currentSession) {
                    if ($value->session->id === (int) $currentSession) {
                        $value->session->session .= ' - Current Session';
                    }
                    return $value->session;
                });
            if ($studentPublishedResultSessions) {
                return $this->response->withStatus(200)
                    ->withStringBody(json_encode($studentPublishedResultSessions));
            } else {
                return $this->response->withStatus(404)
                    ->withStringBody(json_encode(['Error' => 'Student Result Sessions Not Found!']));
            }
        } else {
            return $this->response->withStatus(400)
                ->withStringBody(json_encode(['Error' => 'Missing required detail']));
        }
    }


    public function getStudentResultTerms()
    {
        $this->response = $this->response->withType('application/json');
        $queryData = $this->request->getQuery();
        if (!$this->request->is('get')) {
            return $this->response->withStatus(405)->withStringBody(json_encode(['Error' => 'Method not allowed']));
        }

        if ((isset($queryData['student_id']) && !empty($queryData['student_id'])) &&
            (isset($queryData['session_id']) && !empty($queryData['session_id']) )
        ) {
            $studentPublishedResultSessions = $this->StudentPublishResults->query()
                ->select(['term_id'])
                ->contain(['Terms' => function($query) {
                    $query->select(['id', 'name']);
                    return $query;
                }])
                ->where([
                    'student_id' => $queryData['student_id'],
                    'class_id' => $queryData['class_id'],
                    'session_id' => $queryData['session_id'],
                    'status' => 1
                ])
                ->all()
                ->map(function($value) {
                    return $value->term;
                });
            if ($studentPublishedResultSessions) {
                return $this->response->withStatus(200)
                    ->withStringBody(json_encode($studentPublishedResultSessions));
            } else {
                return $this->response->withStatus(404)
                    ->withStringBody(json_encode(['Error' => 'Student Result Sessions Not Found!']));
            }
        } else {
            return $this->response->withStatus(400)
                ->withStringBody(json_encode(['Error' => 'Missing required detail']));
        }
    }

}