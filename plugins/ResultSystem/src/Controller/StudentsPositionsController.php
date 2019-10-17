<?php
namespace ResultSystem\Controller;

use ResultSystem\Controller\AppController;

/**
 * StudentsPositions Controller
 * @property \ResultSystem\Model\Table\StudentPositionsTable $StudentPositions
 * @property \ResultSystem\Model\Table\StudentAnnualPositionsTable $StudentAnnualPositions
 * @property \ResultSystem\Model\Table\StudentTermlyResultsTable $StudentTermlyResults
 * @property \ResultSystem\Model\Table\SessionsTable $Sessions
 * @property \ResultSystem\Model\Table\ClassesTable $Classes
 * @property \ResultSystem\Model\Table\TermsTable $Terms */
class StudentsPositionsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('ResultSystem.Sessions');
        $this->loadModel('ResultSystem.Classes');
        $this->loadModel('ResultSystem.Terms');
        $this->loadModel('ResultSystem.StudentPositions');
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $queryData = $this->request->getQuery();
        if ( !empty($queryData)) {
            $studentPositions = $this->StudentPositions->find('all')
                ->where(['session_id' => $queryData['session_id'],
                    'StudentPositions.class_id'  => $queryData['class_id'],
                    'term_id'  => $queryData['term_id'],
                ])
                ->contain(['Students' => ['fields' => ['id', 'first_name', 'last_name']]])
                ->orderDesc('total');
        }
        $sessions = $this->Sessions->find('list')->toArray();
        $classes  = $this->Classes->find('list')->toArray();
        $terms = $this->Terms->find('list')->toArray();
        $this->set(compact('studentPositions','sessions','classes','terms'));
        $this->set('_serialize', ['studentTermlyResults']);
    }
}
