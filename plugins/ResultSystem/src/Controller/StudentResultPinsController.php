<?php
namespace ResultSystem\Controller;

use Cake\I18n\Time;
use ResultSystem\Controller\AppController;
use RandomLib\Factory;
use SecurityLib\Strength;

/**
 * StudentResultPins Controller
 *
 * @property \ResultSystem\Model\Table\StudentResultPinsTable $StudentResultPins
 */
class StudentResultPinsController extends AppController
{

    /**
     * Delete method
     *
     * @param string|null $id Student Result Pin id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $studentResultPin = $this->StudentResultPins->get($id);
        if ($this->StudentResultPins->delete($studentResultPin)) {
            $this->Flash->success(__('The student result pin has been deleted.'));
        } else {
            $this->Flash->error(__('The student result pin could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function generatePin()
    {
        $postData = $this->request->getData();
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ( !empty($postData)) {
                $num = $this->StudentResultPins->savePins($postData);
                $this->Flash->success(__('{0} pins were successfully generated',$num));
            } else {
                $this->Flash->error('Could not generate pin');
            }
        }
        $title = 'Generate New Pins';
        $this->set(compact('pins','title'));
        $this->set('_serialize', ['pins']);
    }

    public function printPin()
    {
        $pins = $this->StudentResultPins->find('all')->contain(['Terms','Sessions','Classes']);
        $title = 'Result Checking Pins';
        $this->set(compact('pins','title'));
        $this->set('_serialize', ['pins']);
    }

    public function excelFormat()
    {
        if ( $this->request->is(['post']) ) {
            $applicationPins = $this->StudentResultPins->find('all')
                ->select(['serial_number','pin'])
                ->where([
                    'student_id IS NULL',
                    [
                        'DATE(created)'=>(new Time($this->request->getData('created')))->i18nFormat('yyyy-MM-dd')
                    ]
                ])->enableHydration(false)->toArray();
            if ( empty($applicationPins)) {
                $this->Flash->error('No pin found');
                return $this->redirect($this->referer());
            }
            $this->set(compact('applicationPins'));
            $this->set('_serialize', ['applicationPins']);
        }

    }
}
