<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/26/16
 * Time: 5:58 PM
 */

namespace ResultSystem\Controller;

use Cake\Datasource\ConnectionManager;
use ResultSystem\Controller\AppController;
use Cake\Core\Configure;
use Cake\Database\Schema\TableSchema;

/**
 * Class DashboardController
 * @package ResultSystem\Controller
 * @property \ResultSystem\Model\Table\ResultGradeInputsTable $ResultGradeInputs
 * @property \ResultSystem\Model\Table\ResultRemarkInputsTable $ResultRemarkInputs
 */
class DashboardController extends AppController
{
    public function settings()
    {
//        //$schema = new TableSchema('student_termly_results');
//        //debug($schema->getColumn('student_id')); exit;
//        $db = ConnectionManager::get('default');
//        // Create a schema collection.
//        $collection = $db->schemaCollection();
//        // Get the table names
//        $tables = $collection->listTables();
//        $tables = $collection->describe('student_termly_results')->columns();
//        debug($tables); exit;


    }

    public function gradeInputs()
    {
        $this->loadModel('ResultGradeInputs');
        $resultGradeInputs = $this->ResultGradeInputs->find()->toArray();
        if ( $this->request->is(['put','patch','post'])) {
            $resultGradeInputs = $this->ResultGradeInputs->patchEntities($resultGradeInputs,$this->request->getData());
            //debug($this->request->getData());
            //debug($resultGradeInputs)
            if ($this->ResultGradeInputs->saveMany($resultGradeInputs)){
                $this->Flash->success(__('The records were successfully updated!'));
            }else {
                $this->Flash->error(__('The record could not be saved!'));
            }
        }
        $this->set(compact('resultGradeInputs'));
    }

    public function remarkInputs()
    {
        $this->loadModel('ResultRemarkInputs');
        $resultRemarkInputs = $this->ResultRemarkInputs->find()->toArray();
        if ( $this->request->is(['put','patch','post'])) {
            $resultRemarkInputs = $this->ResultRemarkInputs->patchEntities($resultRemarkInputs,$this->request->getData());
            //debug($this->request->getData());
            //debug($resultGradeInputs)
            if ($this->ResultRemarkInputs->saveMany($resultRemarkInputs)){
                $this->Flash->success(__('The records were successfully updated!'));
            }else {
                $this->Flash->error(__('The record could not be saved!'));
            }
        }
        $this->set(compact('resultRemarkInputs'));
    }



    /*public function uploadBannerImage()
    {
        $this->loadModel('ResultBannerImages');

         $image = $this->ResultBannerImages->find('all')->where(['id' => 1])->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $image = $this->ResultBannerImages->patchEntity($image,$this->request->data);
            debug($image); exit;

            if($this->ResultBannerImages->save($image)) {
                $this->Flash->greatSuccess('The Image was successfully uploaded.');
            }

            return $this->redirect(['action' => 'settings']);
        }
    }*/

}