<?php
namespace Dashboard\Controller;

use Dashboard\Controller\AppController;

/**
 * Nationalities Controller
 *
 * @property \App\Model\Table\StudentTypesTable $StudentTypes
 */
class StudentTypesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('App.StudentTypes');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $studentTypes = $this->paginate($this->StudentTypes);

        $this->set(compact('studentTypes'));
        $this->set('_serialize', ['studentTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id StudentType id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $studentType = $this->StudentTypes->get($id);

        $this->set('studentType', $studentType);
        $this->set('_serialize', ['studentType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function store()
    {
        $nationality = $this->StudentTypes->newEntity($this->request->getData());
        if ($this->StudentTypes->save($nationality)) {
            $this->Flash->success(__('The student type has been saved.'));
        } else {
            $this->Flash->error(__('The student type could not be saved. Please, try again.'));
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
        $studentType = $this->StudentTypes->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $studentType = $this->StudentTypes->patchEntity($studentType, $this->request->getData());
            if ($this->StudentTypes->save($studentType)) {
                $this->Flash->success(__('The student type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The student type could not be saved. Please, try again.'));
        }
        $this->set(compact('studentType'));
        $this->set('_serialize', ['studentType']);
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
        $nationality = $this->StudentTypes->get($id);
        if ($this->StudentTypes->delete($nationality)) {
            $this->Flash->success(__('The student type has been deleted.'));
        } else {
            $this->Flash->error(__('The student type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
