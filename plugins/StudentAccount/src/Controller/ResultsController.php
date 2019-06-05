<?php
namespace StudentAccount\Controller;

use StudentAccount\Controller\AppController;

/**
 * Results Controller
 *
 *
 * @method \StudentAccount\Model\Entity\Result[] paginate($object = null, array $settings = [])
 */
class ResultsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $results = $this->paginate($this->Results);

        $this->set(compact('results'));
        $this->set('_serialize', ['results']);
    }

    /**
     * View method
     *
     * @param string|null $id Result id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $result = $this->Results->get($id, [
            'contain' => []
        ]);

        $this->set('result', $result);
        $this->set('_serialize', ['result']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $result = $this->Results->newEntity();
        if ($this->request->is('post')) {
            $result = $this->Results->patchEntity($result, $this->request->getData());
            if ($this->Results->save($result)) {
                $this->Flash->success(__('The result has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The result could not be saved. Please, try again.'));
        }
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Result id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $result = $this->Results->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $result = $this->Results->patchEntity($result, $this->request->getData());
            if ($this->Results->save($result)) {
                $this->Flash->success(__('The result has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The result could not be saved. Please, try again.'));
        }
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Result id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $result = $this->Results->get($id);
        if ($this->Results->delete($result)) {
            $this->Flash->success(__('The result has been deleted.'));
        } else {
            $this->Flash->error(__('The result could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
