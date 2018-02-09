<?php
namespace ClassManager\Controller;

use ClassManager\Controller\AppController;

/**
 * ClassDemarcations Controller
 *
 * @property \ClassManager\Model\Table\ClassDemarcationsTable $ClassDemarcations
 *
 * @method \ClassManager\Model\Entity\ClassDemarcation[] paginate($object = null, array $settings = [])
 */
class ClassDemarcationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Classes']
        ];
        $classDemarcations = $this->paginate($this->ClassDemarcations);

        $this->set(compact('classDemarcations'));
        $this->set('_serialize', ['classDemarcations']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $classDemarcation = $this->ClassDemarcations->newEntity();
        if ($this->request->is('post')) {
            $classDemarcation = $this->ClassDemarcations->patchEntity($classDemarcation, $this->request->getData());
            if ($this->ClassDemarcations->save($classDemarcation)) {
                $this->Flash->success(__('The class demarcation has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The class demarcation could not be saved. Please, try again.'));
            }
        }
        $classes = $this->ClassDemarcations->Classes->find('list', ['limit' => 200]);
        $this->set(compact('classDemarcation', 'classes'));
        $this->set('_serialize', ['classDemarcation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Class Demacation id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $classDemarcation = $this->ClassDemarcations->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $classDemarcation = $this->ClassDemarcations->patchEntity($classDemarcation, $this->request->getData());
            if ($this->ClassDemarcations->save($classDemarcation)) {
                $this->Flash->success(__('The class demarcation has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The class demarcation could not be saved. Please, try again.'));
            }
        }
        $classes = $this->ClassDemarcations->Classes->find('list', ['limit' => 200]);
        $this->set(compact('classDemarcation', 'classes'));
        $this->set('_serialize', ['classDemarcation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Class Demarcation id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $classDemarcation = $this->ClassDemarcations->get($id);
        if ($this->ClassDemarcations->delete($classDemarcation)) {
            $this->Flash->success(__('The class demarcation has been deleted.'));
        } else {
            $this->Flash->error(__('The class demarcation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
