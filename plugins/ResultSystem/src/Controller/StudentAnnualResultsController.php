<?php
namespace ResultSystem\Controller;

use ResultSystem\Controller\AppController;

/**
 * StudentAnnualResults Controller
 *
 * @property \ResultSystem\Model\Table\StudentAnnualResultsTable $StudentAnnualResults
 */
class StudentAnnualResultsController extends AppController
{
    /**
     * @param null $id
     * @return \Cake\Http\Response|null
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subject = $this->StudentAnnualResults->find('all')->where(['id'=>$id])->first();
        if ($this->StudentAnnualResults->delete($subject)) {
            $this->Flash->success(__('The record has been deleted.'));
        } else {
            $this->Flash->error(__('The record could not be deleted. Please, try again.'));
        }
        return $this->redirect($this->referer());
    }
}
