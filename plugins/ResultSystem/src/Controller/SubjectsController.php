<?php
namespace ResultSystem\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;
use ResultSystem\Controller\AppController;
use ResultSystem\Controller\Traits\SearchParameterTrait;

/**
 * Subjects Controller
 *
 * @property \ResultSystem\Controller\Component\ResultSystemComponent $ResultSystem
 * @property \ResultSystem\Model\Table\SubjectsTable $Subjects
 * @property \App\Model\Table\SessionsTable $Sessions
 * @property \ResultSystem\Model\Table\TermsTable $Terms
 * @property \ClassManager\Model\Table\ClassesTable $Classes
 * @property \ResultSystem\Model\Table\ResultGradeInputsTable $ResultGradeInputs
 * @property \ResultSystem\Model\Table\StudentsTable $Students
 */
class SubjectsController extends AppController
{
    use SearchParameterTrait;

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('ResultSystem.ResultGradeInputs');
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Blocks'],
            'order' => [
                'Blocks.id' => 'ASC'
            ]
        ];
        $subjects = $this->paginate($this->Subjects);

        $this->set(compact('subjects'));
        $this->set('_serialize', ['subjects']);
    }

    /**
     * View method
     *
     * @param string|null $id Subject id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        try {
            $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs();
            $queryData = $this->request->getQuery();
            if( isset($queryData['term_id']) && $queryData['term_id'] == 4 ) {
                $subject = $this->Subjects->get($id, [
                    'contain' => ['Blocks']
                ]);

                $studentSubjectAnnualResults = $this->Subjects->StudentAnnualResults->find('all')
                    ->where(['subject_id' => $subject->id,
                        'session_id' => @$this->_getDefaultValue($this->request->query['session_id'],1),
                        'class_id'   => @$this->_getDefaultValue($this->request->query['class_id'],1),
                    ])->toArray();

                $studentAnnualSubjectPositions = $this->Subjects->StudentAnnualSubjectPositions->find('all')
                    ->where(['subject_id' => $subject->id,
                        'session_id' => @$this->_getDefaultValue($this->request->query['session_id'],1),
                        'class_id'   => @$this->_getDefaultValue($this->request->query['class_id'],1),
                    ])->combine('student_id','position')->toArray();

                $this->loadModel('App.Sessions');
                $this->loadModel('App.Classes');
                $this->loadModel('Terms');
                $sessions = $this->Sessions->find('list',['limit' => 200])->toArray();
                $classes = $this->Classes->find('list',['limit' => 3 ])->where(['block_id' => $subject->block_id]);
                $terms = $this->Terms->find('list',['limit' => 4])->toArray();
                $this->set(compact('subject','sessions','classes','terms','studentSubjectAnnualResults','studentAnnualSubjectPositions'));
                $this->set('_serialize', ['subject']);

                $this->render('view_annual_subject_result');

            } else {
                $subject = $this->Subjects->get($id, [
                    'contain' => ['Blocks',
                        'StudentTermlyResults' => [
                            'conditions' => [
                                'StudentTermlyResults.session_id' => @$this->_getDefaultValue($this->request->query['session_id'],1),
                                'StudentTermlyResults.class_id' => @$this->_getDefaultValue($this->request->query['class_id'],1),
                                'StudentTermlyResults.term_id' => @$this->_getDefaultValue($this->request->query['term_id'],1)
                            ]
                        ] ,
                        'StudentTermlyResults.Students' => ['fields' => ['id','first_name','last_name']],
                    ],
                ]);

                // gets the student subject positions
                $subjectStudentPositions = $this->Subjects->StudentTermlySubjectPositions->find('all')
                    ->where(['subject_id' => $subject->id,
                        'session_id' => @$this->_getDefaultValue($this->request->query['session_id'],1),
                        'class_id'   => @$this->_getDefaultValue($this->request->query['class_id'],1),
                        'term_id'    => @$this->_getDefaultValue($this->request->query['term_id'],1)
                    ])->combine('student_id','position')->toArray();

                $this->loadModel('App.Sessions');
                $this->loadModel('App.Classes');
                $this->loadModel('Terms');
                $sessions = $this->Sessions->find('list',['limit' => 200])->toArray();
                $classes = $this->Classes->find('list',['limit' => 3 ])->where(['block_id' => $subject->block_id]);
                $terms = $this->Terms->find('list',['limit' => 4])->toArray();
                $this->set(compact('gradeInputs','subject','sessions','classes','terms','subjectStudentPositions'));
                $this->set('_serialize', ['subject']);

                $this->render('view_termly_subject_result');
            }
        } catch ( RecordNotFoundException $e) {
            $this->render('/Element/Error/recordnotfound');
        }
    }

    /**
     * Add methodResult
     * @param string|null $id Subject id.
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function addResult($id = null)
    {
        $subject = $this->Subjects->get($id,['contain'=>'Blocks']);
        $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs();

        $queryData = $this->request->getQuery();
        if ( !empty($queryData)){
            // check if subject has existing value for the records
            $studentResultExists = $this->Subjects->get($id, [
                'contain' => [
                    'StudentTermlyResults' => [
                        'conditions' => [
                            'StudentTermlyResults.session_id' => $queryData['session_id'],
                            'StudentTermlyResults.term_id' => @$queryData['term_id'],
                            'StudentTermlyResults.class_id' => @$queryData['class_id']
                        ]
                    ]
                ]
            ]);
            if ( !empty($studentResultExists->student_termly_results)){
                $this->set('subjectContainsResult',true);
            }
            // get student with $queryData['class_id']
            $this->loadModel('ResultSystem.Students');
            $students = $this->Students->getStudentsWithIdAndNameByClassId($queryData['class_id']);
            $this->set(compact('students','gradeInputs'));
        } else {
            $this->set('selectParameter',true); // set the value selectParameter to true
        }
        $this->loadModel('App.Sessions');
        $this->loadModel('App.Classes');
        $this->loadModel('Terms');
        $sessions = $this->Sessions->find('list',['limit' => 200])->toArray();
        $classes = $this->Classes->find('list',['limit' => 3 ])->where(['block_id' => $subject->block_id]);
        $terms = $this->Terms->find('list',['limit' => 4])->toArray();
        $this->set(compact('subject', 'sessions','classes','terms'));
        $this->set('_serialize', ['subject','sessions','classes','terms']);
        // process post result
        if ( $this->request->is(['put','patch','post'])) {
            //debug($this->request->getData());
            $processedResults = $this->ResultSystem->processSubmittedResults($this->request->getData('student_termly_results'),$gradeInputs);
            $subjectResults = $this->Subjects->StudentTermlyResults->newEntities($processedResults);
            if ($this->Subjects->StudentTermlyResults->saveMany($subjectResults)) {
                $this->Flash->success('The results were successfully added!');
            }else {
                $this->Flash->error(__('The results could not be added. Please try again'));
            }
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Subject id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editResult($id = null)
    {
        try {
            $gradeInputs = $this->ResultGradeInputs->getValidGradeInputs();
            $queryData = $this->request->getQuery();
            $this->loadModel('Classes');
            $this->loadModel('Sessions');
            $this->loadModel('Terms');
            $sessions = $this->Sessions->find('list');
            $terms  = $this->Terms->find('list');
            $this->set(compact('sessions','terms'));

            if ( empty($queryData)) {
                $subject = $this->Subjects->get($id);
                $classes = $this->Classes->find('list')->where(['block_id' => $subject->block_id]);
                $this->set(compact('subject','classes'));
                $this->set('_serialize', ['subjects','classes','terms','sessions']);
            }else {

                if ( isset($queryData['term_id']) && $queryData['term_id'] == 4  ) {

                    $subject = $this->Subjects->get($id, [
                        'contain' => [
                            'StudentAnnualResults' => ['conditions' => [
                                'StudentAnnualResults.session_id' => $queryData['session_id'],
                                'StudentAnnualResults.class_id' => $queryData['class_id']
                            ]
                            ]
                        ]
                    ]);
                    if ($this->request->is(['patch', 'post', 'put'])) {
                        $subject = $this->Subjects->patchEntity($subject, $this->request->getData());
                        if ($this->Subjects->save($subject)) {
                            $this->Flash->success(__('The subject result was successfully updated.'));
                            return $this->redirect(['action'=>'editResult',$id,'?'=>$queryData]);
                        } else {
                            $this->Flash->error(__('The subject could not be saved. Please, try again.'));
                        }
                    }
                    $classes = $this->Classes->find('list')->where(['block_id' => $subject->block_id]);
                    $this->set(compact('subject','classes'));
                    $this->set('_serialize', ['subject']);
                    $this->render('edit_annual_subject_result');

                } else {
                    $subject = $this->Subjects->get($id, [
                        'contain' => [
                            'StudentTermlyResults' => [
                                'conditions' => [
                                    'StudentTermlyResults.session_id' => $queryData['session_id'],
                                    'StudentTermlyResults.term_id' => $queryData['term_id'],
                                    'StudentTermlyResults.class_id' => $queryData['class_id']

                                ]
                            ]
                        ]
                    ]);
                    if ($this->request->is(['patch', 'post', 'put'])) {
                        $subject = $this->Subjects->patchEntity($subject, $this->request->getData());
                        if ($this->Subjects->save($subject)) {
                            $this->Flash->success(__('The subject result was successfully updated.'));
                            return $this->redirect(['action'=>'editResult',$id,'?'=>$queryData]);
                        } else {
                            $this->Flash->error(__('The subject could not be saved. Please, try again.'));
                        }
                    }
                    $classes = $this->Classes->find('list')->where(['block_id' => $subject->block_id]);
                    $this->set(compact('gradeInputs','subject','classes'));
                    $this->set('_serialize', ['subject']);
                    $this->render('edit_termly_subject_result');
                }
            }
        } catch ( \Exception $e ) {
            $this->render('/Element/Error/recordnotfound');
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|null Redirects to index.
     */
    public function deleteSubjectResultRow($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subject = $this->Subjects->StudentTermlyResults->find('all')->where(['id'=>$id])->first();
        if ($this->Subjects->StudentTermlyResults->delete($subject)) {
            $this->Flash->success(__('The record has been deleted.'));
        } else {
            $this->Flash->error(__('The record could not be deleted. Please, try again.'));
        }
        return $this->redirect($this->referer());
    }

}
