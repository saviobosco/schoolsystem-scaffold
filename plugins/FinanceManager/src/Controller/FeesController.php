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

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['FeeCategories', 'Terms', 'Classes', 'Sessions']
        ];
        $fees = $this->paginate($this->Fees);

        $feeCategories = $this->Fees->FeeCategories->find('list', ['limit' => 200]);
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
        $fee = $this->Fees->newEntity();
        $feeCategories = $this->Fees->FeeCategories->find('list')->toArray();
        $terms = $this->Fees->Terms->find('list')->toArray();
        $classes = $this->Fees->Classes->find('list')->toArray();
        $sessions = $this->Fees->Sessions->find('list')->toArray();
        $this->set(compact('fee', 'feeCategories', 'terms', 'classes', 'sessions'));
        $this->set('_serialize', ['fee']);

        if ($this->request->is('ajax')) {
            $response = $this->createNewFee($fee);
            $this->response = $this->response->withDisabledCache();
            $this->response->body($response);
            return $this->response;
        }
        if ($this->request->is('post')) {
            $postData = $this->request->getData();
            $fee = $this->Fees->patchEntity($fee, $this->request->getData());
            // check if fee exists
            if ( $this->Fees->checkIfFeeExistingForTermClassSession($fee)) {
                $this->Flash->error(__(' A fee for the specified parameters already exists'));
                return;
            }
            $fee = $this->Fees->createFee($fee);
            if ($fee) {
                if ( $postData['create_students_records']) {
                    $this->Fees->createStudentsFeeRecordByClass($fee->id,$fee->class_id);
                }
                $this->Flash->success(__('The fee has been successfully created.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The fee could not be created. Please, try again.'));
        }

    }

    protected function createNewFee($fee)
    {
        $postData = $this->request->getData();

        $fee = $this->Fees->patchEntity($fee, $this->request->getData());

        // check if fee exists
        if ( $this->Fees->checkIfFeeExistingForTermClassSession($fee)) {
            return __(' A fee for the specified parameters already exists');
        }
        $fee = $this->Fees->createFee($fee);
        if ($fee) {
            if ( $postData['create_students_records']) {
                $this->Fees->createStudentsFeeRecordByClass($fee->id,$fee->class_id);
            }
            return __('The fee has been successfully created.');

        }
        return __('The fee could not be created. Please, try again.');
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
        $fee = $this->Fees->get($id, [
            'contain' => []
        ]);
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
        try {
            $fee = $this->Fees->get($id);
            if ($this->Fees->deleteFee($fee)) {
                $this->Flash->success(__('The fee has been deleted.'));
            } else {
                $this->Flash->error(__('The fee could not be deleted. Please, try again.'));
            }

            return $this->redirect(['action' => 'index']);

        } catch ( \PDOException $e ) {
            $this->Flash->error(__('This fee cannot be deleted because a payment has been made on it.'));
            return $this->redirect(['action' => 'index']);
        }

    }

    public function feeDefaulters()
    {
        $getQuery = $this->request->getQuery();

        $feeDefaulters = null;
        if ( isset($getQuery['session_id']) OR isset($getQuery['class_id']) OR isset($getQuery['term_id']) ) {

            $feeDefaulters = $this->Fees->getFeeDefaulters($getQuery);
            $students = $this->Fees->getStudentsData();
        }
        $compulsoryFees = null;
        if ( !empty($getQuery['percentage'])) {
            $compulsoryFees = $this->Fees->getCompulsoryFeesByParameters($getQuery);
        }


        $this->loadModel('Sessions');
        $this->loadModel('Classes');
        $this->loadModel('Terms');

        $terms = $this->Terms->find('list')->toArray();
        $classes = $this->Classes->find('list')->toArray();
        $sessions = $this->Sessions->find('list')->toArray();
        $this->set(compact('feeDefaulters','terms','classes','sessions','students','compulsoryFees'));
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

    public function feeStatistics( )
    {
        $this->paginate = [
            'contain' => ['FeeCategories', 'Terms', 'Classes', 'Sessions']
        ];
        $fees = $this->paginate($this->Fees);

        $feeCategories = $this->Fees->FeeCategories->find('list', ['limit' => 200]);
        $terms = $this->Fees->Terms->find('list', ['limit' => 200]);
        $classes = $this->Fees->Classes->find('list', ['limit' => 200]);
        $sessions = $this->Fees->Sessions->find('list', ['limit' => 200]);
        $this->set(compact('fees','feeCategories','terms','classes','sessions'));
        $this->set('_serialize', ['fees']);
    }

    public function feeStatistic( $id = null )
    {
        $fee = $this->Fees->get($id, [
            'contain' => ['FeeCategories', 'Terms', 'Classes', 'Sessions', 'StudentFees']
        ]);

        $this->set('fee', $fee);
        $this->set('_serialize', ['fee']);
    }

    public  function getFeeDefaulters($id = null )
    {

        $fee = $this->Fees->getFeeDefaultersByFeeId($id);

        $this->set('fee', $fee);
        $this->set('_serialize', ['fee']);
    }

    public function getFeeCompleteStudents($id = null )
    {
        $fee = $this->Fees->getFeeCompleteStudentsByFeeId($id);

        $this->set('fee', $fee);
        $this->set('_serialize', ['fee']);
    }

    public function getStudentsWithCompleteFees()
    {
        $getQuery = $this->request->getQuery();

        $feeCompleteStudents = null;
        $compulsoryFees = null;
        if ( isset($getQuery['session_id']) OR isset($getQuery['class_id']) OR isset($getQuery['term_id']) ) {

            $feeCompleteStudents = $this->Fees->getStudentWithCompleteFees($getQuery);
            $students = $this->Fees->getStudentsData();
            $compulsoryFees = $this->Fees->getCompulsoryFeesByParameters($getQuery);
        }

        $this->loadModel('Sessions');
        $this->loadModel('Classes');
        $this->loadModel('Terms');

        $terms = $this->Terms->find('list')->toArray();
        $classes = $this->Classes->find('list')->toArray();
        $sessions = $this->Sessions->find('list')->toArray();
        $this->set(compact('feeCompleteStudents','terms','classes','sessions','students','compulsoryFees'));
    }

    public function feesQuery()
    {
        $getQuery = $this->request->getQuery();

        /*$fees = null;
        if ( !empty($getQuery) ) {


        }*/
        $fees = $this->Fees->queryFeesTable($getQuery);
        $feeCategories = $this->Fees->getFeeCategoriesData();

        $this->loadModel('Sessions');
        $this->loadModel('Classes');
        $this->loadModel('Terms');

        $terms = $this->Terms->find('list')->toArray();
        $classes = $this->Classes->find('list')->toArray();
        $sessions = $this->Sessions->find('list')->toArray();
        $this->set(compact('fees','terms','classes','sessions','feeCategories'));
    }
}
