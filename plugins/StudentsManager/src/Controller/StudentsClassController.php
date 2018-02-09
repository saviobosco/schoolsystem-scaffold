<?php
namespace StudentsManager\Controller;

use StudentsManager\Controller\AppController;

/**
 * StudentsClass Controller
 * @property \StudentsManager\Model\Table\SessionsTable $Sessions
 * @property \StudentsManager\Model\Table\StudentsTable $Students
 */
class StudentsClassController extends AppController
{

    public function changeClass()
    {
        $students = null;

        if (!empty($this->request->getQuery('class_id'))) {
            $this->paginate = [
                'limit' => 1000,
                'maxLimit' => 1000,
                'contain' => ['Classes'],
                'conditions' => [
                    'Students.status'   => 1,
                    'Students.class_id' => $this->request->getQuery('class_id')
                ],
            ];
            $students = $this->paginate($this->Students);
        }
        $classes = $this->Students->Classes->find('list');
        $this->set(compact('students','classes'));
        $this->set('_serialize', ['students']);

        if ( $this->request->is(['patch', 'post', 'put']) ) {
            // get postData
            $postData = $this->request->getData();
            if ( empty($postData['change_class_id'])) {
                $this->Flash->error(__('Please select a class to change students to .... '));
                return;
            }
            if ( empty($postData['student_ids'])) {
                $this->Flash->error(__('No Student was selected. Please select a student(s)'));
                return;
            }
            $returnData = $this->Students->changeStudentsClass($postData['change_class_id'],$postData['student_ids']);
            if ($returnData['success'] ) {
                $this->Flash->success(__('The selected students class was successfully changed'));
                return $this->redirect($this->request->referer());
            } else {
                $this->Flash->error(__('The specified class and current class are the same.'));
            }
        }
    }
}
