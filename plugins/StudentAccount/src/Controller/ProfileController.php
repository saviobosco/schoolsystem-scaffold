<?php
namespace StudentAccount\Controller;

use StudentAccount\Controller\AppController;
use StudentAccount\Model\Entity\Student;

/**
 * Profile Controller
 *
 * @method \StudentAccount\Model\Entity\Student[] paginate($object = null, array $settings = [])
 * @property \ResultSystem\Model\Table\StudentsTable $Students
 * @property \ResultSystem\Model\Table\ClassesTable $Classes
 */
class ProfileController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('StudentAccount.Classes');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $student = new Student($this->Auth->user());
        $classes = $this->Classes->find()
            ->select(['id', 'class'])
            ->combine('id', 'class')
            ->toArray();
        $this->set(compact('student', 'classes'));
    }
}
