<?php
namespace TimesTable\Controller;

use TimesTable\Controller\AppController;

/**
 * TermTimeTables Controller
 *
 * @property \TimesTable\Model\Table\TermTimeTablesTable $TermTimeTables
 */
class TermTimeTablesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Terms', 'Sessions']
        ];
        $termTimeTables = $this->paginate($this->TermTimeTables);

        $this->set(compact('termTimeTables'));
        $this->set('_serialize', ['termTimeTables']);
    }

    /**
     * View method
     *
     * @param string|null $id Term Time Table id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $termTimeTable = $this->TermTimeTables->get($id, [
            'contain' => ['Terms', 'Sessions']
        ]);

        $this->set('termTimeTable', $termTimeTable);
        $this->set('_serialize', ['termTimeTable']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $termTimeTable = $this->TermTimeTables->newEntity();
        if ($this->request->is('post')) {
            $postData = $this->request->getData();
            if ($postData['start_date'] === $postData['end_date'] || $postData['start_date'] > $postData['end_date'] || $postData['end_date'] < $postData['start_date']) {
                $this->Flash->error('Error in starting or ending term dates.');
                return $this->redirect($this->referer());
            }
            if ($this->TermTimeTables->query()->where([
                'session_id' => $postData['session_id'],
                'term_id' => $postData['term_id']])->first()) {
                $this->Flash->error('Record for the selected session and term already exist!');
                return $this->redirect($this->referer());
            }
            $termTimeTable = $this->TermTimeTables->patchEntity($termTimeTable, $postData);

            if ($this->TermTimeTables->save($termTimeTable)) {
                $this->Flash->success(__('The term time table has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The term time table could not be saved. Please, try again.'));
            }
        }
        $terms = $this->TermTimeTables->Terms->find('list', ['limit' => 200]);
        $sessions = $this->TermTimeTables->Sessions->find('list', ['limit' => 200]);
        $this->set(compact('termTimeTable', 'terms', 'sessions'));
        $this->set('_serialize', ['termTimeTable']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Term Time Table id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $termTimeTable = $this->TermTimeTables->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $termTimeTable = $this->TermTimeTables->patchEntity($termTimeTable, $this->request->data);
            if ($this->TermTimeTables->save($termTimeTable)) {
                $this->Flash->success(__('The term time table has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The term time table could not be saved. Please, try again.'));
            }
        }
        $terms = $this->TermTimeTables->Terms->find('list', ['limit' => 200]);
        $sessions = $this->TermTimeTables->Sessions->find('list', ['limit' => 200]);
        $this->set(compact('termTimeTable', 'terms', 'sessions'));
        $this->set('_serialize', ['termTimeTable']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Term Time Table id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $termTimeTable = $this->TermTimeTables->get($id);
        if ($this->TermTimeTables->delete($termTimeTable)) {
            $this->Flash->success(__('The term time table has been deleted.'));
        } else {
            $this->Flash->error(__('The term time table could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
