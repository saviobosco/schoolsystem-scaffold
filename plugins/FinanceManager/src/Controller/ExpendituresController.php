<?php
namespace FinanceManager\Controller;

use FinanceManager\Controller\AppController;

/**
 * Expenditures Controller
 *
 * @property \FinanceManager\Model\Table\ExpendituresTable $Expenditures
 *
 * @method \FinanceManager\Model\Entity\Expenditure[] paginate($object = null, array $settings = [])
 */
class ExpendituresController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => [
                'ExpenditureCategories'
            ]
        ];
        $expenditures = $this->paginate($this->Expenditures);

        $this->set(compact('expenditures'));
        $this->set('_serialize', ['expenditures']);
    }

    /**
     * View method
     *
     * @param string|null $id Expenditure id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $expenditure = $this->Expenditures->get($id, [
            'contain' => [
                'ExpenditureCategories',
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

        $this->set('expenditure', $expenditure);
        $this->set('_serialize', ['expenditure']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $expenditure = $this->Expenditures->newEntity();
        if ($this->request->is('post')) {
            $expenditure = $this->Expenditures->patchEntity($expenditure, $this->request->getData());
            if ($this->Expenditures->save($expenditure)) {
                $this->Flash->success(__('The expenditure has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The expenditure could not be saved. Please, try again.'));
        }
        $expenditureCategories = $this->Expenditures->ExpenditureCategories->find('list', ['limit' => 200]);
        $this->set(compact('expenditure', 'expenditureCategories'));
        $this->set('_serialize', ['expenditure']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Expenditure id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $expenditure = $this->Expenditures->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $expenditure = $this->Expenditures->patchEntity($expenditure, $this->request->getData());
            if ($this->Expenditures->save($expenditure)) {
                $this->Flash->success(__('The expenditure has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The expenditure could not be saved. Please, try again.'));
        }
        $expenditureCategories = $this->Expenditures->ExpenditureCategories->find('list', ['limit' => 200]);
        $this->set(compact('expenditure', 'expenditureCategories'));
        $this->set('_serialize', ['expenditure']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Expenditure id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $expenditure = $this->Expenditures->get($id);
        if ($this->Expenditures->delete($expenditure)) {
            $this->Flash->success(__('The expenditure has been deleted.'));
        } else {
            $this->Flash->error(__('The expenditure could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
