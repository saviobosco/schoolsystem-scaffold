<?php
namespace ResultSystem\Controller;

use ResultSystem\Controller\AppController;

/**
 * StudentTermlyResults Controller
 *
 * @property \ResultSystem\Model\Table\StudentTermlyResultsTable $StudentTermlyResults
 */
class StudentTermlyResultsController extends AppController
{
    /**
     * Delete method
     *
     * @param string|null $id Student id.
     * @return \Cake\Network\Response|null Redirects to index.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subject = $this->StudentTermlyResults->find('all')->where(['id'=>$id])->first();
        if ($this->StudentTermlyResults->delete($subject)) {
            $this->Flash->success(__('The record has been deleted.'));
        } else {
            $this->Flash->error(__('The record could not be deleted. Please, try again.'));
        }
        return $this->redirect($this->referer());
    }
}
