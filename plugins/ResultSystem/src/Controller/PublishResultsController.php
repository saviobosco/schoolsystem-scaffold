<?php
namespace ResultSystem\Controller;

use Cake\Datasource\ConnectionManager;
use ResultSystem\Controller\AppController;

/**
 * PublishResults Controller
 * @property \ResultSystem\Model\Table\StudentPublishResultsTable $StudentPublishResults
 * @property \ResultSystem\Model\Table\StudentTermlyResultsTable $StudentTermlyResults
 * @property \ResultSystem\Model\Table\StudentAnnualResultsTable $StudentAnnualResults
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
        $this->loadModel('ResultSystem.StudentTermlyResults');
        $this->loadModel('ResultSystem.StudentAnnualResults');
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
        //variable for students with results for the specified session, term and class
        $studentsWithResult = null;
        if ($queryData['term_id'] === 4 ) {
            $studentsWithResult = $this->StudentAnnualResults->query()
                ->select(['student_id'])
                ->distinct(['student_id'])
                ->where([
                    'session_id' => $queryData['session_id'],
                    'class_id' => $queryData['class_id'],
                ])
                ->enableHydration(false)
                ->all()
                ->combine('student_id', 'student_id')
                ->toArray();
        } else {
            $studentsWithResult = $this->StudentTermlyResults->query()
                ->select(['student_id'])
                ->distinct(['student_id'])
                ->where([
                    'session_id' => $queryData['session_id'],
                    'class_id' => $queryData['class_id'],
                    'term_id' => $queryData['term_id'],
                ])
                ->enableHydration(false)
                ->all()
                ->combine('student_id', 'student_id')
                ->toArray();
        }
        // get student results
        $students = $this->Students->query()
            ->select(['id', 'first_name', 'last_name', 'class_id'])
            ->enableHydration(false)
            ->contain([
                'StudentPublishResults' => function ($q) use ($queryData) {
                    return $q->where([
                        'StudentPublishResults.term_id' => $queryData['term_id'],
                        'StudentPublishResults.class_id' => $queryData['class_id'],
                        'StudentPublishResults.session_id' => $queryData['session_id'],
                    ]);
                }
            ])->where(['Students.status'=>1,'Students.class_id'=>$queryData['class_id']])
            ->orderAsc('first_name')
            ->all();

        $studentsResultPublish = $students
            ->filter(function($student) use ($studentsWithResult) {
                return in_array($student['id'], $studentsWithResult);
            })
            ->toArray();

        $this->set(['studentsCount' => count($students),
            'studentsWithResultCount' => count($studentsResultPublish),
            'students' => $studentsResultPublish
        ]);
        $this->set('_serialize', ['students']);
    }


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
