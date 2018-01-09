<?php
namespace ResultSystem\Controller;

use ResultSystem\Controller\AppController;

/**
 * StudentGeneralRemarks Controller
 *
 * @property \ResultSystem\Model\Table\StudentGeneralRemarksTable $StudentGeneralRemarks
 */
class StudentGeneralRemarksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Students', 'Classes', 'Terms', 'Sessions']
        ];
        $studentGeneralRemarks = $this->paginate($this->StudentGeneralRemarks);

        $this->set(compact('studentGeneralRemarks'));
        $this->set('_serialize', ['studentGeneralRemarks']);
    }

    /**
     * View method
     *
     * @param string|null $id Student General Remark id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $studentGeneralRemark = $this->StudentGeneralRemarks->get($id, [
            'contain' => ['Students', 'Classes', 'Terms', 'Sessions']
        ]);

        $this->set('studentGeneralRemark', $studentGeneralRemark);
        $this->set('_serialize', ['studentGeneralRemark']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $studentGeneralRemark = $this->StudentGeneralRemarks->newEntity();
        if ($this->request->is('post')) {
            $studentGeneralRemark = $this->StudentGeneralRemarks->patchEntity($studentGeneralRemark, $this->request->data);
            if ($this->StudentGeneralRemarks->save($studentGeneralRemark)) {
                $this->Flash->success(__('The student general remark has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The student general remark could not be saved. Please, try again.'));
            }
        }
        $students = $this->StudentGeneralRemarks->Students->find('list', ['limit' => 200]);
        $classes = $this->StudentGeneralRemarks->Classes->find('list', ['limit' => 200]);
        $terms = $this->StudentGeneralRemarks->Terms->find('list', ['limit' => 200]);
        $sessions = $this->StudentGeneralRemarks->Sessions->find('list', ['limit' => 200]);
        $this->set(compact('studentGeneralRemark', 'students', 'classes', 'terms', 'sessions'));
        $this->set('_serialize', ['studentGeneralRemark']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Student General Remark id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $studentGeneralRemark = $this->StudentGeneralRemarks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $studentGeneralRemark = $this->StudentGeneralRemarks->patchEntity($studentGeneralRemark, $this->request->data);
            if ($this->StudentGeneralRemarks->save($studentGeneralRemark)) {
                $this->Flash->success(__('The student general remark has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The student general remark could not be saved. Please, try again.'));
            }
        }
        $students = $this->StudentGeneralRemarks->Students->find('list', ['limit' => 200]);
        $classes = $this->StudentGeneralRemarks->Classes->find('list', ['limit' => 200]);
        $terms = $this->StudentGeneralRemarks->Terms->find('list', ['limit' => 200]);
        $sessions = $this->StudentGeneralRemarks->Sessions->find('list', ['limit' => 200]);
        $this->set(compact('studentGeneralRemark', 'students', 'classes', 'terms', 'sessions'));
        $this->set('_serialize', ['studentGeneralRemark']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Student General Remark id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $studentGeneralRemark = $this->StudentGeneralRemarks->get($id);
        if ($this->StudentGeneralRemarks->delete($studentGeneralRemark)) {
            $this->Flash->success(__('The student general remark has been deleted.'));
        } else {
            $this->Flash->error(__('The student general remark could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
