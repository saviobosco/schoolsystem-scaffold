<?php
namespace UsersManager\Controller;

use UsersManager\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\TableRegistry;
/**
 * TeacherClass Controller
 *
 */
class TeacherClassController extends AppController
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
                'contain' => ['Classes']
            ]);
            if ($this->request->is('post')) {
                if (empty($this->request->getData())) {
                    foreach($teacher->classes as $class) {
                        TableRegistry::get('TeachersClasses')->delete($class->_joinData);
                    }
                    $this->Flash->success('Teacher classes were successfully saved');
                } else {
                    $teacher = $usersTable->patchEntity($teacher, $this->request->getData());
                    if ($usersTable->save($teacher)) {
                        $this->Flash->success('Teacher classes were successfully saved');
                    } else {
                        $this->Flash->error('Teacher classes could not be saved!. Please try again');
                    }
                }
            }
        } catch (RecordNotFoundException $exception) {
            $this->Flash->error('Teacher record does not Exist!');
        }
        return $this->redirect($this->request->referer());
    }
}
