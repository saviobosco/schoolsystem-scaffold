<?php
namespace StudentAccount\Controller;

use Cake\Core\Plugin;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\TableRegistry;
use StudentAccount\Controller\AppController;

/**
 * Dashboard Controller
 *
 * @property \ResultSystem\Model\Table\StudentsTable $Students
 */
class DashboardController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('StudentAccount.Students');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        // get the student details
        $studentDetail = $this->Students->query()
            ->select(['first_name', 'last_name', 'class_id'])
            ->contain(['Classes'])
            ->where(['Students.id'=> $this->Auth->user('student_id')])
            ->first();

        // get the current session
        //$currentSession =

        // get recently published results
        if (Plugin::loaded('ResultSystem')) {
            $studentPublishResultsTable = TableRegistry::get('ResultSystem.StudentPublishResults');
            $studentResults = $studentPublishResultsTable->query()
                ->contain(['Classes', 'Terms', 'Sessions'])
                ->where([
                    'student_id' => $this->Auth->user('student_id'),
                    'status' => 1
                ])
                ->orderDesc('StudentPublishResults.created');
        }
        $this->set(compact('studentDetail', 'studentResults'));
        // with the current class
        // the current term
        // the recently published result.

    }
}
