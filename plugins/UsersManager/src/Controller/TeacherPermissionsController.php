<?php
namespace UsersManager\Controller;

use UsersManager\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\TableRegistry;
/**
 * TeacherPermission Controller
 *
 */
class TeacherPermissionsController extends AppController
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
                'contain' => ['TeachersSubjectsClassesPermissions']
            ]);
            // process the data
            $postDataClasses = $this->request->getData('classes');
            $postDataPermissions = $this->request->getData('permissions');
            $permissions = [];
            if ($postDataClasses) {
                foreach ($postDataClasses as $class) {
                    $hasSubjects = (isset($postDataPermissions[$class]['subjects']) AND !empty($postDataPermissions[$class]['subjects']) AND is_array($postDataPermissions[$class]['subjects']));
                    $hasTerms = (isset($postDataPermissions[$class]['terms']) AND !empty($postDataPermissions[$class]['terms']) AND is_array($postDataPermissions[$class]['terms']));
                    $hasSessions = (isset($postDataPermissions[$class]['sessions']) AND !empty($postDataPermissions[$class]['sessions']) AND is_array($postDataPermissions[$class]['sessions']));
                    if ($hasSubjects AND $hasTerms AND $hasSessions) {
                        $permissions['teachers_subjects_classes_permissions'][] = [
                            'class_id' => $class,
                            'subjects' => serialize($postDataPermissions[$class]['subjects']),
                            'terms' => serialize($postDataPermissions[$class]['terms']),
                            'sessions' => serialize($postDataPermissions[$class]['sessions'])
                        ];
                    }
                }
            }
            if (empty($permissions)) {
                // remove all permissions
                if (is_array($teacher->teachers_subjects_classes_permissions) && !empty($teacher->teachers_subjects_classes_permissions)) {
                    foreach($teacher->teachers_subjects_classes_permissions as $permission) {
                        $usersTable->TeachersSubjectsClassesPermissions->delete($permission);
                    }
                    $this->Flash->success('Teacher permissions were successfully saved');
                }
            } else {
                $teacher = $usersTable->patchEntity($teacher, $permissions);
                if ($usersTable->save($teacher)) {
                    $this->Flash->success('Teacher permissions were successfully saved');
                } else {
                    $this->Flash->error('Teacher permissions could not be saved!. Please try again');
                }
            }
        } catch (RecordNotFoundException $exception) {
            $this->Flash->error('Teacher record does not Exist!');
        }
        return $this->redirect($this->request->referer());
    }
}
