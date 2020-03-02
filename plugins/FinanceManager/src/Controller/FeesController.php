<?php
namespace FinanceManager\Controller;

use FinanceManager\Controller\AppController;

/**
 * Fees Controller
 *
 * @property \FinanceManager\Model\Table\FeesTable $Fees
 * @property \FinanceManager\Model\Table\TermsTable $Terms
 * @property \FinanceManager\Model\Table\SessionsTable $Sessions
 * @property \FinanceManager\Model\Table\ClassesTable $Classes
 * @method \FinanceManager\Model\Entity\Fee[] paginate($object = null, array $settings = [])
 */
class FeesController extends AppController
{
    protected function valueIsSafe($value)
    {
        return ( (isset($value) && !empty($value)
            && filter_var($value, FILTER_VALIDATE_INT) ) );
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $queryData = $this->request->getQuery();
        $query = $this->Fees->query()
            ->contain(['FeeCategories', 'Terms', 'Classes', 'Sessions']);
        if ($this->valueIsSafe(@$queryData['fee_category_id'])) {
            $query->where(['Fees.fee_category_id' =>  $queryData['fee_category_id']]);
        }

        if (isset($queryData['session_id']) && !empty($queryData['session_id'])) {
            $query->where(['Fees.session_id' => $queryData['session_id']]);
        }

        if (isset($queryData['class_id']) && !empty($queryData['class_id'])) {
            $query->where(['Fees.class_id' => $queryData['class_id']]);
        }

        if (isset($queryData['term_id']) && !empty($queryData['term_id'])) {
            $query->where(['Fees.term_id' => $queryData['term_id']]);
        }

        $this->paginate = [
            //'contain' => ['FeeCategories', 'Terms', 'Classes', 'Sessions'],
            'limit' => 20,
            'maxLimit' => 20
        ];
        $fees = $this->paginate($query);

        /*$fees = $this->Fees->find()
            ->contain(['Sessions', 'Classes', 'Terms', 'FeeCategories'])
            ->enableHydration(false)
            ->all()
            ->groupBy('session.session')
            ->map(function ($sessionGroup, $key) {
                $children = collection($sessionGroup)->groupBy('class.class')
                    ->map(function($classGroup, $key){
                        $children = collection($classGroup)
                            ->groupBy('term.name')
                            ->toArray();
                        return [
                            'text' => $key,
                            'children' => $children
                        ];
                    })
                    ->toArray();
                return [
                    'text' => $key,
                    'children' => $children
                ] ;
            })
            ->toArray();
        dd($fees);*/

        $feeCategories = $this->Fees->FeeCategories->find('list');
        $terms = $this->Fees->Terms->find('list', ['limit' => 200]);
        $classes = $this->Fees->Classes->find('list', ['limit' => 200]);
        $sessions = $this->Fees->Sessions->find('list', ['limit' => 200]);
        $this->set(compact('fees','feeCategories','terms','classes','sessions'));
        $this->set('_serialize', ['fees']);
    }

    /**
     * View method
     *
     * @param string|null $id Fee id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fee = $this->Fees->get($id, [
            'contain' => ['FeeCategories',
                'Terms',
                'Classes',
                'Sessions',
                'StudentFees.Students',
                'CreatedByUser'=>[
                    'fields'=>[
                        'id',
                        'first_name',
                        'last_name'
                    ]
                ],
                'ModifiedByUser'=>[
                    'fields'=>[
                        'id',
                        'first_name',
                        'last_name'
                    ]
                ]
            ]
        ]);

        $this->set('fee', $fee);
        $this->set('_serialize', ['fee']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feeCategories = $this->Fees->FeeCategories->find('list')->toArray();
        $terms = $this->Fees->Terms->find('list')->toArray();
        $classes = $this->Fees->Classes->find('list')->enableHydration(false)->toArray();
        $sessions = $this->Fees->Sessions->find('list')->toArray();
        $this->set(compact('feeCategories', 'terms', 'classes', 'sessions'));
        $this->set('_serialize', ['fee']);
        if ($this->request->is('post')) {
            $postData = $this->request->getData();
            if ($this->Fees->addFee($postData)) {
                $this->Flash->success(__('The fee has been successfully created.'));
            } else {
                $this->Flash->error(__('Fee could not be created.'));
            }
            return $this->redirect($this->referer());
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Fee id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fee = $this->Fees->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fee = $this->Fees->patchEntity($fee, $this->request->getData());
            if ($this->Fees->save($fee)) {
                $this->Flash->success(__('The fee has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fee could not be saved. Please, try again.'));
        }
        $feeCategories = $this->Fees->FeeCategories->find('list', ['limit' => 200]);
        $terms = $this->Fees->Terms->find('list', ['limit' => 200]);
        $classes = $this->Fees->Classes->find('list', ['limit' => 200]);
        $sessions = $this->Fees->Sessions->find('list', ['limit' => 200]);
        $this->set(compact('fee', 'feeCategories', 'terms', 'classes', 'sessions'));
        $this->set('_serialize', ['fee']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Fee id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fee = $this->Fees->get($id);
        if ($this->Fees->deleteFee($fee)) {
            $this->Flash->success(__('The fee has been deleted.'));
        } else {
            $this->Flash->error(__('The fee could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function addFeesToStudents()
    {
        $fees = $this->Fees->getFeeWithClassSessionTerm();
        $students = $this->Fees->getStudentsData();

        $this->set(compact('fees','students'));

        if ($this->request->is(['patch', 'post', 'put'])) {
            $postData = $this->request->getData();
            if ( empty($postData['fee_id']) OR empty($postData['student_ids']) ) {
                $this->Flash->error(__('Input cant be empty'));
                return;
            }
            $result = $this->Fees->createStudentsFeeRecord($postData);
            if ($result) {
                $this->Flash->success(__('The Records were successfully created!'));
            }
        }
    }
}
