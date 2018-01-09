<?php
namespace ResultSystem\Controller;

use ResultSystem\Controller\AppController;

/**
 * ResultGradingSystems Controller
 *
 * @property \ResultSystem\Model\Table\ResultGradingSystemsTable $ResultGradingSystems
 */
class ResultGradingSystemsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $resultGradingSystems = $this->paginate($this->ResultGradingSystems);

        $this->set(compact('resultGradingSystems'));
        $this->set('_serialize', ['resultGradingSystems']);
    }

    /**
     * View method
     *
     * @param string|null $id Result Grading System id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $resultGradingSystem = $this->ResultGradingSystems->get($id, [
            'contain' => []
        ]);

        $this->set('resultGradingSystem', $resultGradingSystem);
        $this->set('_serialize', ['resultGradingSystem']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $resultGradingSystem = $this->ResultGradingSystems->newEntity();
        if ($this->request->is('post')) {
            $resultGradingSystem = $this->ResultGradingSystems->patchEntity($resultGradingSystem, $this->request->data);
            if ($this->ResultGradingSystems->save($resultGradingSystem)) {
                $this->Flash->success(__('The result grading system has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The result grading system could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('resultGradingSystem'));
        $this->set('_serialize', ['resultGradingSystem']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Result Grading System id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $resultGradingSystem = $this->ResultGradingSystems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $resultGradingSystem = $this->ResultGradingSystems->patchEntity($resultGradingSystem, $this->request->data);
            if ($this->ResultGradingSystems->save($resultGradingSystem)) {
                $this->Flash->success(__('The result grading system has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The result grading system could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('resultGradingSystem'));
        $this->set('_serialize', ['resultGradingSystem']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Result Grading System id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $resultGradingSystem = $this->ResultGradingSystems->get($id);
        if ($this->ResultGradingSystems->delete($resultGradingSystem)) {
            $this->Flash->success(__('The result grading system has been deleted.'));
        } else {
            $this->Flash->error(__('The result grading system could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
