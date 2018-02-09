<?php
namespace SubjectsManager\Controller;

use SubjectsManager\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * Subjects Controller
 *
 * @property \SubjectsManager\Model\Table\SubjectsTable $Subjects
 *
 * @method \SubjectsManager\Model\Entity\Subject[] paginate($object = null, array $settings = [])
 */
class SubjectsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'limit' => 50,
            'contain' => ['Blocks'],
            'order' => [
                'block_id' => 'asc'
            ]
        ];

        $subjects = $this->paginate($this->Subjects);

        $this->set(compact('subjects'));
        $this->set('_serialize', ['subjects']);
    }

    /**
     * View method
     *
     * @param string|null $id Subject id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        try {
            if ( empty($id) ) {
                return $this->redirect(['action'=>'index']);
            }
            $subject = $this->Subjects->get($id, [
                'contain' => ['Blocks']
            ]);

            $this->set('subject', $subject);
            $this->set('_serialize', ['subject']);
        } catch ( RecordNotFoundException $e ) {
            $this->render('/Element/Error/recordnotfound');
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subject = $this->Subjects->newEntity();
        if ($this->request->is('post')) {
            $subject = $this->Subjects->patchEntity($subject, $this->request->data);
            if ($this->Subjects->save($subject)) {
                $this->Flash->success(__('The subject has been saved.'));

                return $this->redirect($this->referer());
            } else {
                $this->Flash->error(__('The subject could not be saved. Please, try again.'));
            }
        }
        $blocks = $this->Subjects->Blocks->find('list', ['limit' => 200]);
        $this->set(compact('subject', 'blocks'));
        $this->set('_serialize', ['subject']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Subject id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        try {
            if (empty($id)) {
                return $this->redirect(['action'=>'index']);
            }
            $subject = $this->Subjects->get($id, [
                'contain' => []
            ]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $subject = $this->Subjects->patchEntity($subject, $this->request->data);
                if ($this->Subjects->save($subject)) {
                    $this->Flash->success(__('The subject has been saved.'));

                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The subject could not be saved. Please, try again.'));
                }
            }
            $blocks = $this->Subjects->Blocks->find('list', ['limit' => 200]);
            $this->set(compact('subject', 'blocks'));
            $this->set('_serialize', ['subject']);
        } catch ( RecordNotFoundException $e ) {
            $this->render('/Element/Error/recordnotfound');
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Subject id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subject = $this->Subjects->get($id);
        if ($this->Subjects->delete($subject)) {
            $this->Flash->success(__('The subject has been deleted.'));
        } else {
            $this->Flash->error(__('The subject could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
