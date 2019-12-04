<?php
namespace TeacherAccount\Controller;

use TeacherAccount\Controller\AppController;
use Cake\ORM\TableRegistry;
use Settings\Core\Setting;
use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * StudentsResults Controller
 * @property \ResultSystem\Model\Table\ResultGradeInputsTable $ResultGradeInputs
 * @property \ResultSystem\Controller\Component\ResultSystemComponent $ResultSystem
 * @property \ResultSystem\Model\Table\SubjectsTable $Subjects
 * @property \App\Model\Table\SessionsTable $Sessions
 * @property \ResultSystem\Model\Table\TermsTable $Terms
 * @property \ResultSystem\Model\Table\ClassesTable $Classes
 *
 */
class StudentsResultsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('ResultSystem.ResultSystem');
        $this->loadModel('ResultSystem.ResultGradeInputs');
        $this->loadModel('ResultSystem.Sessions');
        $this->loadModel('ResultSystem.Classes');
        $this->loadModel('ResultSystem.Terms');
        $this->loadModel('ResultSystem.Subjects');
    }

    public function add()
    {
        $sessions = [];
        $terms = [];
        $subjects = [];
        $query_class_id = $this->request->getQuery('class_id');
        if (!$query_class_id) {
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }
        $permissions = TableRegistry::get('UsersManager.TeachersSubjectsClassesPermissions')->query()
            ->enableHydration(false)
            ->contain(['Classes'])
            ->where([
                'teacher_id' => $this->Auth->user('id'),
                'class_id' => $query_class_id
            ])
            ->first();
        if (isset($permissions['subjects']) && !empty($permissions['subjects'])) {
            if (in_array(0, $permissions['subjects'])) {
                $subjects = TableRegistry::get('SubjectsManager.Subjects')->find('list')
                    ->where(['block_id' => $permissions['class']['block_id']]);
            } else {
                $subjects = TableRegistry::get('SubjectsManager.Subjects')->find('list')
                    ->where([
                        'id IN' => $permissions['subjects'],
                        'block_id' => $permissions['class']['block_id']
                    ]);
            }
        }
        if (isset($permissions['terms']) && !empty($permissions['terms'])) {
            if (in_array(0, $permissions['terms'])) {
                $currentTermId = Setting::read('Application.current_term');
                $terms = TableRegistry::get('Terms')->find('list')->where(['id' => $currentTermId]);
            } else {
                $terms = TableRegistry::get('Terms')->find('list')->where(['id IN' => $permissions['terms']])->limit(3);
            }
        }
        if (isset($permissions['sessions']) && !empty($permissions['sessions'])) {
            if (in_array(0, $permissions['sessions'])) {
                $currentSessionId = Setting::read('Application.current_session');
                $sessions = TableRegistry::get('Sessions')->find('list')->where(['id' => $currentSessionId]);
            } else {
                $sessions = TableRegistry::get('Sessions')->find('list')->where(['id IN' => $permissions['sessions']]);
            }
        }
        $this->set(compact('subjects', 'sessions', 'terms', 'classes'));


        $queryData = $this->request->getQuery();
        if ( !empty($queryData) ){
            $hasSubjectId = (isset($queryData['subject_id']) && !empty($queryData['subject_id']));
            $hasTermId = (isset($queryData['term_id']) && !empty($queryData['term_id']));
            $hasSessionId =(isset($queryData['session_id']) && !empty($queryData['session_id']));
            if ($hasSubjectId && $hasTermId && $hasSessionId) {

                $subject = TableRegistry::get('SubjectsManager.Subjects')->get($queryData['subject_id'],['contain'=>'Blocks']);
                $resultGradeInputsTable = TableRegistry::get('ResultSystem.ResultGradeInputs');
                $gradeInputs = $resultGradeInputsTable->getValidGradeInputs($resultGradeInputsTable->getResultGradeInputs($queryData['session_id']));
                // check if subject has existing value for the records
                $studentResultExists = TableRegistry::get('ResultSystem.StudentTermlyResults')->find('all')
                    ->select(['student_id','subject_id','session_id','class_id','term_id'])
                    ->where([
                        'StudentTermlyResults.subject_id' =>$subject['id'],
                        'StudentTermlyResults.session_id' =>$queryData['session_id'],
                        'StudentTermlyResults.class_id' => $queryData['class_id'],
                        'StudentTermlyResults.term_id' => $queryData['term_id']
                    ])->enableHydration(false)->extract('student_id')->toArray();
                if ( !empty($studentResultExists)){
                    $this->set('subjectContainsResult',$studentResultExists);
                }
                $students = TableRegistry::get('ResultSystem.Students')->find('all')
                    ->select(['id','first_name','last_name','class_id','status'])
                    ->where(['class_id'=>$queryData['class_id'],'status'=>1])
                    ->orderAsc('first_name')
                    ->combine('id','full_name')->toArray();
                $this->set(compact('students','gradeInputs', 'subject'));
            }
        } else {
            $this->set('selectParameter',true); // set the value selectParameter to true
        }

    }

    public function store()
    {
        $queryData = $this->request->getQuery();
        try {
            $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs($this->ResultGradeInputs->getResultGradeInputs($queryData['session_id']));
            if ( $this->request->is(['post'])) {
                $processedResults = $this->ResultSystem->processSubmittedResults($this->request->getData('student_termly_results'),$gradeInputs);
                $subjectResults = $this->Subjects->StudentTermlyResults->newEntities($processedResults);
                if (empty($subjectResults)) {
                    $this->Flash->error(__('No Data submitted!.'));
                    return $this->redirect($this->referer());
                }
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



    public function edit()
    {
        $sessions = [];
        $terms = [];
        $subjects = [];
        $query_class_id = $this->request->getQuery('class_id');
        if (!$query_class_id) {
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }
        $permissions = TableRegistry::get('UsersManager.TeachersSubjectsClassesPermissions')->query()
            ->enableHydration(false)
            ->contain(['Classes'])
            ->where([
                'teacher_id' => $this->Auth->user('id'),
                'class_id' => $query_class_id
            ])
            ->first();
        if (isset($permissions['subjects']) && !empty($permissions['subjects'])) {
            if (in_array(0, $permissions['subjects'])) {
                $subjects = TableRegistry::get('SubjectsManager.Subjects')->find('list')
                    ->where(['block_id' => $permissions['class']['block_id']]);
            } else {
                $subjects = TableRegistry::get('SubjectsManager.Subjects')->find('list')
                    ->where([
                        'id IN' => $permissions['subjects'],
                        'block_id' => $permissions['class']['block_id']
                    ]);
            }
        }
        if (isset($permissions['terms']) && !empty($permissions['terms'])) {
            if (in_array(0, $permissions['terms'])) {
                $currentTermId = Setting::read('Application.current_term');
                $terms = TableRegistry::get('Terms')->find('list')->where(['id' => $currentTermId]);
            } else {
                $terms = TableRegistry::get('Terms')->find('list')->where(['id IN' => $permissions['terms']])->limit(3);
            }
        }
        if (isset($permissions['sessions']) && !empty($permissions['sessions'])) {
            if (in_array(0, $permissions['sessions'])) {
                $currentSessionId = Setting::read('Application.current_session');
                $sessions = TableRegistry::get('Sessions')->find('list')->where(['id' => $currentSessionId]);
            } else {
                $sessions = TableRegistry::get('Sessions')->find('list')->where(['id IN' => $permissions['sessions']]);
            }
        }
        $this->set(compact('subjects', 'sessions', 'terms', 'classes'));

        try {
            $queryData = $this->request->getQuery();
            $hasSubjectId = (isset($queryData['subject_id']) && !empty($queryData['subject_id']));
            $hasTermId = (isset($queryData['term_id']) && !empty($queryData['term_id']));
            $hasSessionId =(isset($queryData['session_id']) && !empty($queryData['session_id']));
            if ($hasSubjectId && $hasTermId && $hasSessionId) {
                $subject = $this->Subjects->get($queryData['subject_id'],['contain'=>'Blocks']);
                if ( isset($queryData['term_id']) && $queryData['term_id'] == 4  ) {
                    $subject = $this->Subjects->getAnnualResultWithHydration($subject['id'],$queryData);
                    $this->set(compact('subject'));
                    $this->render('edit_annual_subject_result');
                } else {
                    $subject = $this->Subjects->getTermlyResultWithHydration($subject['id'],$queryData);
                    $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs($this->ResultGradeInputs->getResultGradeInputs($queryData['session_id']));
                    $this->set(compact('gradeInputs','subject'));
                    $this->set('_serialize', ['subject']);
                    $this->render('edit_termly_subject_result');
                }
            }
        } catch ( \Exception $e ) {
            $this->Flash->error(__($e->getMessage()));
            return $this->redirect($this->referer());
        }
    }


    public function update()
    {
        try {
            $queryData = $this->request->getQuery();
            $hasSubjectId = (isset($queryData['subject_id']) && !empty($queryData['subject_id']));
            $hasTermId = (isset($queryData['term_id']) && !empty($queryData['term_id']));
            $hasSessionId =(isset($queryData['session_id']) && !empty($queryData['session_id']));
            if ($hasSubjectId && $hasTermId && $hasSessionId) {
                $subject = $this->Subjects->get($queryData['subject_id']);
                if ($queryData['term_id'] == 4) {
                    $subject = $this->Subjects->getAnnualResultWithHydration($subject['id'],$queryData);
                    $subject = $this->Subjects->StudentAnnualResults->patchEntities($subject['student_annual_results'], $this->request->getData('student_annual_results'));
                    if($this->Subjects->StudentAnnualResults->saveMany($subject)) {
                        $this->Flash->success(__('The subject annual results was successfully updated.'));
                    } else {
                        $this->Flash->error(__('The subject annual results could not be updated.'));
                    }
                } else {
                    $subject = $this->Subjects->getTermlyResultWithHydration($subject['id'],$queryData);
                    $subject = $this->Subjects->StudentTermlyResults->patchEntities($subject['student_termly_results'], $this->request->getData('student_termly_results'));
                    if($this->Subjects->StudentTermlyResults->saveMany($subject)) {
                        $this->Flash->success(__('The subject termly results was successfully updated.'));
                    } else {
                        $this->Flash->error(__('The subject termly results could not be updated.'));
                    }
                }
            }
        } catch ( \Exception $e ) {
            $this->Flash->error(__($e->getMessage()));
        }
        return $this->redirect($this->referer());
    }

    public function view()
    {
        $sessions = [];
        $terms = [];
        $subjects = [];
        $query_class_id = $this->request->getQuery('class_id');
        if (!$query_class_id) {
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        }
        $permissions = TableRegistry::get('UsersManager.TeachersSubjectsClassesPermissions')->query()
            ->enableHydration(false)
            ->contain(['Classes'])
            ->where([
                'teacher_id' => $this->Auth->user('id'),
                'class_id' => $query_class_id
            ])
            ->first();
        if (isset($permissions['subjects']) && !empty($permissions['subjects'])) {
            if (in_array(0, $permissions['subjects'])) {
                $subjects = TableRegistry::get('SubjectsManager.Subjects')->find('list')
                    ->where(['block_id' => $permissions['class']['block_id']]);
            } else {
                $subjects = TableRegistry::get('SubjectsManager.Subjects')->find('list')
                    ->where([
                        'id IN' => $permissions['subjects'],
                        'block_id' => $permissions['class']['block_id']
                    ]);
            }
        }
        if (isset($permissions['terms']) && !empty($permissions['terms'])) {
            if (in_array(0, $permissions['terms'])) {
                $currentTermId = Setting::read('Application.current_term');
                $terms = TableRegistry::get('Terms')->find('list')->where(['id' => $currentTermId]);
            } else {
                $terms = TableRegistry::get('Terms')->find('list')->where(['id IN' => $permissions['terms']]);
            }
        }
        if (isset($permissions['sessions']) && !empty($permissions['sessions'])) {
            if (in_array(0, $permissions['sessions'])) {
                $currentSessionId = Setting::read('Application.current_session');
                $sessions = TableRegistry::get('Sessions')->find('list')->where(['id' => $currentSessionId]);
            } else {
                $sessions = TableRegistry::get('Sessions')->find('list')->where(['id IN' => $permissions['sessions']]);
            }
        }
        $this->set(compact('subjects', 'sessions', 'terms'));
        try {
            $queryData = $this->request->getQuery();
            $hasSubjectId = (isset($queryData['subject_id']) && !empty($queryData['subject_id']));
            $hasTermId = (isset($queryData['term_id']) && !empty($queryData['term_id']));
            $hasSessionId =(isset($queryData['session_id']) && !empty($queryData['session_id']));
            if ($hasSubjectId && $hasSessionId && $hasTermId) {
                $subject = $this->Subjects->get($queryData['subject_id'], [
                    'contain' => ['Blocks']
                ]);
                if( isset($queryData['term_id']) && $queryData['term_id'] == 4 ) {
                    $studentSubjectAnnualResults = $this->Subjects->getAnnualResults($subject->id,$queryData);
                    $studentAnnualSubjectPositions = $this->Subjects->getAnnualSubjectPositions($subject->id,$queryData);
                    $this->set(compact('subject','studentSubjectAnnualResults','studentAnnualSubjectPositions'));
                    $this->set('_serialize', ['subject']);
                    $this->render('view_annual_subject_result');
                } else {
                    $subjectTermlyResults = $this->Subjects->getTermlyResults($subject->id,$queryData);
                    // gets the student subject positions
                    $subjectStudentPositions = $this->Subjects->getTermlySubjectPositions($subject->id,$queryData);
                    $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs($this->ResultGradeInputs->getResultGradeInputs($queryData['session_id']));
                    $this->set(compact('gradeInputs','subjectStudentPositions','subjectTermlyResults','subject'));
                    $this->set('_serialize', ['subject']);
                    $this->render('view_termly_subject_result');
                }
            }
        } catch ( RecordNotFoundException $e) {
            $this->Flash->error(__($e->getMessage()));
        }
    }
}
