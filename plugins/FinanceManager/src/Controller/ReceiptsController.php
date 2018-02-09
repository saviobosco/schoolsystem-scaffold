<?php
namespace FinanceManager\Controller;

use FinanceManager\Controller\AppController;

/**
 * Receipts Controller
 *
 * @property \FinanceManager\Model\Table\ReceiptsTable $Receipts
 * @property \FinanceManager\Model\Table\SessionsTable $Sessions
 * @property \FinanceManager\Model\Table\ClassesTable $Classes
 * @property \FinanceManager\Model\Table\TermsTable $Terms
 *
 * @method \FinanceManager\Model\Entity\Receipt[] paginate($object = null, array $settings = [])
 */
class ReceiptsController extends AppController
{

    public function initialize()
    {
        $this->loadModel('FinanceManager.Classes');
        $this->loadModel('FinanceManager.Sessions');
        $this->loadModel('FinanceManager.Terms');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => [
                'Students' => [
                    'fields'=>[
                        'id',
                        'first_name',
                        'last_name'
                    ]
                ],
                'Payments',
                'CreatedByUser'=>[
                    'fields'=>[
                        'id',
                        'first_name',
                        'last_name'
                    ]
                ]
            ],
            'order' => [
                'created' => 'ASC'
            ]
        ];
        $receipts = $this->paginate($this->Receipts);
        $this->set(compact('receipts'));
        $this->set('_serialize', ['receipts']);
    }

    /**
     * View method
     *
     * @param string|null $id Receipt id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $receipt = $this->Receipts->get($id, [
            'contain' => [
                'Students',
                'Payments.PaymentTypes',
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
        $classes = $this->Classes->find('list')->toArray();
        $sessions = $this->Sessions->find('list')->toArray();
        $terms = $this->Terms->find('list')->toArray();
        $receiptDetails = $this->Receipts->getReceiptDetails($id);
        $this->set(compact('receipt','receiptDetails','sessions','classes','terms'));
        $this->set('_serialize', ['receipt']);
    }

    public function printReceipt( $id = null )
    {
        $receipt = $this->Receipts->get($id, [
            'contain' => [
                'Students.Classes',
                'Payments.PaymentTypes',
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
        $receiptDetails = $this->Receipts->getReceiptDetails($id);
        $terms = $this->Terms->find('list')->toArray();
        $classes = $this->Classes->find('list')->toArray();
        $sessions = $this->Sessions->find('list')->toArray();
        $this->set(compact('receipt','terms','classes','sessions','receiptDetails'));
        $this->set('_serialize', ['receipt']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Receipt id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $receipt = $this->Receipts->get($id, [
            'contain' => ['StudentFeePayments','Payments']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $receipt = $this->Receipts->patchEntity($receipt, $this->request->getData());
            if ($this->Receipts->save($receipt)) {
                $this->Flash->success(__('The receipt has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The receipt could not be saved. Please, try again.'));
        }
        $students = $this->Receipts->Students->getStudentsDataList();
        $paymentTypes = $this->Receipts->Payments->PaymentTypes->find('list', ['limit' => 200]);
        $this->set(compact('receipt', 'students','paymentTypes'));
        $this->set('_serialize', ['receipt']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Receipt id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        try {
            $receipt = $this->Receipts->get($id);
            if ($this->Receipts->deleteReceipt($receipt)) {
                $this->Flash->success(__('The receipt has been deleted.'));
            } else {
                $this->Flash->error(__('The receipt could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        } catch ( \PDOException $e ) {
            $this->Flash->error(__('This receipt cannot be deleted!!!'));
            return $this->redirect(['action' => 'index']);
        }


    }
}
