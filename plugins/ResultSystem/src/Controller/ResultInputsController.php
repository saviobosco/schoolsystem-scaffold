<?php
namespace ResultSystem\Controller;

use Cake\Event\Event;
use ResultSystem\Controller\AppController;

/**
 * ResultInputs Controller
 *
 * @property \App\Model\Table\SessionsTable $Sessions
 * @property \ResultSystem\Model\Table\ResultGradeInputsTable $ResultGradeInputs
 */
class ResultInputsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('App.Sessions');
        $this->loadModel('ResultSystem.ResultGradeInputs');
    }

    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        if ($this->request->is('ajax')) {
            $this->viewBuilder()->setLayout('ajax');
        }
    }

    public function index()
    {
        $main_values = $this->ResultGradeInputs->getColumnValues();
        $sessions = $this->Sessions->find('list')->toArray();
        $resultInputs = $this->ResultGradeInputs->find('all');
        $this->set(compact('sessions', 'main_values', 'resultInputs'));
    }

    public function store()
    {
        $resultGradeInput = $this->ResultGradeInputs->newEntity($this->request->getData());
        if ( $this->ResultGradeInputs->save($resultGradeInput) ) {
            $this->Flash->success('Result Input was successfully added');
        } else {
            /*return $this->response->withStringBody(json_encode(['message' => 'Error Processing request. Please try again later']))
                ->withStatus(500);*/
            $this->Flash->error('Error occurred adding result input.');
        }
        return $this->redirect($this->referer());
    }

    public function edit($id = null)
    {
        $resultInput = $this->ResultGradeInputs->get($id);
        if ($this->request->is(['put', 'post', 'patch'])) {
            $resultInput = $this->ResultGradeInputs->patchEntity($resultInput, $this->request->getData());
            if ($this->ResultGradeInputs->save($resultInput)) {
                $this->Flash->success('Result Input was successfully updated!');
                $this->redirect($this->referer());
            } else {
                $this->Flash->error('Result input could not be updated!');
            }
        }
        $main_values = $this->ResultGradeInputs->getColumnValues();
        $sessions = $this->Sessions->find('list')->toArray();
        $this->set(compact('sessions', 'main_values', 'resultInput'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $resultInput = $this->ResultGradeInputs->get($id);
        if ($this->ResultGradeInputs->delete($resultInput)) {
            $this->Flash->success(__('The result input has been deleted.'));
        } else {
            $this->Flash->error(__('The result input could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }
}
