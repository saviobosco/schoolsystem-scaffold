<?php
namespace SkillsGradingSystem\Controller;

use SkillsGradingSystem\Controller\AppController;

/**
 * AffectiveDispositions Controller
 *
 * @property \SkillsGradingSystem\Model\Table\AffectiveDispositionsTable $AffectiveDispositions
 */
class AffectiveDispositionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $affectiveDispositions = $this->paginate($this->AffectiveDispositions);

        $this->set(compact('affectiveDispositions'));
        $this->set('_serialize', ['affectiveDispositions']);
    }

    /**
     * View method
     *
     * @param string|null $id Affective Disposition id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $affectiveDisposition = $this->AffectiveDispositions->get($id, [
            'contain' => []
        ]);

        $this->set('affectiveDisposition', $affectiveDisposition);
        $this->set('_serialize', ['affectiveDisposition']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $affectiveDisposition = $this->AffectiveDispositions->newEntity();
        if ($this->request->is('post')) {
            $affectiveDisposition = $this->AffectiveDispositions->patchEntity($affectiveDisposition, $this->request->data);
            if ($this->AffectiveDispositions->save($affectiveDisposition)) {
                $this->Flash->success(__('The affective disposition has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The affective disposition could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('affectiveDisposition'));
        $this->set('_serialize', ['affectiveDisposition']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Affective Disposition id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $affectiveDisposition = $this->AffectiveDispositions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $affectiveDisposition = $this->AffectiveDispositions->patchEntity($affectiveDisposition, $this->request->data);
            if ($this->AffectiveDispositions->save($affectiveDisposition)) {
                $this->Flash->success(__('The affective disposition has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The affective disposition could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('affectiveDisposition'));
        $this->set('_serialize', ['affectiveDisposition']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Affective Disposition id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $affectiveDisposition = $this->AffectiveDispositions->get($id);
        if ($this->AffectiveDispositions->delete($affectiveDisposition)) {
            $this->Flash->success(__('The affective disposition has been deleted.'));
        } else {
            $this->Flash->error(__('The affective disposition could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
