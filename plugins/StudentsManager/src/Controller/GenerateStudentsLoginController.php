<?php
namespace StudentsManager\Controller;

use StudentsManager\Controller\AppController;

/**
 * GenerateStudentsLogin Controller
 * @property \StudentAccount\Model\Table\StudentLoginsTable $StudentLogins
 * @property \StudentsManager\Model\Table\StudentsTable $Students
 * @property \StudentsManager\Model\Table\ClassesTable $Classes
 *
 */
class GenerateStudentsLoginController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('StudentsManager.Classes');
        $this->loadModel('StudentsManager.Students');
        $this->loadModel('StudentAccount.StudentLogins');

    }


    public function index()
    {
        $classes = $this->Classes->find('list');
        $this->set(compact('classes'));
        if ($this->request->is(['post'])) {
            $postData = $this->request->getData();
            $students = $this->Students->find()
                ->select(['id', 'first_name', 'last_name', 'class_id'])
                ->where(['class_id' => $postData['class_id']]);
            try {
                if (!empty($students)) {
                    foreach($students as $student) {
                        $studentLoginDetail = $this->StudentLogins->find()
                            ->where(['student_id' => $student->id])
                            ->first();
                        if (!$studentLoginDetail) {
                            $studentLoginDetail = $this->StudentLogins->newEntity([
                                'username' => $student[$postData['username_field']],
                                'password' => $student[$postData['password_field']],
                                'student_id' => $student->id
                            ]);
                            $this->StudentLogins->save($studentLoginDetail);
                        } else {
                            if (isset($postData['overwrite_credentials']) ) {
                                $studentLoginDetail = $this->StudentLogins->patchEntity($studentLoginDetail,[
                                    'username' => $student[$postData['username_field']],
                                    'password' => $student[$postData['password_field']],
                                ]);
                                $this->StudentLogins->save($studentLoginDetail);
                            }
                        }
                    }
                    $this->Flash->success('Students login successfully generated!');
                }

            } catch (\Exception $exception) {
                $this->Flash->error($exception->getMessage());
            }
        }
    }

}
