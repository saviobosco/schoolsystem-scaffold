<?php
namespace ResultSystem\Controller;

use ResultSystem\Controller\AppController;

/**
 * StudentsAnnualPromotion Controller
 * @property \ResultSystem\Model\Table\StudentsTable $Students
 */
class StudentsAnnualPromotionController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('ResultSystem.Students');
    }

    public function index()
    {
        $queryData = $this->request->getQuery();
        if ( !empty($queryData) ) {
            $students = $this->Students->getStudentAnnualPromotions($queryData);
        }
        $sessions = $this->Students->Sessions->find('list')->toArray();
        $classes = $this->Students->Classes->find('list',['limit' => 200]);
        $this->set(compact('students','classes','sessions'));
        $this->set('_serialize', ['students']);
    }

    public function processAnnualPromotion()
    {
        $queryData = $this->request->getQuery();
        if ( empty($queryData)) {
            return $this->redirect($this->referer());
        }
        if ( $this->request->is(['put','patch','post'])) {
            // get student annual subject positions
            $studentAnnualPositions = $this->Students->StudentAnnualPositions->find('all')->where(['session_id'=>$queryData['session_id'],'class_id'=>$queryData['class_id']])->toArray();
            $studentAnnualPositions = $this->Students->StudentAnnualPositions->patchEntities($studentAnnualPositions,$this->request->getData('student_annual_positions'));
            foreach ( $studentAnnualPositions as $studentAnnualPosition) {
                $this->Students->StudentAnnualPositions->save($studentAnnualPosition);
            }
            $this->Flash->success('The action was successful!');
            return $this->redirect($this->referer());
        }
    }
}
