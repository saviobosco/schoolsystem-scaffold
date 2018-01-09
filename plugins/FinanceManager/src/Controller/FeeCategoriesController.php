<?php
namespace FinanceManager\Controller;

use FinanceManager\Controller\AppController;

/**
 * FeeCategories Controller
 *
 * @property \FinanceManager\Model\Table\FeeCategoriesTable $FeeCategories
 *
 * @method \FinanceManager\Model\Entity\FeeCategory[] paginate($object = null, array $settings = [])
 */
class FeeCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $feeCategories = $this->paginate($this->FeeCategories);

        $this->set(compact('feeCategories'));
        $this->set('_serialize', ['feeCategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Fee Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feeCategory = $this->FeeCategories->get($id, [
            'contain' => ['Fees.Sessions','Fees.Classes','Fees.Terms']
        ]);

        $this->set('feeCategory', $feeCategory);
        $this->set('_serialize', ['feeCategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feeCategory = $this->FeeCategories->newEntity();
        if ($this->request->is('post')) {
            $feeCategory = $this->FeeCategories->patchEntity($feeCategory, $this->request->getData());
            if ($this->FeeCategories->save($feeCategory)) {
                $this->Flash->success(__('The fee category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fee category could not be saved. Please, try again.'));
        }
        $this->set(compact('feeCategory'));
        $this->set('_serialize', ['feeCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Fee Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feeCategory = $this->FeeCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $feeCategory = $this->FeeCategories->patchEntity($feeCategory, $this->request->getData());
            if ($this->FeeCategories->save($feeCategory)) {
                $this->Flash->success(__('The fee category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fee category could not be saved. Please, try again.'));
        }
        $this->set(compact('feeCategory'));
        $this->set('_serialize', ['feeCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Fee Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        try {
            $feeCategory = $this->FeeCategories->get($id);
            if ($this->FeeCategories->deleteFeeCategory($feeCategory)) {
                $this->Flash->success(__('The fee category has been deleted.'));
            } else {
                $this->Flash->error(__('The fee category could not be deleted. Please, try again.'));
            }

            return $this->redirect(['action' => 'index']);

        } catch ( \PDOException $e ) {
            $this->Flash->error(__('This fee category cannot be deleted because it has fees attached to it.'));
            return $this->redirect(['action' => 'index']);
        }


    }
}
