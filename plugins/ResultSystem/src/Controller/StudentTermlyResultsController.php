<?php
namespace ResultSystem\Controller;

use Cake\Form\Form;
use ResultSystem\Controller\AppController;
use ResultSystem\Controller\Traits\SearchParameterTrait;
use Cake\Utility\Text;
use ResultSystem\Form\ResultUploadForm;

/**
 * StudentTermlyResults Controller
 * @property \ResultSystem\Controller\Component\ResultSystemComponent $ResultSystem
 * @property \ResultSystem\Model\Table\StudentTermlyResultsTable $StudentTermlyResults
 * @property \ResultSystem\Model\Table\ResultGradeInputsTable $ResultGradeInputs
 */
class StudentTermlyResultsController extends AppController
{
    use SearchParameterTrait;

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('ResultSystem.ResultSystem');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->loadModel('StudentTermlyPositions');
        $studentPositions = $this->StudentTermlyPositions->find('all')
            ->contain([ ])
            ->where(['session_id' => @$this->_getDefaultValue($this->request->query['session_id'],1),
                    'class_id'  => @$this->_getDefaultValue($this->request->query['class_id'],1),
                    'term_id'  => @$this->_getDefaultValue($this->request->query['term_id'],1),
            ])
            ->orderDesc('total');
        // loads the session , class, term tables

        $this->loadModel('App.Sessions');
        $this->loadModel('App.Classes');
        $this->loadModel('Terms');
        $sessions = $this->Sessions->find('list',['limit' => 200])->toArray();
        $classes  = $this->Classes->find('list',['limit' => 200])->toArray();
        $terms = $this->Terms->find('list',['limit' => 4])->toArray();
        $this->set(compact('studentTermlyResults','studentPositions','sessions','classes','terms'));
        $this->set('_serialize', ['studentTermlyResults']);
    }

    /**
     * View method
     *
     * @param string|null $id Student Termly Result id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $studentTermlyResult = $this->StudentTermlyResults->get($id, [
            'contain' => ['Students', 'Subjects', 'Classes', 'Terms', 'Sessions']
        ]);

        $this->set('studentTermlyResult', $studentTermlyResult);
        $this->set('_serialize', ['studentTermlyResult']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $studentTermlyResult = $this->StudentTermlyResults->newEntity();
        if ($this->request->is('post')) {
            $studentTermlyResult = $this->StudentTermlyResults->patchEntity($studentTermlyResult, $this->request->data);
            if ($this->StudentTermlyResults->save($studentTermlyResult)) {
                $this->Flash->success(__('The student termly result has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The student termly result could not be saved. Please, try again.'));
            }
        }
        $students = $this->StudentTermlyResults->Students->find('list', ['limit' => 200]);
        $subjects = $this->StudentTermlyResults->Subjects->find('list', ['limit' => 200]);
        $classes = $this->StudentTermlyResults->Classes->find('list', ['limit' => 200]);
        $terms = $this->StudentTermlyResults->Terms->find('list', ['limit' => 200]);
        $sessions = $this->StudentTermlyResults->Sessions->find('list', ['limit' => 200]);
        $this->set(compact('studentTermlyResult', 'students', 'subjects', 'classes', 'terms', 'sessions'));
        $this->set('_serialize', ['studentTermlyResult']);
    }

    public function uploadResult()
    {
        $resultUploadValidator = new ResultUploadForm();
        if ($this->request->is('ajax')) {
            $feedback = $this->resultFileAjaxUpload($resultUploadValidator);
            $this->response->body($feedback);
            return $this->response;
        }
        if ($this->request->is('post')) {
            if ($resultUploadValidator->validate($this->request->data)) {
                try {
                    $studentTermlyResult = $this->StudentTermlyResults->find('all')
                        ->where([
                            'class_id' => $this->request->data['class_id'],
                            'term_id'=>$this->request->data['term_id'],
                            'session_id' => $this->request->data['session_id']
                        ]);

                    $datas = $this->ImportExcel->prepareEntityData($this->request->data['result']['tmp_name'],['worksheet'=>'Sheet1']);


                    $formattedResult = $this->ResultSystem->formatArrayData($datas[0],$this->request->data['type'],
                        $this->request->data['class_id'],
                        $this->request->data['term_id']
                        ,$this->request->data['session_id']);

                    if ( empty($formattedResult['format_error']) ) {

                        if (empty($formattedResult['error'])) {

                            $studentTermlyResult = $this->StudentTermlyResults->patchEntities($studentTermlyResult, $formattedResult['students_data']);

                            // Saving student results
                            $savedResults = $this->StudentTermlyResults->saveResult($studentTermlyResult);

                            if ( empty($savedResults['error']) ) {
                                $this->Flash->great_success(__($datas[1].' records were successfully read and uploaded .'));

                            } else {
                                $failedResults = array_unique($savedResults['error']);
                                $this->Flash->info(__( $datas[1] - count($failedResults).' records were successfully read and uploaded. An error occurred uploading the following students results with admission No: '). Text::toList($failedResults) . '. Possible cause of error is incorrect Admission Number. Please Check it and try again');
                            }
                        } else {
                            $this->Flash->error(__('The result could not be uploaded because the following subjects does not exist in the database ').
                                Text::toList($formattedResult['error']) .'. This might be caused by improper subject naming, wrong character cases and wrong spacings. Please cross check and try again');
                        }
                    } else {
                        $this->Flash->error(__($formattedResult['format_error']));
                    }
                } catch ( \Exception $e ) {
                    $this->Flash->error($e->getMessage());

                    //$this->Flash->error(__('An Internal Error occurred while computing the result. The cause of this result is that your excel file contains two excel sheets '));
                }
            } else {
                $this->Flash->error(__('Please complete the form'));
            }

        }
        $classes = $this->StudentTermlyResults->Classes->find('list', ['limit' => 6]);
        $terms = $this->StudentTermlyResults->Terms->find('list', ['limit' => 3]);
        $sessions = $this->StudentTermlyResults->Sessions->find('list', ['limit' => 200]);
        $this->loadModel('ResultSystem.ResultGradeInputs');
        $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs();
        $this->set(compact('classes', 'terms', 'sessions','gradeInputs'));
        $this->set('_serialize', ['studentTermlyResult']);
    }

    /**
     * @param Form $form
     * @return string
     * @var $form is used for the form validation
     */
    protected function resultFileAjaxUpload(Form $form)
    {
        if ($form->validate($this->request->data)) {
            try {
                $studentTermlyResult = $this->StudentTermlyResults->find('all')
                    ->where([
                        'class_id' => $this->request->data['class_id'],
                        'term_id'=>$this->request->data['term_id'],
                        'session_id' => $this->request->data['session_id']
                    ]);

                $datas = $this->ImportExcel->prepareEntityData($this->request->data['result']['tmp_name'],['worksheet'=>'Sheet1']);

                $formattedResult = $this->ResultSystem->formatArrayData($datas[0],$this->request->data['type'],
                    $this->request->data['class_id'],
                    $this->request->data['term_id']
                    ,$this->request->data['session_id']);

                if ( empty($formattedResult['format_error']) ) {

                    if (empty($formattedResult['error'])) {

                        $studentTermlyResult = $this->StudentTermlyResults->patchEntities($studentTermlyResult, $formattedResult['students_data']);

                        // Saving student results
                        $savedResults = $this->StudentTermlyResults->saveResult($studentTermlyResult);

                        if ( empty($savedResults['error']) ) {
                            return $this->SavioboscoFlash->message( $datas[1].' records were successfully read and uploaded',['class' => 'alert-success']);
                        } else {
                            $failedResults = array_unique($savedResults['error']);
                            return $this->SavioboscoFlash->message( $datas[1] - count($failedResults).' records were successfully read and uploaded. An error occurred uploading the following students results with admission No: '. Text::toList($failedResults) . '. Possible cause of error is incorrect Admission Number. Please Check it and try again',['class'=>'alert-warning']);
                        }
                    } else {
                        return $this->SavioboscoFlash->message( __('The result could not be uploaded because the following subjects does not exist in the database : <strong>').
                            Text::toList($formattedResult['error']) .'</strong>. This might be caused by improper subject naming, wrong character cases and wrong spacings. Please cross check and try again',['class'=>'alert-danger']);
                    }
                } else {
                    return $this->SavioboscoFlash->message(__($formattedResult['format_error']),['class' => 'alert-danger']);
                }
            } catch (\Exception $e) {
                return $this->SavioboscoFlash->message($e->getMessage(),['class'=>'alert-danger']);
            }
        } else {
            return $this->SavioboscoFlash->message('Please Complete the form.',['class'=>'alert-danger']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Student Termly Result id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $studentTermlyResult = $this->StudentTermlyResults->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $studentTermlyResult = $this->StudentTermlyResults->patchEntity($studentTermlyResult, $this->request->data);
            if ($this->StudentTermlyResults->save($studentTermlyResult)) {
                $this->Flash->success(__('The student termly result has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The student termly result could not be saved. Please, try again.'));
            }
        }
        $students = $this->StudentTermlyResults->Students->find('list', ['limit' => 200]);
        $subjects = $this->StudentTermlyResults->Subjects->find('list', ['limit' => 200]);
        $classes = $this->StudentTermlyResults->Classes->find('list', ['limit' => 200]);
        $terms = $this->StudentTermlyResults->Terms->find('list', ['limit' => 200]);
        $sessions = $this->StudentTermlyResults->Sessions->find('list', ['limit' => 200]);
        $this->set(compact('studentTermlyResult', 'students', 'subjects', 'classes', 'terms', 'sessions'));
        $this->set('_serialize', ['studentTermlyResult']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Student Termly Result id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $studentTermlyResult = $this->StudentTermlyResults->get($id);
        if ($this->StudentTermlyResults->delete($studentTermlyResult)) {
            $this->Flash->success(__('The student termly result has been deleted.'));
        } else {
            $this->Flash->error(__('The student termly result could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
