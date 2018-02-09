<?php
namespace ResultSystem\Controller;

use ResultSystem\Controller\AppController;

/**
 * StudentsPositions Controller
 * @property \ResultSystem\Model\Table\StudentTermlyPositionsTable $StudentTermlyPositions
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
        $this->loadModel('ResultSystem.StudentAnnualPositions');
        $this->loadModel('ResultSystem.StudentTermlyPositions');
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
            if (  isset($queryData['term_id']) && $queryData['term_id'] == 4 ) {
                $studentPositions = $this->StudentAnnualPositions->find('all')
                    ->where(['StudentAnnualPositions.session_id' => $queryData['session_id'],
                        'StudentAnnualPositions.class_id'  => $queryData['class_id'],
                    ])
                    ->contain(['Students'])
                    ->orderDesc('total');
            } else {
                $studentPositions = $this->StudentTermlyPositions->find('all')
                    ->where(['StudentTermlyPositions.session_id' => $queryData['session_id'],
                        'StudentTermlyPositions.class_id'  => $queryData['class_id'],
                        'StudentTermlyPositions.term_id'  => $queryData['term_id'],
                    ])
                    ->contain(['Students'])
                    ->orderDesc('total');
            }
        }
        $sessions = $this->Sessions->find('list')->toArray();
        $classes  = $this->Classes->find('list')->toArray();
        $terms = $this->Terms->find('list')->toArray();
        $this->set(compact('studentPositions','sessions','classes','terms'));
        $this->set('_serialize', ['studentTermlyResults']);
    }
}
