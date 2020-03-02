<?php
namespace ResultSystem\Controller;

use Cake\Collection\Collection;
use Cake\Core\Plugin;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Routing\Exception\MissingControllerException;
use ResultSystem\Controller\Traits\SearchParameterTrait;
use ResultSystem\Controller\AppController;
use ResultSystem\Model\Entity\StudentResultPin;
use Cake\ORM\Query;
/**
 * Students Controller
 *
 * @property \ResultSystem\Controller\Component\ResultSystemComponent $ResultSystem
 * @property \ResultSystem\Model\Table\StudentsTable $Students
 * @property \ResultSystem\Model\Table\StudentResultPinsTable $StudentResultPins
 * @property \ResultSystem\Model\Table\TermsTable $Terms
 * @property \App\Model\Table\SessionsTable $Sessions
 * @property \App\Model\Table\ClassesTable $Classes
 * @property \ResultSystem\Model\Table\SubjectsTable $Subjects
 * @property \ResultSystem\Model\Table\ResultGradeInputsTable $ResultGradeInputs
 * @property \ResultSystem\Model\Table\StudentClassCountsTable $StudentClassCounts
 * @property \ResultSystem\Model\Table\StudentPublishResultsTable $StudentPublishResults
 * @property \ResultSystem\Model\Table\ResultRemarkInputsTable $ResultRemarkInputs
 */
class StudentsController extends AppController
{
    use SearchParameterTrait ;

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('ResultSystem.ResultGradeInputs');
        $this->loadModel('ResultSystem.ResultRemarkInputs');
        $this->loadModel('ResultSystem.Terms');
        $this->loadModel('ResultSystem.Sessions');
        $this->loadModel('ResultSystem.Subjects');
    }
    /**
     * Index method
     * This method returns the list of all the student in the Result System Context
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $getQuery = $this->request->getQuery();
        $this->loadModel('StudentsManager.Students');
        $StudentsQuery = $this->Students->searchStudentWithCriteria($getQuery);
        $this->paginate = [
            'limit' => 50,
            'maxLimit' => 50,
            'order' => [
                'Students.status' => 'desc',
                'Students.first_name' => 'asc',
            ]
        ];
        if ($StudentsQuery instanceof Query) {
            $students = $this->paginate($StudentsQuery);
        } else {
            $students = $StudentsQuery;
        }
        $classes = $this->Students->Classes->find('list');
        $this->set(compact('students','classes','sessions'));
        $this->set('_serialize', ['students']);
    }

    /**
     * View method
     *
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $queryData = $this->request->getQuery();

        // check if the $_GET array contains any passed details
        if ( empty($queryData)) {
            $this->set('selectParameter',true); // set the value selectParameter to true
            $sessions = $this->Sessions->find('list',['limit' => 200])->toArray();
            $classes = $this->Students->Classes->find('list',['limit' => 200])->toArray();$this->loadModel('Terms');
            $terms = $this->Terms->find('list',['limit'=> 3])->toArray();
            $this->set(compact('sessions','terms','classes'));
            return ; // end the function execution here
        }
        try {
            $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs($this->ResultGradeInputs->getResultGradeInputs($queryData['session_id']));

            if (  isset($queryData['term_id'] ) && $queryData['term_id'] == 4 ) {

                $student = $this->Students->get($id, [
                    'contain' => [
                        'Classes',
                        'StudentAnnualResults' => [
                            'conditions' => [
                                'StudentAnnualResults.session_id' => $queryData['session_id'],
                                'StudentAnnualResults.class_id' => $queryData['class_id']
                            ]
                        ],
                    ]
                ]);

                // get student annual position
                $studentPosition = $this->Students->StudentPositions->find('all')
                    ->where(['student_id' => $student->id,
                        'session_id' => $queryData['session_id'],
                        'class_id'   => $queryData['class_id'],
                        'term_id'   => $queryData['term_id'],
                    ])->first();

                // get student annual subject positions
                $studentAnnualSubjectPositions = $this->Students->StudentSubjectPositions->find('all')
                    ->where(['student_id' => $student->id,
                        'session_id' => $queryData['session_id'],
                        'class_id'   => $queryData['class_id'],
                        'term_id'   => $queryData['term_id'],
                    ])->combine('subject_id','position')->toArray();

                $sessions = $this->Students->Sessions->find('list',['limit' => 200])->toArray();
                $classes = $this->Students->Classes->find('list',['limit' => 200])->toArray();

                // loads additional table classes ..
                $this->loadModel('App.Subjects');
                $this->loadModel('Terms');

                $subjects = $this->Subjects->find('list',['limit'=> 200])->toArray();
                $terms = $this->Terms->find('list',['limit'=> 200])->toArray();
                $this->set(compact('gradeInputs','student','sessions','classes','subjects','terms','studentAnnualSubjectPositions','studentPosition'));
                $this->set('_serialize', ['student']);

                $this->render('view_annual_result');
            } else {
                $student = $this->Students->get($id, [
                    'contain' => [
                        'Classes',
                        'StudentTermlyResults' => [
                            'conditions' => [
                                'StudentTermlyResults.session_id' => $queryData['session_id'],
                                'StudentTermlyResults.class_id' => $queryData['class_id'],
                                'StudentTermlyResults.term_id' => $queryData['term_id']
                            ]
                        ],
                    ]
                ]);
                // get the student position
                $studentPosition = $this->Students->StudentPositions->find('all')
                    ->where(['student_id' => $student->id,
                        'session_id' => $queryData['session_id'],
                        'class_id'   => $queryData['class_id'],
                        'term_id'    => $queryData['term_id']
                    ])->first();

                // gets the student subject positions
                $studentSubjectPositions = $this->Students->StudentSubjectPositions->find('all')
                    ->where(['student_id' => $student->id,
                        'session_id' => $queryData['session_id'],
                        'class_id'   => $queryData['class_id'],
                        'term_id'    => $queryData['term_id']
                    ])->combine('subject_id','position')->toArray();

                $sessions = $this->Students->Sessions->find('list',['limit' => 200])->toArray();
                $classes = $this->Students->Classes->find('list',['limit' => 200])->toArray();

                // loads additional table classes ..
                $this->loadModel('App.Subjects');
                $this->loadModel('Terms');

                $subjects = $this->Subjects->find('list',['limit'=> 200])->toArray();
                $terms = $this->Terms->find('list',['limit'=> 200])->toArray();
                $this->set(compact('gradeInputs','student','sessions','classes','subjects','terms','studentSubjectPositions','studentSubjectPositionsOnClassDemarcation','studentPosition'));
                $this->set('_serialize', ['student']);

                $this->render('view_termly_result');

            }

        } catch (RecordNotFoundException $e ) {
            $this->render('/Element/Error/recordnotfound');
        }
    }

    /**
     * Add method
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add( $id = null)
    {
        $queryData = $this->request->getQuery();
        try {
            $student = $this->Students->get($id,['contain'=>['Classes']]);
            if (!empty($queryData)){
                // check if the student has a result already
                $studentResultExists = $this->Students->StudentTermlyResults->getStudentResults($student->id,$queryData);
                $studentResultExists = $studentResultExists->extract('subject_id')->toArray();
                if (!empty($studentResultExists)) {
                    $this->set('studentResultExists',$studentResultExists);
                }
                $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs($this->ResultGradeInputs->getResultGradeInputs($queryData['session_id']));
                $classBlock = $this->Students->Classes->find()->select(['id','block_id'])->where(['id'=>$queryData['class_id']])->enableHydration(false)->first();
                $subjects = $this->Subjects->find('all')->where(['block_id'=>$classBlock['block_id']])->combine('id','name')->toArray();
                $remarkInputs = $this->ResultRemarkInputs->getValidRemarkInputs($queryData['session_id']);
            }
            $sessions = $this->Students->Sessions->find('list', ['limit' => 200])->toArray();
            $classes = $this->Students->Classes->find('list', ['limit' => 200])->toArray();
            $terms = $this->Terms->find('list',['limit'=> 3])->toArray();
            $this->set(compact('student', 'sessions', 'classes','subjects','terms','gradeInputs','subjectsForSelect','remarkInputs'));
            $this->set('_serialize', ['student', 'sessions', 'classes','subjects','terms','gradeInputs','subjectsForSelect','remarkInputs']);
            $this->render('add_termly_result');
        } catch (RecordNotFoundException $e ) {
            $this->render('/Element/Error/recordnotfound');
        }
    }

    public function store()
    {
        $queryData = $this->request->getQuery();
        if ($this->request->is(['patch', 'post', 'put'])) {
            try {
                $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs($this->ResultGradeInputs->getResultGradeInputs($queryData['session_id']));
                $processedResults = $this->ResultSystem->processSubmittedResults($this->request->getData('student_termly_results'),$gradeInputs);
                $studentResults = $this->Students->StudentTermlyResults->newEntities($processedResults);
                $studentRemark = $this->Students->StudentGeneralRemarks->newEntity($this->request->getData('student_general_remarks')[0]);
                if ($this->Students->StudentTermlyResults->saveMany($studentResults) AND $this->Students->StudentGeneralRemarks->save($studentRemark)) {
                    $this->Flash->success(__('The student results and remarks has been saved.'));
                    return $this->redirect($this->referer());
                } else {
                    $this->Flash->error(__('The student result and remarks could not be saved. Please, try again.'));
                    return $this->redirect($this->referer());
                }
            } catch ( \Exception $e) {
                $this->Flash->error(__($e->getMessage()));
                return $this->redirect($this->referer());
            }
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        try {
            $queryData = $this->request->getQuery();
            $sessions = $this->Students->Sessions->find('list')->toArray();
            $classes = $this->Students->Classes->find('list')->toArray();
            $subjects = $this->Subjects->find('list')->toArray();
            $terms = $this->Terms->find('list')->toArray();
            if (empty($queryData)) {
                $this->set(compact('sessions', 'classes', 'subjects', 'terms'));
                $this->render('edit_termly_result');
                return;
            }
            $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs($this->ResultGradeInputs->getResultGradeInputs($queryData['session_id']));
            $remarkInputs = $this->ResultRemarkInputs->getValidRemarkInputs($queryData['session_id']);
            if (isset($queryData['term_id']) && $queryData['term_id'] == 4) {
                $student = $this->Students->getStudentAnnualResult($id, $queryData);
                $this->set(compact('gradeInputs', 'remarkInputs', 'student', 'sessions', 'classes', 'subjects', 'terms'));
                $this->set('_serialize', ['student']);
                $this->render('edit_annual_result');
                return;
            }
            $student = $this->Students->getStudentTermlyResult($id, $queryData);
            $this->set(compact('gradeInputs', 'remarkInputs', 'student', 'sessions', 'classes', 'subjects', 'terms'));
            $this->set('_serialize', ['student']);
            $this->render('edit_termly_result');
        } catch (RecordNotFoundException $e) {
            $this->render('/Element/Error/recordnotfound');
        }
    }

    public function update($id = null)
    {
        $queryData = $this->request->getQuery();
        if (empty($queryData) ) {
            return $this->redirect($this->referer());
        }
        if ( 4 === (int)$queryData['term_id'] ) {
            $student = $this->Students->getStudentAnnualResult($id,$queryData);
        }else {
            $student = $this->Students->getStudentTermlyResult($id,$queryData);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $student = $this->Students->patchEntity($student, $this->request->getData());
            try {
                if ($this->Students->save($student)) {
                    $this->Flash->success(__('The student has been saved.'));
                } else {
                    $this->Flash->error(__('The student could not be saved. Please, try again.'));
                }
            } catch (\PDOException $exception) {
                $this->Flash->error(__($exception->getMessage()));
            }
        }
        return $this->redirect($this->referer());
    }

    public function viewStudentResultForAdmin($id = null)
    {
        try {
            $queryData = $this->request->getQuery();
            $sessions = $this->Students->Sessions->find('list')->toArray();
            $terms = $this->Terms->find('list')->toArray();
            $classes = $this->Students->Classes->find('list')->toArray();
            $this->set(compact('sessions','terms','classes'));
            if ( empty($queryData)) {
                $this->render('view_student_result_format');
                return;
            }
            $subjects = $this->Subjects->find('list')->toArray();
            $resultGradeInputs = $this->ResultGradeInputs->getResultGradeInputs($queryData['session_id']);
            $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs($resultGradeInputs);
            $gradeInputsForTableHead = $this->ResultGradeInputs->getValidGradeInputsWithAllData($resultGradeInputs);
            $remarkInputs = $this->ResultRemarkInputs->getValidRemarkInputs($queryData['session_id']);
            $this->loadModel('ResultSystem.StudentClassCounts');
            $studentsCount = $this->StudentClassCounts->getStudentsClassCount($queryData['session_id'],$queryData['class_id'],$queryData['term_id']);
            $this->loadModel('ResultSystem.Subjects');
            $subjectClassAverages = $this->Subjects->getSubjectClassAverages($queryData['session_id'],$queryData['class_id'],$queryData['term_id']);
            $this->loadModel('ResultSystem.StudentPublishResults');
            $studentResultPublishStatus = $this->StudentPublishResults->getStudentResultPublishStatus($id,$queryData['session_id'],$queryData['class_id'],$queryData['term_id']);
            // if the SkillsGrading Plugin is Loaded
            if (Plugin::loaded('SkillsGradingSystem')) {
                // Loads the Affective and Psychomotor Skills Table
                $affectiveDispositionTable = TableRegistry::get('SkillsGradingSystem.StudentsAffectiveDispositionScores');
                $psychomotorSkillsTable = TableRegistry::get('SkillsGradingSystem.StudentsPsychomotorSkillScores');
                // Finds the student Record in the Affective score table
                $studentAffectiveDispositions = $affectiveDispositionTable->getStudentAffectiveDepositions($id,$queryData['session_id'],$queryData['class_id'],$queryData['term_id']);
                // Finds the student record in the Psychomotor score table
                $studentPsychomotorSkills = $psychomotorSkillsTable->getStudentPsychomotorSkills($id,$queryData['session_id'],$queryData['class_id'],$queryData['term_id']);
                // setting the variables
                $this->set(compact('studentAffectiveDispositions','studentPsychomotorSkills'));
            }
            if (isset($queryData['term_id']) && 4 === (int)$queryData['term_id']) {

                $student = $this->Students
                    ->find()
                    ->enableHydration(false)
                    ->select(['id','first_name','last_name','class_id','photo'])
                    ->where(['id' => $id])
                    ->first();
                $studentAnnualResults = $this->Students->getStudentAnnualResultOnly($student['id'],$queryData);
                // get student annual position
                $studentPosition = $this->Students->getStudentPosition($student['id'], $queryData['session_id'], $queryData['class_id'], $queryData['term_id']);
                // get student annual subject positions
                $studentSubjectPositions = $this->Students->getStudentSubjectPositions($student['id'], $queryData['session_id'], $queryData['class_id'], $queryData['term_id']);
                //get the student remark
                $studentRemark = $this->Students->getStudentGeneralRemark($student['id'],$queryData['session_id'],$queryData['class_id'],$queryData['term_id']);
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
                $this->render('view_student_annual_result_for_admin');
            } else {
                $student = $this->Students
                    ->find()
                    ->enableHydration(false)
                    ->select(['id','first_name','last_name','class_id','photo'])
                    ->where(['id' => $id])
                    ->first();
                $studentTermlyResults = $this->Students->getStudentTermlyResultOnly($student['id'],$queryData);
                //get the student remark
                $studentRemark = $this->Students->getStudentGeneralRemark($student['id'],$queryData['session_id'],$queryData['class_id'],$queryData['term_id']);
                // get the student position
                $studentPosition = $this->Students->getStudentPosition($student['id'],$queryData['session_id'],$queryData['class_id'],$queryData['term_id']);
                // gets the student subject positions
                $studentSubjectPositions = $this->Students->getStudentSubjectPositions($student['id'],$queryData['session_id'],$queryData['class_id'],$queryData['term_id']);
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
                $this->render('view_student_termly_result_for_admin');
            }
        } catch ( RecordNotFoundException $e  ) {
            $this->render('/Element/Error/recordnotfound');
        }
    }

    public function printStudentsResults()
    {
        try {
            $queryData = $this->request->getQuery();
            $sessions = $this->Students->Sessions->find('list')->toArray();
            $terms = $this->Terms->find('list')->toArray();
            $classes = $this->Students->Classes->find('list')->toArray();
            $this->set(compact('sessions','terms','classes'));
            if ( empty($queryData)) {
                $this->render('view_student_termly_result_for_admin');
                return;
            }
            $subjects = $this->Subjects->find('list')->toArray();
            $resultGradeInputs = $this->ResultGradeInputs->getResultGradeInputs($queryData['session_id']);
            $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs($resultGradeInputs);
            $gradeInputsForTableHead = $this->ResultGradeInputs->getValidGradeInputsWithAllData($resultGradeInputs);
            $remarkInputs = $this->ResultRemarkInputs->getValidRemarkInputs($queryData['session_id']);
            $this->loadModel('ResultSystem.StudentClassCounts');
            $studentsCount = $this->StudentClassCounts->getStudentsClassCount($queryData['session_id'],$queryData['class_id'],$queryData['term_id']);
            $subjectClassAverages = $this->Subjects->getSubjectClassAverages($queryData['session_id'],$queryData['class_id'],$queryData['term_id']);

            // get all students
            $this->paginate = [
                'fields' => ['id','class_id','first_name','last_name','photo','photo_dir'],
                'limit' => 10,
                'maxLimit' => 10,
                'contain' => ['Classes'],
                'conditions' => [
                    'Students.status'   => 1,
                    'Students.class_id' => $this->request->getQuery('class_id')
                ],
                // Place the result in ascending order according to the class.
                'order' => [
                    'class_id' => 'asc'
                ],
            ];
            $students = $this->paginate($this->Students->find('all')->enableHydration(false));
            $studentsResults = null;
            $this->loadModel('ResultSystem.StudentPublishResults');
            if (Plugin::loaded('SkillsGradingSystem')) {
                // Loads the Affective and Psychomotor Skills Table
                $affectiveDispositionTable = TableRegistry::get('SkillsGradingSystem.StudentsAffectiveDispositionScores');
                $psychomotorSkillsTable = TableRegistry::get('SkillsGradingSystem.StudentsPsychomotorSkillScores');
            }
            foreach($students as $student) {
                $studentsResults[$student['id']]['studentDetails'] = $student;
                $studentsResults[$student['id']]['studentResultPublishStatus'] = $this->StudentPublishResults->getStudentResultPublishStatus($student['id'], $queryData['session_id'], $queryData['class_id'], $queryData['term_id']);
                if (Plugin::loaded('SkillsGradingSystem')) {
                    // Finds the student Record in the Affective score table
                    $studentsResults[$student['id']]['studentAffectiveDispositions'] = $affectiveDispositionTable->getStudentAffectiveDepositions($student['id'], $queryData['session_id'], $queryData['class_id'], $queryData['term_id']);
                    // Finds the student record in the Psychomotor score table
                    $studentsResults[$student['id']]['studentPsychomotorSkills'] = $psychomotorSkillsTable->getStudentPsychomotorSkills($student['id'], $queryData['session_id'], $queryData['class_id'], $queryData['term_id']);
                }

                if (   isset($queryData['term_id']) && 4 === (int)$queryData['term_id'] ) {

                    $studentsResults[$student['id']]['studentAnnualResults'] = $this->Students->getStudentAnnualResultOnly($student['id'],$queryData);
                    // get student annual position
                    $studentsResults[$student['id']]['studentPosition'] = $this->Students->getStudentPosition($student['id'],$queryData['session_id'], $queryData['class_id'], $queryData['term_id']);
                    // get student annual subject positions
                    $studentsResults[$student['id']]['studentSubjectPositions'] = $this->Students->getStudentSubjectPositions($student['id'],$queryData['session_id'],$queryData['class_id'], $queryData['term_id']);
                    //get the student remark
                    $studentsResults[$student['id']]['studentRemark'] = $this->Students->getStudentGeneralRemark($student['id'],$queryData['session_id'],$queryData['class_id'],$queryData['term_id']);
                    //$fees = $this->_getSchoolFees($this->request->query['session_id'],$this->request->query['term_id']);
                    //$nextTerm = $this->_getTermTimeTable($this->request->query['session_id'],$this->request->query['term_id']);
                } else {
                    $studentsResults[$student['id']]['studentTermlyResults'] = $this->Students->getStudentTermlyResultOnly($student['id'],$queryData);
                    //get the student remark
                    $studentsResults[$student['id']]['studentRemark'] = $this->Students->getStudentGeneralRemark($student['id'],$queryData['session_id'],$queryData['class_id'],$queryData['term_id']);
                    // get the student position
                    $studentsResults[$student['id']]['studentPosition'] = $this->Students->getStudentPosition($student['id'],$queryData['session_id'],$queryData['class_id'],$queryData['term_id']);
                    // gets the student subject positions
                    $studentsResults[$student['id']]['studentSubjectPositions'] = $this->Students->getStudentSubjectPositions($student['id'],$queryData['session_id'],$queryData['class_id'],$queryData['term_id']);
                    //$fees = $this->_getSchoolFees($this->request->query['session_id'],$this->request->query['term_id']);
                    // Next Term
                    //$nextTerm = $this->_getTermTimeTable($this->request->query['session_id'],$this->request->query['term_id']);
                }
            }
            $this->set(compact(
                        'studentsResults',
                        'gradeInputs',
                        'remarkInputs',
                        'gradeInputsForTableHead',
                        'subjects',
                        'studentsCount',
                        'fees',
                        'subjectClassAverages',
                        'nextTerm'));
            //dd($studentsResults);
        } catch ( RecordNotFoundException $e  ) {
            $this->render('/Element/Error/recordnotfound');
        }
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $queryData = $this->request->getQuery();
        $this->Students->deleteTermlyResults($id, $queryData);
        $this->Students->deleteTermlyPosition($id, $queryData);
        $this->Students->deleteTermlySubjectPositions($id, $queryData);
        $this->Flash->success(__('The student results was successfully deleted.'));
        return $this->redirect($this->request->referer());
    }
}
