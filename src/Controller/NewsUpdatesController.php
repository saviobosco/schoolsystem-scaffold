<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * NewsUpdates Controller
 *
 *
 * @method \App\Model\Entity\NewsUpdate[] paginate($object = null, array $settings = [])
 */
class NewsUpdatesController extends AppController
{

    public function initialize()
    {
        $this->loadModel('Dashboard.NewsUpdates');
        parent::initialize();
        $this->Auth->allow();
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'order' => [
                'default_post' => 'desc',
                'created' => 'desc',
            ]
        ];
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
    public function view($slug)
    {
        try {
            $newsUpdate = $this->NewsUpdates->findByTitleSlug($slug)->firstOrFail();
            $this->set('newsUpdate', $newsUpdate);
            $this->set('_serialize', ['newsUpdate']);
        } catch ( \Exception $exception ) {
            $this->Flash->error('Could not find post.');
        }

    }
}
