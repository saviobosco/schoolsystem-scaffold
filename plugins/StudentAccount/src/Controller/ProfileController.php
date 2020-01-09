<?php
namespace StudentAccount\Controller;

use Cake\Core\Plugin;
use Cake\ORM\TableRegistry;
use StudentAccount\Controller\AppController;
use StudentAccount\Model\Entity\Student;

/**
 * Profile Controller
 *
 * @method \StudentAccount\Model\Entity\Student[] paginate($object = null, array $settings = [])
 * @property \StudentsManager\Model\Table\StudentsTable $Students
 * @property \ResultSystem\Model\Table\ClassesTable $Classes
 * @property \App\Model\Table\MedicalIssuesTable $MedicalIssues
 *
 */
class ProfileController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('App.MedicalIssues');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        try {
            $studentsTable = TableRegistry::get('StudentsManager.Students');
            $student = $studentsTable->get($this->Auth->user('student_id'),
                [
                    'contain' => [
                        'Classes', 'States','Religions', 'StudentTypes',
                        'Nationalities'
                    ]
                ]);
            $medicalIssues = $this->MedicalIssues->find('list');
        } catch (\Exception $exception) {
            $this->Flash->error('An error occurred fetching your profile');
            $this->Flash->error($exception->getMessage());
        }
        $this->set(compact('student', 'medicalIssues'));
    }
}
