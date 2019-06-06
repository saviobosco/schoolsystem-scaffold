<?php
namespace ResultSystem\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;
use ResultSystem\Controller\AppController;
use ResultSystem\Controller\Traits\SearchParameterTrait;

/**
 * Subjects Controller
 *
 * @property \ResultSystem\Controller\Component\ResultSystemComponent $ResultSystem
 * @property \ResultSystem\Model\Table\SubjectsTable $Subjects
 * @property \App\Model\Table\SessionsTable $Sessions
 * @property \ResultSystem\Model\Table\TermsTable $Terms
 * @property \ResultSystem\Model\Table\ClassesTable $Classes
 * @property \ResultSystem\Model\Table\ResultGradeInputsTable $ResultGradeInputs
 * @property \ResultSystem\Model\Table\StudentsTable $Students
 */
class SubjectsController extends AppController
{
    use SearchParameterTrait;

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('ResultSystem.ResultGradeInputs');
        $this->loadModel('ResultSystem.Sessions');
        $this->loadModel('ResultSystem.Classes');
        $this->loadModel('ResultSystem.Terms');
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Blocks'],
            'order' => [
                'Blocks.id' => 'ASC'
            ]
        ];
        $subjects = $this->paginate($this->Subjects);

        $this->set(compact('subjects'));
        $this->set('_serialize', ['subjects']);
    }

    /**
     * View method
     *
     * @param string|null $id Subject id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        try {
            $queryData = $this->request->getQuery();
            $subject = $this->Subjects->get($id, [
                'contain' => ['Blocks']
            ]);
            $sessions = $this->Sessions->find('list',['limit' => 200])->toArray();
            $classes = $this->Classes->find('list',['limit' => 3 ])->where(['block_id' => $subject->block_id]);
            $terms = $this->Terms->find('list',['limit' => 4])->toArray();
            $this->set(compact('subject','sessions','classes','terms'));
            if ( empty($queryData) ) {
                $this->render('view_termly_subject_result');
                return;
            }
            if( isset($queryData['term_id']) && $queryData['term_id'] == 4 ) {
                $studentSubjectAnnualResults = $this->Subjects->getAnnualResults($subject->id,$queryData);
                $studentAnnualSubjectPositions = $this->Subjects->getAnnualSubjectPositions($subject->id,$queryData);
                $this->set(compact('subject','sessions','classes','terms','studentSubjectAnnualResults','studentAnnualSubjectPositions'));
                $this->set('_serialize', ['subject']);
                $this->render('view_annual_subject_result');
            } else {
                $subjectTermlyResults = $this->Subjects->getTermlyResults($subject->id,$queryData);
                // gets the student subject positions
                $subjectStudentPositions = $this->Subjects->getTermlySubjectPositions($subject->id,$queryData);
                $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs($this->ResultGradeInputs->getResultGradeInputs());
                $this->set(compact('gradeInputs','subjectStudentPositions','subjectTermlyResults'));
                $this->set('_serialize', ['subject']);
                $this->render('view_termly_subject_result');
            }
        } catch ( RecordNotFoundException $e) {
            $this->render('/Element/Error/recordnotfound');
        }
    }

    /**
     * Add methodResult
     * @param string|null $id Subject id.
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $subject = $this->Subjects->get($id,['contain'=>'Blocks']);
        $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs($this->ResultGradeInputs->getResultGradeInputs());
        $queryData = $this->request->getQuery();
        if ( !empty($queryData)){
            // check if subject has existing value for the records
            $studentResultExists = $this->Subjects->StudentTermlyResults->find('all')
                ->select(['student_id','subject_id','session_id','class_id','term_id'])
                ->where([
                    'StudentTermlyResults.subject_id' =>$id,
                    'StudentTermlyResults.session_id' =>$queryData['session_id'],
                    'StudentTermlyResults.class_id' => $queryData['class_id'],
                    'StudentTermlyResults.term_id' => $queryData['term_id']
                ])->enableHydration(false)->extract('student_id')->toArray();
            if ( !empty($studentResultExists)){
                $this->set('subjectContainsResult',$studentResultExists);
            }
            // get student with $queryData['class_id']
            $this->loadModel('ResultSystem.Students');
            $students = $this->Students->find('all')
                ->select(['id','first_name','last_name','class_id','status'])
                ->where(['class_id'=>$queryData['class_id'],'status'=>1])
                ->orderAsc('first_name')
                ->combine('id','full_name')->toArray();
            $this->set(compact('students','gradeInputs'));
        } else {
            $this->set('selectParameter',true); // set the value selectParameter to true
        }
        $sessions = $this->Sessions->find('list')->toArray();
        $classes = $this->Classes->find('list')->where(['block_id' => $subject->block_id]);
        $terms = $this->Terms->find('list',['limit' => 3])->toArray();
        $this->set(compact('subject', 'sessions','classes','terms'));
        $this->set('_serialize', ['subject','sessions','classes','terms']);
    }

    public function processAdd()
    {
        try {
            $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs($this->ResultGradeInputs->getResultGradeInputs());
            if ( $this->request->is(['put','patch','post'])) {
                $processedResults = $this->ResultSystem->processSubmittedResults($this->request->getData('student_termly_results'),$gradeInputs);
                $subjectResults = $this->Subjects->StudentTermlyResults->newEntities($processedResults);
                if ($this->Subjects->StudentTermlyResults->saveMany($subjectResults)) {
                    $this->Flash->success('The results were successfully added!');
                }else {
                    $this->Flash->error(__('The results could not be added. Please try again'));
                }
            }
        } catch ( \Exception $e) {
            $this->Flash->error('The following error occurred:'.$e->getMessage());
        }
        return $this->redirect($this->referer());
    }

    /**
     * Edit method
     *
     * @param string|null $id Subject id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        try {
            $queryData = $this->request->getQuery();
            $sessions = $this->Sessions->find('list');
            $terms  = $this->Terms->find('list');
            $this->set(compact('sessions','terms'));
            $this->set(compact('subject','classes'));
            $this->set('_serialize', ['terms','sessions']);
            if ( empty($queryData)) {
                $subject = $this->Subjects->get($id,['contain'=>'Blocks']);
                $classes = $this->Classes->find('list')->where(['block_id' => $subject->block_id]);
                $this->set(compact('subject','classes'));
                $this->render('edit_termly_subject_result');
                return;
            }
            if ( isset($queryData['term_id']) && $queryData['term_id'] == 4  ) {
                $subject = $this->Subjects->getAnnualResultWithHydration($id,$queryData);
                $classes = $this->Classes->find('list')->where(['block_id' => $subject->block_id]);
                $this->set(compact('subject','classes'));
                $this->render('edit_annual_subject_result');
            } else {
                $subject = $this->Subjects->getTermlyResultWithHydration($id,$queryData);
                $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs($this->ResultGradeInputs->getResultGradeInputs());
                $classes = $this->Classes->find('list')->where(['block_id' => $subject->block_id]);
                $this->set(compact('gradeInputs','subject','classes'));
                $this->set('_serialize', ['subject']);
                $this->render('edit_termly_subject_result');
            }
            if ($this->request->is(['patch', 'post', 'put'])) {
                $subject = $this->Subjects->StudentTermlyResults->patchEntities($subject['student_termly_results'], $this->request->getData('student_termly_results'));
                if($this->Subjects->StudentTermlyResults->saveMany($subject)) {
                    $this->Flash->success(__('The subject results was successfully updated.'));
                } else {
                    $this->Flash->error(__('The subject results could not be updated.'));
                }
                return $this->redirect($this->referer());
            }
        } catch ( \Exception $e ) {
            $this->Flash->error(__($e->getMessage()));
            return $this->redirect($this->referer());
        }
    }
}
