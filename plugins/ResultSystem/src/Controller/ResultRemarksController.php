<?php
namespace ResultSystem\Controller;

use ResultSystem\Controller\AppController;

/**
 * ResultRemarks Controller
 *
 * @property \ResultSystem\Model\Table\ResultRemarksTable $ResultRemarks
 * @property \ResultSystem\Model\Table\ResultRemarkInputsTable $ResultRemarkInputs
 *
 * @method \ResultSystem\Model\Entity\ResultRemark[] paginate($object = null, array $settings = [])
 */
class ResultRemarksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Classes', 'Sessions','ResultRemarkInputs']
        ];
        $resultRemarks = $this->paginate($this->ResultRemarks);

        $this->set(compact('resultRemarks'));
        $this->set('_serialize', ['resultRemarks']);
    }

    /**
     * View method
     *
     * @param string|null $id Result Remark id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $resultRemark = $this->ResultRemarks->get($id, [
            'contain' => ['Classes', 'Sessions']
        ]);

        $this->set('resultRemark', $resultRemark);
        $this->set('_serialize', ['resultRemark']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $resultRemark = $this->ResultRemarks->newEntity();
        if ($this->request->is('post')) {
            $resultRemark = $this->ResultRemarks->patchEntity($resultRemark, $this->request->getData());
            if ($this->ResultRemarks->save($resultRemark)) {
                $this->Flash->success(__('The result remark has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The result remark could not be saved. Please, try again.'));
        }
        $this->loadModel('ResultSystem.ResultRemarkInputs');
        $remarkInputs = $this->ResultRemarkInputs->getValidRemarkInputs();
        $classes = $this->ResultRemarks->Classes->find('list', ['limit' => 200]);
        $sessions = $this->ResultRemarks->Sessions->find('list', ['limit' => 200]);
        $this->set(compact('resultRemark', 'terms', 'classes', 'sessions','remarkInputs'));
        $this->set('_serialize', ['resultRemark']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Result Remark id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $resultRemark = $this->ResultRemarks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $resultRemark = $this->ResultRemarks->patchEntity($resultRemark, $this->request->getData());
            if ($this->ResultRemarks->save($resultRemark)) {
                $this->Flash->success(__('The result remark has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The result remark could not be saved. Please, try again.'));
        }
        $this->loadModel('ResultSystem.ResultRemarkInputs');
        $remarkInputs = $this->ResultRemarkInputs->getValidRemarkInputs();
        $classes = $this->ResultRemarks->Classes->find('list', ['limit' => 200]);
        $sessions = $this->ResultRemarks->Sessions->find('list', ['limit' => 200]);
        $this->set(compact('resultRemark', 'terms', 'classes', 'sessions','remarkInputs'));
        $this->set('_serialize', ['resultRemark']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Result Remark id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $resultRemark = $this->ResultRemarks->get($id);
        if ($this->ResultRemarks->delete($resultRemark)) {
            $this->Flash->success(__('The result remark has been deleted.'));
        } else {
            $this->Flash->error(__('The result remark could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
