<?php
namespace SkillsGradingSystem\Controller;

use SkillsGradingSystem\Controller\AppController;

/**
 * PsychomotorSkills Controller
 *
 * @property \SkillsGradingSystem\Model\Table\PsychomotorSkillsTable $PsychomotorSkills
 */
class PsychomotorSkillsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $psychomotorSkills = $this->paginate($this->PsychomotorSkills);

        $this->set(compact('psychomotorSkills'));
        $this->set('_serialize', ['psychomotorSkills']);
    }

    /**
     * View method
     *
     * @param string|null $id Psychomotor Skill id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $psychomotorSkill = $this->PsychomotorSkills->get($id, [
            'contain' => []
        ]);

        $this->set('psychomotorSkill', $psychomotorSkill);
        $this->set('_serialize', ['psychomotorSkill']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $psychomotorSkill = $this->PsychomotorSkills->newEntity();
        if ($this->request->is('post')) {
            $psychomotorSkill = $this->PsychomotorSkills->patchEntity($psychomotorSkill, $this->request->data);
            if ($this->PsychomotorSkills->save($psychomotorSkill)) {
                $this->Flash->success(__('The psychomotor skill has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The psychomotor skill could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('psychomotorSkill'));
        $this->set('_serialize', ['psychomotorSkill']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Psychomotor Skill id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $psychomotorSkill = $this->PsychomotorSkills->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $psychomotorSkill = $this->PsychomotorSkills->patchEntity($psychomotorSkill, $this->request->data);
            if ($this->PsychomotorSkills->save($psychomotorSkill)) {
                $this->Flash->success(__('The psychomotor skill has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The psychomotor skill could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('psychomotorSkill'));
        $this->set('_serialize', ['psychomotorSkill']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Psychomotor Skill id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $psychomotorSkill = $this->PsychomotorSkills->get($id);
        if ($this->PsychomotorSkills->delete($psychomotorSkill)) {
            $this->Flash->success(__('The psychomotor skill has been deleted.'));
        } else {
            $this->Flash->error(__('The psychomotor skill could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
