<?php
namespace SkillsGradingSystem\Controller;

use App\Controller\Traits\SearchParameterTrait;
use SkillsGradingSystem\Controller\AppController;

/**
 * Students Controller
 *
 * @property \SkillsGradingSystem\Model\Table\StudentsTable $Students
 * @property \SkillsGradingSystem\Model\Table\AffectiveDispositionsTable $AffectiveDispositions
 * @property \SkillsGradingSystem\Model\Table\PsychomotorSkillsTable $PsychomotorSkills
 * @property \ResultSystem\Model\Table\TermsTable $Terms
 * @property \ResultSystem\Model\Table\TermsTable $Sessions
 */
class StudentsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('SkillsGradingSystem.AffectiveDispositions');
        $this->loadModel('SkillsGradingSystem.PsychomotorSkills');
        $this->loadModel('ResultSystem.Terms');
        $this->loadModel('ResultSystem.Sessions');

    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $classes = $this->Students->Classes->find('list');
        $sessions = $this->Sessions->find('list');
        $terms = $this->Terms->find('list');
        $this->set(compact('students','sessions','classes', 'terms'));
        $this->set('_serialize', ['students']);
    }


    /**
     * Add method
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $queryData = $this->request->getQuery();
        $student = $this->Students->get($queryData['student_id'], [
            'fields' => ['id'],
            'contain' => [
                'StudentsAffectiveDispositionScores' => [
                    'conditions' => [
                        'StudentsAffectiveDispositionScores.session_id' => $queryData['session_id'],
                        'StudentsAffectiveDispositionScores.class_id' => $queryData['class_id'],
                        'StudentsAffectiveDispositionScores.term_id' => $queryData['term_id']
                    ]
                ],
                'StudentsPsychomotorSkillScores' => [
                    'conditions' => [
                        'StudentsPsychomotorSkillScores.session_id' => $queryData['session_id'],
                        'StudentsPsychomotorSkillScores.class_id' => $queryData['class_id'],
                        'StudentsPsychomotorSkillScores.term_id' => $queryData['term_id']
                    ]
                ]]
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $student = $this->Students->patchEntity($student, $this->request->getData());
            if ($this->Students->save($student)) {
            } else {
            }
        }
    }


    /**
     * Delete method
     *
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $student = $this->Students->get($id);
        if ($this->Students->delete($student)) {
            $this->Flash->success(__('The student has been deleted.'));
        } else {
            $this->Flash->error(__('The student could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function getSkillView()
    {
        $queryData = $this->request->getQuery();
        $student = $this->Students->get($queryData['student_id'], [
            'fields' => ['id', 'first_name', 'last_name'],
            'contain' => [
                'StudentsAffectiveDispositionScores' => [
                    'conditions' => [
                        'StudentsAffectiveDispositionScores.session_id' => $queryData['session_id'],
                        'StudentsAffectiveDispositionScores.class_id' => $queryData['class_id'],
                        'StudentsAffectiveDispositionScores.term_id' => $queryData['term_id']
                    ]
                ],
                'StudentsPsychomotorSkillScores' => [
                    'conditions' => [
                        'StudentsPsychomotorSkillScores.session_id' => $queryData['session_id'],
                        'StudentsPsychomotorSkillScores.class_id' => $queryData['class_id'],
                        'StudentsPsychomotorSkillScores.term_id' => $queryData['term_id']
                    ]
                ]]
        ]);
        $affectiveSkills = $this->AffectiveDispositions->find('all')->toArray();
        $psychomotorSkills = $this->PsychomotorSkills->find('all')->toArray();
        $this->set(compact('student','affectiveSkills','psychomotorSkills'));
    }

}
