<?php
namespace TeacherAccount\Controller;

use Cake\ORM\TableRegistry;
use TeacherAccount\Controller\AppController;

/**
 * Dashboard Controller
 *
 */
class DashboardController extends AppController
{
    public function index()
    {
        $id = $this->Auth->user('id');
        $assignedSubjectsIds = TableRegistry::get('TeachersSubjects')->query()
            ->where(['teacher_id' => $id])
            ->extract('subject_id')
            ->toArray();
        $subjectsTable = TableRegistry::get('SubjectsManager.Subjects');

        if (! empty($assignedSubjectsIds)) {
            $assignedSubjects = $subjectsTable->query()
                ->enableHydration(false)
                ->contain(['Blocks'])
                ->where(['Subjects.id IN' => $assignedSubjectsIds])
                ->toArray();
            $this->set(compact('assignedSubjects'));
        }

        // loading the classes
        $teachersClassesTable = TableRegistry::get('TeachersClasses');
        $assignedClassesIds = $teachersClassesTable->query()
            ->where(['teacher_id' => $id])
            ->extract('class_id')->toArray();
        if (! empty($assignedClassesIds)) {
            $classesTable = TableRegistry::get('ClassManager.Classes');
            $assignedClasses = $classesTable->query()
                ->enableHydration(false)
                ->select(['id', 'class'])
                ->where(['id IN' => $assignedClassesIds])->indexBy('id')->toArray();
            $this->set(compact('assignedClasses'));
        }

        // load permissions
        $permissions = TableRegistry::get('UsersManager.TeachersSubjectsClassesPermissions')->query()
            ->enableHydration(false)
            ->select(['class_id','subjects', 'terms', 'sessions'])
            ->where(['teacher_id' => $this->Auth->user('id')])
            ->indexBy('class_id')
            ->toArray();
        $subjects = $subjectsTable->query()
            ->contain(['Blocks'])
            ->map(function($row) {
                $row->subject_name = $row->name . ' ('.$row->block->name.') ';
                return $row;
            })
            ->combine('id', 'subject_name')
            ->toArray();
        //dd($permissions);
        $terms = TableRegistry::get('Terms')->find('list')->toArray();
        $sessions = TableRegistry::get('Sessions')->find('list')->toArray();
        $this->set(compact('permissions', 'terms', 'sessions', 'subjects'));
    }
}
