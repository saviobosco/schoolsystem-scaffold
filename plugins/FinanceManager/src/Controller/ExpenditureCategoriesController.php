<?php
namespace FinanceManager\Controller;

use FinanceManager\Controller\AppController;

/**
 * ExpenditureCategories Controller
 *
 * @property \FinanceManager\Model\Table\ExpenditureCategoriesTable $ExpenditureCategories
 *
 * @method \FinanceManager\Model\Entity\ExpenditureCategory[] paginate($object = null, array $settings = [])
 */
class ExpenditureCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $expenditureCategories = $this->paginate($this->ExpenditureCategories);

        $this->set(compact('expenditureCategories'));
        $this->set('_serialize', ['expenditureCategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Expenditure Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $expenditureCategory = $this->ExpenditureCategories->get($id, [
            'contain' => []
        ]);

        $this->set('expenditureCategory', $expenditureCategory);
        $this->set('_serialize', ['expenditureCategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $expenditureCategory = $this->ExpenditureCategories->newEntity();
        if ($this->request->is('post')) {
            $expenditureCategory = $this->ExpenditureCategories->patchEntity($expenditureCategory, $this->request->getData());
            if ($this->ExpenditureCategories->save($expenditureCategory)) {
                $this->Flash->success(__('The expenditure category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The expenditure category could not be saved. Please, try again.'));
        }
        $this->set(compact('expenditureCategory'));
        $this->set('_serialize', ['expenditureCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Expenditure Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $expenditureCategory = $this->ExpenditureCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $expenditureCategory = $this->ExpenditureCategories->patchEntity($expenditureCategory, $this->request->getData());
            if ($this->ExpenditureCategories->save($expenditureCategory)) {
                $this->Flash->success(__('The expenditure category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The expenditure category could not be saved. Please, try again.'));
        }
        $this->set(compact('expenditureCategory'));
        $this->set('_serialize', ['expenditureCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Expenditure Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        try {
            $expenditureCategory = $this->ExpenditureCategories->get($id);
            if ($this->ExpenditureCategories->deleteExpenditureCategory($expenditureCategory)) {
                $this->Flash->success(__('The expenditure category has been deleted.'));
            } else {
                $this->Flash->error(__('The expenditure category could not be deleted. Please, try again.'));
            }

            return $this->redirect(['action' => 'index']);
        } catch ( \PDOException $e ) {
            $this->Flash->error(__('This expenditure category cannot be deleted because an has been record on it.'));
            return $this->redirect(['action' => 'index']);
        }

    }
}
