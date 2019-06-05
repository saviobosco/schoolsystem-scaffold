<?php
namespace StudentAccount\Controller;

use StudentAccount\Controller\AppController;
use Cake\Core\Plugin;
use Cake\ORM\TableRegistry;

/**
 * ResultPins Controller
 *
 *
 * @method \ResultSystem\Model\Entity\StudentResultPin[] paginate($object = null, array $settings = [])
 * @property \ResultSystem\Model\Table\StudentResultPinsTable $StudentResultPins
 * @property \ResultSystem\Model\Table\StudentResultPinsTable $Students
 * @property \ResultSystem\Model\Table\SubjectsTable $Subjects
 * @property \ResultSystem\Model\Table\TermsTable $Terms
 * @property \ResultSystem\Model\Table\ResultGradeInputsTable $ResultGradeInputs
 * @property \ResultSystem\Model\Table\ResultRemarkInputsTable $ResultRemarkInputs
 * @property \ResultSystem\Model\Table\StudentPublishResultsTable $StudentPublishResults
 * @property \ResultSystem\Model\Table\StudentClassCountsTable $StudentClassCounts
 */
class ResultPinsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('ResultSystem.StudentResultPins');
        $this->loadModel('ResultSystem.Students');
        $this->loadModel('ResultSystem.ResultGradeInputs');
        $this->loadModel('ResultSystem.ResultRemarkInputs');
        $this->loadModel('ResultSystem.ResultRemarks');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $pins = $this->paginate($this->StudentResultPins->query()
            ->contain(['Terms','Sessions','Classes'])
            ->where([
                'StudentResultPins.student_id' => $this->Auth->user('id')
            ]));
        $this->set(compact('pins'));
        $this->set('_serialize', ['pins']);
    }

    /**
     * View method
     *
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        // get the pin data
        // read the result information
        try {
            // writes the session instance to a variable named session
            $session = $this->request->getQuery();
            $session['id'] = $this->Auth->user('id');
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
                $this->render('ResultSystem.Students/view_student_annual_result');
            } else {

                $student = $this->Students->get($session['id'], [
                    'contain' => [
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

                $studentMetaData = [
                    'session_id' => $session['session_id'],
                    'class_id' => $session['class_id'],
                    'term_id' => $session['term_id']
                ];

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
                $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs($this->ResultGradeInputs->getResultGradeInputs());
                $remarkInputs = $this->ResultRemarkInputs->getValidRemarkInputs();
                $gradeInputsForTableHead = $this->ResultGradeInputs->getValidGradeInputsWithAllData($this->ResultGradeInputs->getResultGradeInputs());
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
                    'studentRemark',
                    'studentMetaData'
                ));
                $this->set('_serialize', ['student']);

                $this->render('ResultSystem.Students/view_student_termly_result');
            }

        } catch ( \PDOException $exception ) {
            dd($exception->getMessage());
            $this->render('/Element/Error/recordnotfound');
        }
    }
}
