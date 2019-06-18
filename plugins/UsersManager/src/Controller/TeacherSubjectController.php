<?php
namespace UsersManager\Controller;

use UsersManager\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\TableRegistry;
/**
 * TeacherSubject Controller
 *
 */
class TeacherSubjectController extends AppController
{
    public function update($id = null)
    {
        if ($id === null) {
            $this->Flash->error('No Teacher id found!');
            return $this->redirect($this->request->referer());
        }
        try {
            $usersTable = TableRegistry::get('UsersManager.Accounts');
            $teacher = $usersTable->get($id,[
                'fields' => ['id'],
                'contain' => ['Subjects']
            ]);
            if ($this->request->is('post')) {
                // if the data was passed in the request.
                // Remove any subject attached to the teacher
                if (empty($this->request->getData())) {
                    foreach($teacher->subjects as $subject) {
                        TableRegistry::get('TeachersSubjects')->delete($subject->_joinData);
                    }
                    $this->Flash->success('Teacher subjects were successfully saved');
                } else {
                    $teacher = $usersTable->patchEntity($teacher, $this->request->getData());
                    if ($usersTable->save($teacher)) {
                        $this->Flash->success('Teacher subjects were successfully saved');
                    } else {
                        $this->Flash->error('Teacher subjects could not be saved!. Please try again');
                    }
                }
            }
        } catch (RecordNotFoundException $exception) {
            $this->Flash->error('Teacher record does not Exist!');
        }
        return $this->redirect($this->request->referer());
    }
}
