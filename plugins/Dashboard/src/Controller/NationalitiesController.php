<?php
namespace Dashboard\Controller;

use Dashboard\Controller\AppController;

/**
 * Nationalities Controller
 *
 * @property \App\Model\Table\NationalitiesTable $Nationalities
 * @method \App\Model\Entity\Nationality[] paginate($object = null, array $settings = [])
 */
class NationalitiesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('App.Nationalities');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $nationalities = $this->paginate($this->Nationalities);

        $this->set(compact('nationalities'));
        $this->set('_serialize', ['nationalities']);
    }

    /**
     * View method
     *
     * @param string|null $id Nationality id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $nationality = $this->Nationalities->get($id, [
            'contain' => []
        ]);

        $this->set('nationality', $nationality);
        $this->set('_serialize', ['nationality']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function store()
    {
        $nationality = $this->Nationalities->newEntity($this->request->getData());
        if ($this->Nationalities->save($nationality)) {
            $this->Flash->success(__('The nationality has been saved.'));
        } else {
            $this->Flash->error(__('The nationality could not be saved. Please, try again.'));
        }
        return $this->redirect($this->referer());
    }

    /**
     * Edit method
     *
     * @param string|null $id Nationality id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $nationality = $this->Nationalities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $nationality = $this->Nationalities->patchEntity($nationality, $this->request->getData());
            if ($this->Nationalities->save($nationality)) {
                $this->Flash->success(__('The nationality has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The nationality could not be saved. Please, try again.'));
        }
        $this->set(compact('nationality'));
        $this->set('_serialize', ['nationality']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Nationality id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $nationality = $this->Nationalities->get($id);
        if ($this->Nationalities->delete($nationality)) {
            $this->Flash->success(__('The nationality has been deleted.'));
        } else {
            $this->Flash->error(__('The nationality could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
