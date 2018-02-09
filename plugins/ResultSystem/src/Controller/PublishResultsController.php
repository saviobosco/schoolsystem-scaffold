<?php
namespace ResultSystem\Controller;

use ResultSystem\Controller\AppController;

/**
 * PublishResults Controller
 * @property \ResultSystem\Model\Table\StudentPublishResultsTable $StudentPublishResults
 * @property \ResultSystem\Model\Table\StudentsTable $Students
 * @property \ResultSystem\Model\Table\TermsTable $Terms
 */
class PublishResultsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('ResultSystem.Students');
        $this->loadModel('ResultSystem.Terms');
        $this->loadModel('ResultSystem.StudentPublishResults');
    }
    public function index()
    {
        // set the required variables for selecting parameters
        $sessions = $this->Students->Sessions->find('list',['limit' => 200]);
        $classes = $this->Students->Classes->find('list',['limit' => 200]);
        $terms = $this->Terms->find('list');
        $this->set(compact('sessions','classes','terms'));
        // checking if their is any $_GET parameter specified
        $queryData = $this->request->getQuery();
        if ( empty($queryData)) {
            $this->set('selectParameter',true);
            return;
        }
        $queryData = $this->request->getQuery();
        $students = $this->Students->find('all')
            ->contain([
                'StudentPublishResults' => function ($q) use ($queryData) {
                    return $q->where([
                        'StudentPublishResults.term_id' => $queryData['term_id'],
                        'StudentPublishResults.class_id' => $queryData['class_id'],
                        'StudentPublishResults.session_id' => $queryData['session_id'],
                    ]);
                }
            ])->where(['Students.status'=>1,'Students.class_id'=>$queryData['class_id']])
            ->toArray();
        $this->set(compact('students'));
        $this->set('_serialize', ['students']);
    }

    // Todo: work on this
    public function processPublishResults()
    {
        $queryData = $this->request->getQuery();
        $postData = $this->request->getData();
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ( $this->StudentPublishResults->publishResults($postData['student_publish_results'],$queryData) ) {
                $this->Flash->success(__('The results were successfully published'));
            }else {
                $this->Flash->error(__('No Result was published'));
            }
        }
        $this->redirect($this->referer());
    }
}
