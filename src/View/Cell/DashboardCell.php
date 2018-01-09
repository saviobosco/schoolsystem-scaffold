<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 5/16/16
 * Time: 3:39 PM
 */

namespace App\View\Cell;


use Cake\View\Cell;

class DashboardCell extends Cell
{
    public function display()
    {

    }

    public function getNumberOfStudents()
    {
        $this->loadModel('Students');
        $schools = $this->Students->find('all');
        $this->set('schools', $schools->count());
    }

    public function getNumberOfAdmins()
    {
        $this->loadModel('MyUsers');
        $students = $this->MyUsers->find('all');
        $this->set('admins', $students->count());
    }

    public function getNumberOfSubjects()
    {
        $this->loadModel('Subjects');
        $courses = $this->Subjects->find();
        $this->set('courses', $courses->count());
    }

    public function getNumberOfSessions()
    {
        $this->loadModel('Sessions');
        $sessions = $this->Sessions->find();
        $this->set('sessions', $sessions->count());
    }

    public function getNumberOfEntrancePins()
    {
        $this->loadModel('EntranceResultPins');
        $pins = $this->EntranceResultPins->find()->where(['applicant_id IS NOT NULL ']);
        $this->set('pins',$pins->count());
    }
}