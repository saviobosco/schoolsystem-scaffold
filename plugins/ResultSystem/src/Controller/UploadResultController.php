<?php
namespace ResultSystem\Controller;

use ResultSystem\Controller\AppController;
use Cake\Utility\Text;
use ResultSystem\Form\ResultUploadForm;
use Cake\Form\Form;
/**
 * UploadResult Controller
 * @property \ResultSystem\Controller\Component\ResultSystemComponent $ResultSystem
 * @property \ResultSystem\Model\Table\StudentTermlyResultsTable $StudentTermlyResults
 * @property \ResultSystem\Model\Table\ResultGradeInputsTable $ResultGradeInputs
 * @property \ResultSystem\Model\Table\SessionsTable $Sessions
 * @property \ResultSystem\Model\Table\ClassesTable $Classes
 * @property \ResultSystem\Model\Table\TermsTable $Terms
 */
class UploadResultController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('ResultSystem.StudentTermlyResults');
        $this->loadComponent('ResultSystem.ResultSystem');
    }

    public function uploadResult()
    {
        $classes = $this->StudentTermlyResults->Classes->find('list', ['limit' => 6]);
        $terms = $this->StudentTermlyResults->Terms->find('list', ['limit' => 3]);
        $sessions = $this->StudentTermlyResults->Sessions->find('list', ['limit' => 200]);
        $this->loadModel('ResultSystem.ResultGradeInputs');
        $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs($this->ResultGradeInputs->getResultGradeInputs());
        $this->set(compact('classes', 'terms', 'sessions','gradeInputs'));
        $this->set('_serialize', ['studentTermlyResult']);
    }

    public function processUploadResult()
    {
        $postData = $this->request->getData();
        $resultUploadValidator = new ResultUploadForm();
        if ($this->request->is('ajax')) {
            $feedback = $this->resultFileAjaxUpload($resultUploadValidator);
            $this->response->body($feedback);
            return $this->response;
        }
        if ($this->request->is(['post','patch','put'])) {
            if ($resultUploadValidator->validate($postData)) {
                try {
                    $datas = $this->ImportExcel->prepareEntityData($postData['result']['tmp_name'],['worksheet'=>'Sheet1']);

                    $formattedResult = $this->ResultSystem->formatArrayData($datas[0],$postData['type'],
                        $postData['class_id'],
                        $postData['term_id']
                        ,$postData['session_id']);

                    if ( !empty($formattedResult['format_error']) ) {
                        $this->Flash->error(__($formattedResult['format_error']));
                        return $this->redirect($this->referer());
                    }
                    if (!empty($formattedResult['error'])) {
                        $this->Flash->error(__('The result could not be uploaded because the following subjects does not exist in the database ').
                            Text::toList($formattedResult['error']) .'. This might be caused by improper subject naming, wrong character cases and wrong spacings. Please cross check and try again');
                        return $this->redirect($this->referer());
                    }
                    $studentTermlyResult = $this->StudentTermlyResults->find('all')
                        ->where([
                            'class_id' => $postData['class_id'],
                            'term_id'=>$postData['term_id'],
                            'session_id' => $postData['session_id']
                        ]); // get all students with specified parameters
                    $studentTermlyResult = $this->StudentTermlyResults->patchEntities($studentTermlyResult, $formattedResult['students_data']);
                    // Saving student results
                    $savedResults = $this->StudentTermlyResults->saveResult($studentTermlyResult);

                    if ( !empty($savedResults['error']) ) {
                        $failedResults = array_unique($savedResults['error']);
                        $this->Flash->info(__( $datas[1] - count($failedResults).' records were successfully read and uploaded. An error occurred uploading the following students results with admission No: '). Text::toList($failedResults) . '. Possible cause of error is incorrect Admission Number. Please Check it and try again');
                        return $this->redirect($this->referer());
                    }
                    $this->Flash->success(__($datas[1].' records were successfully read and uploaded.'));
                    return $this->redirect($this->referer());
                } catch ( \Exception $e ) {
                    $this->Flash->error($e->getMessage());
                    return $this->redirect($this->referer());
                }
            } else {
                $this->Flash->error(__('Please complete the form'));
                return $this->redirect($this->referer());
            }
        }
    }

    protected function resultFileAjaxUpload(Form $form)
    {
        $postData = $this->request->getData();
        if ($form->validate($postData)) {
            try {
                $datas = $this->ImportExcel->prepareEntityData($postData['result']['tmp_name'],['worksheet'=>'Sheet1']);
                $formattedResult = $this->ResultSystem->formatArrayData($datas[0],$postData['type'],
                    $postData['class_id'],
                    $postData['term_id']
                    ,$postData['session_id']);
                if ( empty($formattedResult['format_error']) ) {

                    if (empty($formattedResult['error'])) {
                        $studentTermlyResult = $this->StudentTermlyResults->find('all')
                            ->where([
                                'class_id' => $postData['class_id'],
                                'term_id'=>$postData['term_id'],
                                'session_id' => $postData['session_id']
                            ]);
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
}
