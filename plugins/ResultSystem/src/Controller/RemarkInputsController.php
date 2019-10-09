<?php
namespace ResultSystem\Controller;

use ResultSystem\Controller\AppController;

/**
 * RemarkInputs Controller
 *
 * @property \App\Model\Table\SessionsTable $Sessions
 * @property \ResultSystem\Model\Table\ResultRemarkInputsTable $ResultRemarkInputs
 */
class RemarkInputsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('App.Sessions');
        $this->loadModel('ResultSystem.ResultRemarkInputs');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $remarkInputs = $this->paginate($this->ResultRemarkInputs);
        $main_values = $this->ResultRemarkInputs->getColumnValues();
        $sessions = $this->Sessions->find('list')->toArray();
        $this->set(compact('sessions', 'main_values', 'remarkInputs'));
        $this->set('_serialize', ['remarkInputs']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function store()
    {
        if ($this->request->is('post')) {
            $remarkInput = $this->ResultRemarkInputs->newEntity($this->request->getData());
            if ($this->ResultRemarkInputs->save($remarkInput)) {
                $this->Flash->success(__('The remark input has been saved.'));
            } else {
                $this->Flash->error(__('The remark input could not be saved. Please, try again.'));
            }
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Remark Input id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $remarkInput = $this->ResultRemarkInputs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $remarkInput = $this->ResultRemarkInputs->patchEntity($remarkInput, $this->request->getData());
            if ($this->ResultRemarkInputs->save($remarkInput)) {
                $this->Flash->success(__('The remark input has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The remark input could not be saved. Please, try again.'));
        }
        $main_values = $this->ResultRemarkInputs->getColumnValues();
        $sessions = $this->Sessions->find('list')->toArray();
        $this->set(compact('remarkInput', 'main_values', 'sessions'));
        $this->set('_serialize', ['remarkInput']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Remark Input id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $remarkInput = $this->ResultRemarkInputs->get($id);
        if ($this->ResultRemarkInputs->delete($remarkInput)) {
            $this->Flash->success(__('The remark input has been deleted.'));
        } else {
            $this->Flash->error(__('The remark input could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
