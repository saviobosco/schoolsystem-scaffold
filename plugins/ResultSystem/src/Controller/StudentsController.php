<?php
namespace ResultSystem\Controller;

use Cake\Collection\Collection;
use Cake\Core\Plugin;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\TableRegistry;
use ResultSystem\Controller\Traits\SearchParameterTrait;
use ResultSystem\Controller\AppController;
use ResultSystem\Model\Entity\StudentResultPin;

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
 * @property \ResultSystem\Model\Table\ResultRemarksTable $ResultRemarks
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
    }
    /**
     * Index method
     * This method returns the list of all the student in the Result System Context
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        if ( empty($this->request->getQuery('class_id'))) {
            $this->paginate = [
                'limit' => 1000,
                'maxLimit' => 1000,
                'contain' => ['Classes'],
                'conditions' => [
                    'Students.status'   => 1,
                ],
                // Place the result in ascending order according to the class.
                'order' => [
                    'class_id' => 'asc'
                ]
            ];
        }
        else {
            $this->paginate = [
                'limit' => 1000,
                'maxLimit' => 1000,
                'contain' => ['Classes'],
                'conditions' => [
                    'Students.status'   => 1,
                    'Students.class_id' => $this->request->getQuery('class_id')
                ]
            ];
        }
        $students = $this->paginate($this->Students->find('all')->enableHydration(false));
        $classes = $this->Students->Classes->find('list',['limit' => 200]);
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
            $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs();

            if (  isset($queryData['term_id'] ) && $queryData['term_id'] == 4 ) {

                $student = $this->Students->get($id, [
                    'contain' => ['Sessions',
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
                $studentPosition = $this->Students->StudentAnnualPositions->find('all')
                    ->where(['student_id' => $student->id,
                        'session_id' => $queryData['session_id'],
                        'class_id'   => $queryData['class_id'],
                    ])->first();

                // get student annual subject positions
                $studentAnnualSubjectPositions = $this->Students->StudentAnnualSubjectPositions->find('all')
                    ->where(['student_id' => $student->id,
                        'session_id' => $queryData['session_id'],
                        'class_id'   => $queryData['class_id'],
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
                $studentPosition = $this->Students->StudentTermlyPositions->find('all')
                    ->where(['student_id' => $student->id,
                        'session_id' => $queryData['session_id'],
                        'class_id'   => $queryData['class_id'],
                        'term_id'    => $queryData['term_id']
                    ])->first();

                // gets the student subject positions
                $studentSubjectPositions = $this->Students->StudentTermlySubjectPositions->find('all')
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
    public function addResult( $id = null)
    {
        $queryData = $this->request->getQuery();
        $student = $this->Students->get($id,['contain'=>['Classes']]);

        if (empty($queryData)){
            $this->set('selectParameter',true); // set the value selectParameter to true
        }else {
            $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs();
            // check if the student has a result already
            $studentResultExists = $this->Students->StudentTermlyResults->find('all')
                ->select(['student_id','subject_id'])
                ->where([
                'StudentTermlyResults.student_id' =>$id,
                'StudentTermlyResults.session_id' =>$queryData['session_id'],
                'StudentTermlyResults.class_id' => $queryData['class_id'],
                'StudentTermlyResults.term_id' => $queryData['term_id']
            ])->enableHydration(false)->extract('subject_id')->toArray();

            //debug($studentResultExists); exit;
            if (!empty($studentResultExists)) {
                $this->set('studentResultExists',$studentResultExists);
            }
            if ($this->request->is(['patch', 'post', 'put'])) {
                $processedResults = $this->ResultSystem->processSubmittedResults($this->request->getData('student_termly_results'),$gradeInputs);
                $studentResults = $this->Students->StudentTermlyResults->newEntities($processedResults);
                $studentRemark = $this->Students->StudentGeneralRemarks->newEntity($this->request->getData('student_general_remarks')[0]);
                if ($this->Students->StudentTermlyResults->saveMany($studentResults) AND $this->Students->StudentGeneralRemarks->save($studentRemark)) {
                    $this->Flash->success(__('The student results and remarks has been saved.'));
                } else {
                    $this->Flash->error(__('The student result and remarks could not be saved. Please, try again.'));
                }
            }
            $classBlock = $this->Students->Classes->find()->select(['id','block_id'])->where(['id'=>$student->class_id])->enableHydration(false)->first();
            $this->loadModel('App.Subjects');
            $subjects = $this->Subjects->find('all')->where(['block_id'=>$classBlock['block_id']])->combine('id','name')->toArray();
            $remarkInputs = $this->ResultRemarkInputs->getValidRemarkInputs();
        }

        $sessions = $this->Students->Sessions->find('list', ['limit' => 200])->toArray();
        $classes = $this->Students->Classes->find('list', ['limit' => 200])->toArray();
        $this->loadModel('Terms');
        $terms = $this->Terms->find('list',['limit'=> 3])->toArray();
        $this->set(compact('student', 'sessions', 'classes','subjects','terms','gradeInputs','subjectsForSelect','remarkInputs'));
        $this->set('_serialize', ['student']);
        $this->render('add_termly_result');
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
            $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs();
            $remarkInputs = $this->ResultRemarkInputs->getValidRemarkInputs();
            if ( isset($queryData['term_id']) && $queryData['term_id'] == 4  ) {

                $student = $this->Students->get($id, [
                    'contain' => [
                        'Classes',
                        /*'ClassDemarcations',*/
                        'StudentAnnualResults' => ['conditions' => [
                            'StudentAnnualResults.session_id' => ($queryData['session_id']) ? $queryData['session_id'] : 1,
                            'StudentAnnualResults.class_id' => ($queryData['class_id']) ? $queryData['class_id'] : 1 ,
                        ]
                        ],
                        'StudentGeneralRemarks' => [
                            'conditions' => [
                                'StudentGeneralRemarks.session_id' => ($queryData['session_id']) ? $queryData['session_id'] : 1,
                                'StudentGeneralRemarks.class_id' => ($queryData['class_id']) ? $queryData['class_id'] : 1,
                                'StudentGeneralRemarks.term_id' => ($queryData['term_id']) ? $queryData['term_id'] : 1
                            ]
                        ],
                        'StudentAnnualPositions' =>  [
                            'conditions' => [
                                'StudentAnnualPositions.session_id' => ($queryData['session_id']) ? $queryData['session_id'] : 1,
                                'StudentAnnualPositions.class_id' => ($queryData['class_id']) ? $queryData['class_id'] : 1
                            ]
                        ],
                        'StudentPublishResults' => [
                            'conditions' => [
                                'StudentPublishResults.term_id' => ($queryData['term_id']) ? $queryData['term_id'] : 1,
                                'StudentPublishResults.class_id' => ($queryData['class_id']) ? $queryData['class_id'] : 1,
                                'StudentPublishResults.session_id' => ($queryData['session_id']) ? $queryData['session_id'] : 1
                            ]
                        ]
                    ]
                ]);
                if ($this->request->is(['patch', 'post', 'put'])) {
                    $student = $this->Students->patchEntity($student, $this->request->getData());
                    if ($this->Students->save($student)) {
                        $this->Flash->success(__('The student has been saved.'));

                    } else {
                        $this->Flash->error(__('The student could not be saved. Please, try again.'));
                    }
                }

                $sessions = $this->Students->Sessions->find('list', ['limit' => 200])->toArray();
                $classes = $this->Students->Classes->find('list', ['limit' => 200])->toArray();
                $this->loadModel('App.Subjects');
                $subjects = $this->Subjects->find('list',['limit'=> 200])->toArray();
                $this->loadModel('Terms');
                $terms = $this->Terms->find('list')->toArray();
                $this->set(compact('gradeInputs','remarkInputs','student', 'sessions', 'classes','subjects','terms'));
                $this->set('_serialize', ['student']);
                $this->render('edit_annual_result');

            } else {

                $student = $this->Students->get($id, [
                    'contain' => [
                        'Classes',
                        /*'ClassDemarcations',*/
                        'StudentTermlyResults' => [
                            'conditions' => [
                            'StudentTermlyResults.session_id' => ($queryData['session_id']) ? $queryData['session_id'] : 1,
                            'StudentTermlyResults.class_id' => ($queryData['class_id']) ? $queryData['class_id'] : 1,
                            'StudentTermlyResults.term_id' => ($queryData['term_id']) ? $queryData['term_id'] : 1
                        ]
                        ],
                        'StudentGeneralRemarks' => [
                            'conditions' => [
                                'StudentGeneralRemarks.session_id' => ($queryData['session_id']) ? $queryData['session_id'] : 1,
                                'StudentGeneralRemarks.class_id' => ($queryData['class_id']) ? $queryData['class_id'] : 1,
                                'StudentGeneralRemarks.term_id' => ($queryData['term_id']) ? $queryData['term_id'] : 1,
                            ]
                        ],
                        'StudentTermlyPositions' =>  [
                            'conditions' => [
                                'StudentTermlyPositions.session_id' => ($queryData['session_id']) ? $queryData['session_id'] : 1,
                                'StudentTermlyPositions.class_id' => ($queryData['class_id']) ? $queryData['class_id'] : 1,
                                'StudentTermlyPositions.term_id' => ($queryData['term_id']) ? $queryData['term_id'] : 1
                            ]
                        ],
                        'StudentPublishResults' => [
                            'conditions' => [
                                'StudentPublishResults.term_id' => ($queryData['term_id']) ? $queryData['term_id'] : 1,
                                'StudentPublishResults.class_id' => ($queryData['class_id']) ? $queryData['class_id'] : 1,
                                'StudentPublishResults.session_id' => ($queryData['session_id']) ? $queryData['session_id'] : 1,
                            ]
                        ]
                    ]
                ]);

                if ($this->request->is(['patch', 'post', 'put'])) {
                    $student = $this->Students->patchEntity($student, $this->request->getData());
                    if ($this->Students->save($student)) {
                        $this->Flash->success(__('The student has been saved.'));

                    } else {
                        $this->Flash->error(__('The student could not be saved. Please, try again.'));
                    }
                }
                $sessions = $this->Students->Sessions->find('list', ['limit' => 200])->toArray();
                $classes = $this->Students->Classes->find('list', ['limit' => 200])->toArray();
                $this->loadModel('App.Subjects');
                $subjects = $this->Subjects->find('list',['limit'=> 200])->toArray();
                $this->loadModel('Terms');
                $terms = $this->Terms->find('list')->toArray();
                $this->set(compact('gradeInputs','remarkInputs','student', 'sessions', 'classes','subjects','terms'));
                $this->set('_serialize', ['student']);
                $this->render('edit_termly_result');
            }

        } catch (RecordNotFoundException $e ) {
            $this->render('/Element/Error/recordnotfound');
        }

    }

    /**
     * Delete method
     *
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteStudentResultRow($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subject = $this->Students->StudentTermlyResults->find('all')->where(['id'=>$id])->first();
        if ($this->Students->StudentTermlyResults->delete($subject)) {
            $this->Flash->success(__('The record has been deleted.'));
        } else {
            $this->Flash->error(__('The record could not be deleted. Please, try again.'));
        }
        return $this->redirect($this->referer());
    }

    public function viewStudentResultForAdmin($id = null )
    {
        $this->loadModel('ResultSystem.ResultRemarks');
        try {
            $queryData = $this->request->getQuery();
            if (   isset($queryData['term_id']) && $queryData['term_id'] == 4 ) {

                $student = $this->Students->get($id, [
                    'contain' => [
                        'StudentAnnualResults' => [
                            'conditions' => [
                                'StudentAnnualResults.session_id' => @$queryData['session_id'],
                                'StudentAnnualResults.class_id' => @$queryData['class_id'],
                            ]
                        ]
                    ]
                ]);

                // get student annual position
                $studentPosition = $this->Students->StudentAnnualPositions->find('all')
                    ->where(['student_id' => $student->id,
                        'session_id' => @$queryData['session_id'],
                        'class_id' => @$queryData['class_id'],
                    ])->first();

                $this->loadModel('ResultSystem.StudentClassCounts');
                $studentsCount = $this->StudentClassCounts->getStudentsClassCount($queryData['session_id'],$queryData['class_id'],$queryData['term_id']);

                // get student annual subject positions
                $studentAnnualSubjectPositions = $this->Students->getStudentAnnualSubjectPositions($student->id,$queryData['session_id'],$queryData['class_id']);

                //get the student remark
                $studentRemark = $this->Students->getStudentGeneralRemark($student->id,$queryData['session_id'],$queryData['class_id'],$queryData['term_id']);

                // if the SkillsGrading Plugin is Loaded
                if (Plugin::loaded('SkillsGradingSystem')) {
                    // Loads the Affective and Psychomotor Skills Table
                    $affectiveDispositionTable = TableRegistry::get('SkillsGradingSystem.StudentsAffectiveDispositionScores');
                    $psychomotorSkillsTable = TableRegistry::get('SkillsGradingSystem.StudentsPsychomotorSkillScores');

                    // Finds the student Record in the Affective score table
                    $studentAffectiveDispositions = $affectiveDispositionTable->getStudentAffectiveDepositions($student->id,$queryData['session_id'],$queryData['class_id'],$queryData['term_id']);


                    // Finds the student record in the Psychomotor score table
                    $studentPsychomotorSkills = $psychomotorSkillsTable->getStudentPsychomotorSkills($student->id,$queryData['session_id'],$queryData['class_id'],$queryData['term_id']);

                    // setting the variables
                    $this->set(compact('studentAffectiveDispositions','studentPsychomotorSkills'));
                }
                //Getting Result Publish Status
                $this->loadModel('ResultSystem.StudentPublishResults');
                $studentResultPublishStatus = $this->StudentPublishResults->getStudentResultPublishStatus($student->id,$queryData['session_id'],$queryData['class_id'],$queryData['term_id']);

                // loads additional table classes ..
                $this->loadModel('App.Subjects');
                $this->loadModel('ResultSystem.Terms');

                //$fees = $this->_getSchoolFees($this->request->query['session_id'],$this->request->query['term_id']);
                //$nextTerm = $this->_getTermTimeTable($this->request->query['session_id'],$this->request->query['term_id']);

                $sessions = $this->Students->Sessions->find('list')->toArray();
                $classes = $this->Students->Classes->find('list')->toArray();
                $subjects = $this->Subjects->find('list')->toArray();
                $terms = $this->Terms->find('list')->toArray();
                $remarkInputs = $this->ResultRemarkInputs->getValidRemarkInputs();
                $resultRemarkDetails = $this->ResultRemarks->getResultRemarkFullNameWithPassedDetails($queryData['session_id'],$queryData['class_id']);
                $this->set(compact('student',
                    'remarkInputs',
                    'studentRemark',
                    'resultRemarkDetails',
                    'fees',
                    'sessions',
                    'classes',
                    'subjects',
                    'studentAnnualSubjectPositions',
                    'terms',
                    'studentPosition',
                    'studentResultPublishStatus',
                    'studentsCount',
                    'nextTerm'
                ));
                $this->set('_serialize', ['student']);

                $this->render('view_student_annual_result_for_admin');

            } else {

                $student = $this->Students->get($id, [
                    'contain' => [
                        'StudentTermlyResults' => [
                            'conditions' => [
                                'StudentTermlyResults.session_id' => @$queryData['session_id'],
                                'StudentTermlyResults.class_id' => @$queryData['class_id'],
                                'StudentTermlyResults.term_id' => @$queryData['term_id']
                            ]
                        ],
                    ]
                ]);
                //get the student remark
                $studentRemark = $this->Students->getStudentGeneralRemark($student->id,$queryData['session_id'],$queryData['class_id'],$queryData['term_id']);

                // get the student position
                $studentPosition = $this->Students->getStudentTermlyPosition($student->id,$queryData['session_id'],$queryData['class_id'],$queryData['term_id']);

                // gets the student subject positions
                $studentSubjectPositions = $this->Students->getStudentTermlySubjectPositions($student->id,$queryData['session_id'],$queryData['class_id'],$queryData['term_id']);

                //Getting Result Publish Status
                $this->loadModel('ResultSystem.StudentPublishResults');
                $studentResultPublishStatus = $this->StudentPublishResults->getStudentResultPublishStatus($student->id,$queryData['session_id'],$queryData['class_id'],$queryData['term_id']);

                // if the SkillsGrading Plugin is Loaded
                if (Plugin::loaded('SkillsGradingSystem')) {
                    // Loads the Affective and Psychomotor Skills Table
                    $affectiveDispositionTable = TableRegistry::get('SkillsGradingSystem.StudentsAffectiveDispositionScores');
                    $psychomotorSkillsTable = TableRegistry::get('SkillsGradingSystem.StudentsPsychomotorSkillScores');

                    // Finds the student Record in the Affective score table
                    $studentAffectiveDispositions = $affectiveDispositionTable->getStudentAffectiveDepositions($student->id,$queryData['session_id'],$queryData['class_id'],$queryData['term_id']);


                    // Finds the student record in the Psychomotor score table
                    $studentPsychomotorSkills = $psychomotorSkillsTable->getStudentPsychomotorSkills($student->id,$queryData['session_id'],$queryData['class_id'],$queryData['term_id']);

                    // setting the variables
                    $this->set(compact('studentAffectiveDispositions','studentPsychomotorSkills'));
                }

                $this->loadModel('ResultSystem.StudentClassCounts');
                $studentsCount = $this->StudentClassCounts->getStudentsClassCount($queryData['session_id'],$queryData['class_id'],$queryData['term_id']);

                $this->loadModel('ResultSystem.Subjects');
                $subjectClassAverages = $this->Subjects->getSubjectClassAverages($queryData['session_id'],$queryData['class_id'],$queryData['term_id']);

                // loads additional table classes ..
                $this->loadModel('Terms');

                //$fees = $this->_getSchoolFees($this->request->query['session_id'],$this->request->query['term_id']);
                // Next Term
                //$nextTerm = $this->_getTermTimeTable($this->request->query['session_id'],$this->request->query['term_id']);

                $sessions = $this->Students->Sessions->find('list')->toArray();
                $subjects = $this->Subjects->find('list')->toArray();
                $terms = $this->Terms->find('list')->toArray();
                $classes = $this->Students->Classes->find('list')->toArray();
                $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs();
                $remarkInputs = $this->ResultRemarkInputs->getValidRemarkInputs();
                $resultRemarkDetails = $this->ResultRemarks->getResultRemarkFullNameWithPassedDetails($queryData['session_id'],$queryData['class_id']);
                $gradeInputsForTableHead = $this->ResultGradeInputs->getValidGradeInputsWithAllData();
                $this->set(compact('student',
                    'gradeInputs',
                    'remarkInputs',
                    'resultRemarkDetails',
                    'gradeInputsForTableHead',
                    'sessions',
                    'subjects',
                    'terms',
                    'classes',
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

    public function annualPromotion()
    {
        $queryData = $this->request->getQuery();
        if ( !empty($queryData) AND !$this->request->is(['put','patch','post'])) {
            $students = $this->Students->find('all')
                ->contain([
                    'classes',
                    'StudentAnnualPositions' => function($q) use ($queryData) {
                        return $q->where(['StudentAnnualPositions.session_id'=>$queryData['session_id'],'StudentAnnualPositions.class_id'=>$queryData['class_id']]);
                    }
                ])
                ->where(['Students.status'=>1,'Students.class_id'=>$queryData['class_id']])
                ->enableHydration(false)->toArray();
        }
        $sessions = $this->Students->Sessions->find('list')->toArray();
        $classes = $this->Students->Classes->find('list',['limit' => 200]);
        $this->set(compact('students','classes','sessions'));
        $this->set('_serialize', ['students']);

        // processing the post request
        if ( $this->request->is(['put','patch','post'])) {
            // get student annual subject positions
            $studentAnnualPositions = $this->Students->StudentAnnualPositions->find('all')->where(['session_id'=>$queryData['session_id'],'class_id'=>$queryData['class_id']])->toArray();
            $studentAnnualPositions = $this->Students->StudentAnnualPositions->patchEntities($studentAnnualPositions,$this->request->getData('student_annual_positions'));
            //debug($studentAnnualPositions);
            foreach ( $studentAnnualPositions as $studentAnnualPosition) {
                $this->Students->StudentAnnualPositions->save($studentAnnualPosition);
            }
            $this->Flash->success('The action was successful!');
        }
    }

    public function publishResults()
    {
        // set the required variables for selecting parameters
        $sessions = $this->Students->Sessions->find('list',['limit' => 200]);
        $classes = $this->Students->Classes->find('list',['limit' => 200]);
        $this->loadModel('ResultSystem.Terms');
        $terms = $this->Terms->find('list');
        $this->set(compact('sessions','classes','terms'));

        // checking if their is any $_GET parameter specified
        $queryData = $this->request->getQuery();
        $postData = $this->request->getData();
        if ( empty($queryData)) {
            $this->set('selectParameter',true);
            return;
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->loadModel('ResultSystem.StudentPublishResults');
            $resultPublished = $this->StudentPublishResults->publishResults($postData,$queryData);
            if ( $resultPublished === 0 ) {
                $this->Flash->error(__('No Result was published'));
            }else {
                $this->Flash->success(__('{0} results were successfully published',$resultPublished));
            }
        }

        if ( !empty($queryData['class_id'])) {
            $this->paginate = [
                'limit' => 1000,
                'maxLimit' => 1000,
                'contain' => [
                    'StudentPublishResults' => [
                        'conditions' => [
                            'StudentPublishResults.term_id' => $queryData['term_id'],
                            'StudentPublishResults.class_id' => $queryData['class_id'],
                            'StudentPublishResults.session_id' => $queryData['session_id'],
                        ]
                    ]
                ],
                'conditions' => [
                    'Students.status'   => 1,
                    'Students.class_id' => $queryData['class_id']
                ],
            ];
        }
        $students = $this->paginate($this->Students);

        $this->set(compact('students'));
        $this->set('_serialize', ['students']);
    }
}
