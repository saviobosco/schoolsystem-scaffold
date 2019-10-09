<?php
namespace Dashboard\Controller;

use Dashboard\Controller\AppController;

/**
 * Religions Controller
 *
 * @property \App\Model\Table\ReligionsTable $Religions
 * @method \App\Model\Entity\Religion[] paginate($object = null, array $settings = [])
 */
class ReligionsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('App.Religions');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $religions = $this->paginate($this->Religions);

        $this->set(compact('religions'));
        $this->set('_serialize', ['religions']);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function store()
    {
        $religion = $this->Religions->newEntity($this->request->getData());
        if ($this->Religions->save($religion)) {
            $this->Flash->success(__('The religion has been saved.'));
        } else {
            $this->Flash->error(__('The religion could not be saved. Please, try again.'));
        }
        return $this->redirect($this->referer());
    }

    /**
     * Edit method
     *
     * @param string|null $id Religion id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $religion = $this->Religions->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $religion = $this->Religions->patchEntity($religion, $this->request->getData());
            if ($this->Religions->save($religion)) {
                $this->Flash->success(__('The religion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The religion could not be saved. Please, try again.'));
        }
        $this->set(compact('religion'));
        $this->set('_serialize', ['religion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Religion id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $religion = $this->Religions->get($id);
        if ($this->Religions->delete($religion)) {
            $this->Flash->success(__('The religion has been deleted.'));
        } else {
            $this->Flash->error(__('The religion could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }
}
