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
 */
class StudentsController extends AppController
{
    use SearchParameterTrait ;

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('SkillsGradingSystem.AffectiveDispositions');
        $this->loadModel('SkillsGradingSystem.PsychomotorSkills');
        $this->loadModel('ResultSystem.Terms');

    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        if ( empty($this->request->query['class_id'])) {
            $this->paginate = [
                'limit' => 50,
                'contain' => [ 'Classes',],
                'conditions' => [
                    'Students.status'   => 1,
                ],
                // Place the result in ascending order according to the class.
                'order' => [
                    'class_id' => 'asc'
                ]
            ];
        }
        else {
            $this->paginate = [
                'limit' => 50,
                'contain' => ['Classes', 'ClassDemarcations'],
                'conditions' => [
                    'Students.status'   => 1,
                    'Students.class_id' => $this->_getDefaultValue($this->request->query['class_id'],1)
                ]
            ];
        }
        $students = $this->paginate($this->Students);

        $classes = $this->Students->Classes->find('list', ['limit' => 200]);
        $this->set(compact('students','sessions','classes'));
        $this->set('_serialize', ['students']);
    }

    /**
     * View method
     *
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $queryData = $this->request->getQuery();
        if (empty($queryData)) {
            $this->set('selectParameter',true); // set the value selectParameter to true
            $sessions = $this->Students->Sessions->find('list')->toArray();
            $classes = $this->Students->Classes->find('list')->toArray();
            $terms = $this->Terms->find('list')->toArray();
            $this->set(compact('sessions','classes','terms'));
            return;
        }
        $student = $this->Students->get($id, [
            'contain' => [
                'Classes',
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
                ]
            ]
        ]);
        $affectiveSkills = $this->AffectiveDispositions->find('list')->toArray();
        $psychomotorSkills = $this->PsychomotorSkills->find('list')->toArray();
        $sessions = $this->Students->Sessions->find('list')->toArray();
        $classes = $this->Students->Classes->find('list')->toArray();
        $terms = $this->Terms->find('list')->toArray();
        $this->set(compact('student', 'sessions', 'classes','affectiveSkills','psychomotorSkills','terms'));
        $this->set('_serialize', ['student']);
    }

    /**
     * Add method
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $student = $this->Students->get($id, []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $student = $this->Students->patchEntity($student, $this->request->data);

            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student effective skills has been saved.'));

            } else {
                $this->Flash->error(__('The student effective skills could not be saved. Please, try again.'));
            }
        }
        $this->loadModel('AffectiveDispositions');
        $this->loadModel('PsychomotorSkills');
        $this->loadModel('Terms');
        $affectiveSkills = $this->AffectiveDispositions->find('all')->toArray();
        $psychomotorSkills = $this->PsychomotorSkills->find('all')->toArray();
        $sessions = $this->Students->Sessions->find('list')->toArray();
        $classes = $this->Students->Classes->find('list')->toArray();
        $terms = $this->Terms->find('list')->toArray();
        $this->set(compact('student', 'sessions', 'classes','affectiveSkills','psychomotorSkills','terms'));
        $this->set('_serialize', ['student']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $queryData = $this->request->getQuery();
        if (empty($queryData)) {
            $this->set('selectParameter',true); // set the value selectParameter to true
            $sessions = $this->Students->Sessions->find('list')->toArray();
            $classes = $this->Students->Classes->find('list')->toArray();
            $terms = $this->Terms->find('list')->toArray();
            $this->set(compact('sessions','classes','terms'));
            return;
        }
        $student = $this->Students->get($id, [
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
            $student = $this->Students->patchEntity($student, $this->request->data);

            if ($this->Students->save($student)) {
                $this->Flash->success(__('The student effective skills has been saved.'));

            } else {
                $this->Flash->error(__('The student effective skills could not be saved. Please, try again.'));
            }
        }
        $this->loadModel('AffectiveDispositions');
        $this->loadModel('PsychomotorSkills');
        $this->loadModel('Terms');
        $affectiveSkills = $this->AffectiveDispositions->find('all')->toArray();
        $psychomotorSkills = $this->PsychomotorSkills->find('all')->toArray();
        $sessions = $this->Students->Sessions->find('list', ['limit' => 200])->toArray();
        $classes = $this->Students->Classes->find('list', ['limit' => 200])->toArray();
        $terms = $this->Terms->find('list', ['limit' => 200])->toArray();
        $this->set(compact('student', 'sessions', 'classes','affectiveSkills','psychomotorSkills','terms'));
        $this->set('_serialize', ['student']);
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
}
