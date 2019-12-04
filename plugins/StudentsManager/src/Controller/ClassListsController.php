<?php
namespace StudentsManager\Controller;

use Settings\Core\Setting;
use StudentsManager\Controller\AppController;

/**
 * ClassLists Controller
 *
 * @property \StudentsManager\Model\Table\StudentsTable $Students
 */
class ClassListsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('StudentsManager.Students');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $classes = $this->Students->Classes->find('list')->toArray();
        $this->set(compact('classes'));
    }

    public function create()
    {
        if ($this->request->is('post')) {
            $postData = $this->request->getData();
            $students = $this->Students->query()
                ->enableHydration(false)
                ->select([
                    'Admission Number' => 'id',
                    'Name' => "concat(first_name,' ', last_name)"
                ])
                ->where([
                    'class_id' => $postData['class_id'],
                    'status' => 1
                ])
                ->toArray();
            if (empty($students)) {
                $this->Flash->error('No student(s) found!');
                return $this->redirect($this->referer());
            }
            $classes = $this->Students->Classes->find('list')->toArray();
            $workSheetName = $classes[$postData['class_id']] .' Student List';
            $this->set(compact('students', 'workSheetName'));
        }
    }
}
