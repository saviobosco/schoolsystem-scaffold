<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/16/16
 * Time: 3:39 PM
 */

namespace Dasboard\View\Cell;


use Cake\View\Cell;

class DashboardCell extends Cell
{
    public function display()
    {

    }

    public function getNumberOfStudents()
    {
        $this->loadModel('StudentsManager.Students');
        $schools = $this->Students->find('all');
        $this->set('schools', $schools->count());
    }

    public function getNumberOfAdmins()
    {
        $this->loadModel('UsersManager.Accounts');
        $students = $this->Accounts->find('all');
        $this->set('admins', $students->count());
    }

    public function getNumberOfSubjects()
    {
        $this->loadModel('SubjectsManager.Subjects');
        $courses = $this->Subjects->find();
        $this->set('courses', $courses->count());
    }

    public function getNumberOfSessions()
    {
        $this->loadModel('ResultSystem.Sessions');
        $sessions = $this->Sessions->find();
        $this->set('sessions', $sessions->count());
    }
}