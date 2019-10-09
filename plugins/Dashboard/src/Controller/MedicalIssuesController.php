<?php
namespace Dashboard\Controller;

use Dashboard\Controller\AppController;

/**
 * MedicalIssues Controller
 *
 * @property \App\Model\Table\MedicalIssuesTable $MedicalIssues
 * @method \App\Model\Entity\MedicalIssue[] paginate($object = null, array $settings = [])
 */
class MedicalIssuesController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('App.MedicalIssues');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $medicalIssues = $this->paginate($this->MedicalIssues);

        $this->set(compact('medicalIssues'));
        $this->set('_serialize', ['medicalIssues']);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function store()
    {
        $medicalIssue = $this->MedicalIssues->newEntity($this->request->getData());
        if ($this->MedicalIssues->save($medicalIssue)) {
            $this->Flash->success(__('The medical issue has been saved.'));
        } else {
            $this->Flash->error(__('The medical issue could not be saved. Please, try again.'));
        }
        return $this->redirect($this->referer());
    }

    /**
     * Edit method
     *
     * @param string|null $id Medical Issue id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $medicalIssue = $this->MedicalIssues->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $medicalIssue = $this->MedicalIssues->patchEntity($medicalIssue, $this->request->getData());
            if ($this->MedicalIssues->save($medicalIssue)) {
                $this->Flash->success(__('The medical issue has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The medical issue could not be saved. Please, try again.'));
        }
        $this->set(compact('medicalIssue'));
        $this->set('_serialize', ['medicalIssue']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Medical Issue id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $medicalIssue = $this->MedicalIssues->get($id);
        if ($this->MedicalIssues->delete($medicalIssue)) {
            $this->Flash->success(__('The medical issue has been deleted.'));
        } else {
            $this->Flash->error(__('The medical issue could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }
}
