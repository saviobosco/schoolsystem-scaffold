<?php
namespace Dashboard\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Dashboard\Controller\AppController;

/**
 * NewsUpdates Controller
 *
 * @property \Dashboard\Model\Table\NewsUpdatesTable $NewsUpdates
 * @method \Dashboard\Model\Entity\NewsUpdate[] paginate($object = null, array $settings = [])
 */
class NewsUpdatesController extends AppController
{

    public function initialize()
    {
        parent::initialize();
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $newsUpdates = $this->paginate($this->NewsUpdates);

        $this->set(compact('newsUpdates'));
        $this->set('_serialize', ['newsUpdates']);
    }

    /**
     * View method
     *
     * @param string|null $id News Update id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $newsUpdate = $this->NewsUpdates->get($id, [
            'contain' => []
        ]);

        $this->set('newsUpdate', $newsUpdate);
        $this->set('_serialize', ['newsUpdate']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $newsUpdate = $this->NewsUpdates->newEntity();
        if ($this->request->is('post')) {
            $newsUpdate = $this->NewsUpdates->patchEntity($newsUpdate, $this->request->getData());
            if ($this->NewsUpdates->save($newsUpdate)) {
                $this->Flash->success(__('The news update has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The news update could not be saved. Please, try again.'));
        }
        $this->set(compact('newsUpdate'));
        $this->set('_serialize', ['newsUpdate']);
    }

    /**
     * Edit method
     *
     * @param string|null $id News Update id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $newsUpdate = $this->NewsUpdates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $newsUpdate = $this->NewsUpdates->patchEntity($newsUpdate, $this->request->getData());
            if ($this->NewsUpdates->save($newsUpdate)) {
                $this->Flash->success(__('The news update has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The news update could not be saved. Please, try again.'));
        }
        $this->set(compact('newsUpdate'));
        $this->set('_serialize', ['newsUpdate']);
    }

    /**
     * Delete method
     *
     * @param string|null $id News Update id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $newsUpdate = $this->NewsUpdates->get($id);
        if ($this->NewsUpdates->delete($newsUpdate)) {
            $this->Flash->success(__('The news update has been deleted.'));
        } else {
            $this->Flash->error(__('The news update could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
