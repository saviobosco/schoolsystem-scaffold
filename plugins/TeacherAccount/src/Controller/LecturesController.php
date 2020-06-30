<?php


namespace TeacherAccount\Controller;

use Cake\Datasource\EntityInterface;
use Cake\Datasource\Exception\MissingModelException;
use Cake\ORM\TableRegistry;
use Settings\Core\Setting;

/**
 * States Controller
 *
 * @property \ELearning\Model\Table\LecturesTable $Lectures
 *
 * @method \ELearning\Model\Entity\Lecture[] paginate($object = null, array $settings = [])
 */
class LecturesController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('ELearning.Lectures');
        $this->loadModel('ResultSystem.Sessions');
        $this->loadModel('ResultSystem.Classes');
        $this->loadModel('ResultSystem.Terms');
        $this->loadModel('ResultSystem.Subjects');
    }

    public function index()
    {
        $getQuery = $this->request->getQuery();
        if (isset($getQuery['lecture'])) {
            $getQuery = $getQuery['lecture'];
        }

        $permissionClasses = TableRegistry::get('UsersManager.TeachersSubjectsClassesPermissions')->query()
            ->enableHydration(false)
            ->select(['class_id'])
            ->where([
                'teacher_id' => $this->Auth->user('id'),
            ])
            ->extract('class_id')
            ->toArray();



        $classes = $this->Lectures->Classes->find('list')->where(['id IN' => $permissionClasses])->toArray();
        $classes = ['' => '--Select Class--'] + $classes;
        $this->paginate = [
            'contain' => ['Subjects'],
        ];

        if (isset($getQuery['class_id']) && !empty($getQuery['class_id'])) {
            $permissions = TableRegistry::get('UsersManager.TeachersSubjectsClassesPermissions')->query()
                ->enableHydration(false)
                ->contain(['Classes'])
                ->where([
                    'teacher_id' => $this->Auth->user('id'),
                    'class_id' => $getQuery['class_id']
                ])
                ->first();

            if (isset($permissions['subjects'])) {
                if (in_array(0, $permissions['subjects'])) {
                    $subjects = TableRegistry::get('SubjectsManager.Subjects')->find('list')
                        ->where(['block_id' => $permissions['class']['block_id']]);
                } else {
                    $subjects = TableRegistry::get('SubjectsManager.Subjects')->find('list')
                        ->where([
                            'id IN' => $permissions['subjects'],
                            'block_id' => $permissions['class']['block_id']
                        ]);
                }
            }

            if (isset($permissions['terms'])) {
                if (in_array(0, $permissions['terms'])) {
                    $currentTermId = Setting::read('Application.current_term');
                    $terms = TableRegistry::get('Terms')->find('list')->where(['id' => $currentTermId]);
                } else {
                    $terms = TableRegistry::get('Terms')->find('list')->where(['id IN' => $permissions['terms']])->limit(3);
                }
            }
            if (isset($permissions['sessions'])) {
                if (in_array(0, $permissions['sessions'])) {
                    $currentSessionId = Setting::read('Application.current_session');
                    $sessions = TableRegistry::get('Sessions')->find('list')->where(['id' => $currentSessionId]);
                } else {
                    $sessions = TableRegistry::get('Sessions')->find('list')->where(['id IN' => $permissions['sessions']]);
                }
            }
            $this->set(compact('sessions', 'terms', 'subjects'));
        }


        if (isset($getQuery['class_id'])) {
            $this->paginate['conditions'] = ['class_id' => $getQuery['class_id']];
        }
        if (isset($getQuery['subject_id'])) {
            $this->paginate['conditions'] = ['subject_id' => $getQuery['subject_id']];
        }
        if (isset($getQuery['session_id'])) {
            $this->paginate['conditions'] = ['session_id' => $getQuery['session_id']];
        }
        if (isset($getQuery['term_id'])) {
            $this->paginate['conditions'] = ['term_id' => $getQuery['term_id']];
        }

        $lectures = $this->paginate($this->Lectures);
        $this->set(compact('lectures', 'classes'));
        $this->set('_serialize', ['lectures', 'sessions', 'terms', 'subjects', 'classes']);
    }


    public function add()
    {
        $lecture = $this->Lectures->newEntity();

        if ($this->request->is(['post', 'put',])) {
            $lecture = $this->Lectures->patchEntity($lecture, $this->request->getData());
            $lecture->created_by = $this->Auth->user('username');

            if ($this->Lectures->save($lecture)) {
                $this->Flash->success(__('The lecture note has been successfully created.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('The lecture note could not be created.'));
        }

        $permissionClasses = TableRegistry::get('UsersManager.TeachersSubjectsClassesPermissions')->query()
            ->enableHydration(false)
            ->select(['class_id'])
            ->where([
                'teacher_id' => $this->Auth->user('id'),
            ])
            ->extract('class_id')
            ->toArray();



        $classes = $this->Lectures->Classes->find('list')->where(['id IN' => $permissionClasses])->toArray();
        $classes = ['' => '--Select Class--'] + $classes;

        $sessions = $this->Lectures->Sessions->find('list');
        $terms = $this->Lectures->Terms->find('list');
        $subjects = $this->Lectures->Subjects->find('list');

        $this->set(compact('sessions', 'terms', 'subjects', 'classes', 'lecture'));
        $this->set('_serialize', ['sessions', 'terms', 'subjects', 'classes', 'lecture']);
    }


    public function edit($id = null)
    {
        $lecture = null;
        try {
            $lecture = $this->Lectures->get($id);
        } catch (MissingModelException $missingModelException) {
            $this->Flash->error('No record found');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['put', 'post', 'options'])) {
           $lecture = $this->Lectures->patchEntity($lecture, $this->request->getData());
           if ($this->Lectures->save($lecture)) {
               $this->Flash->success('Lecture was successfully updated');
           } else {
               $this->Flash->error('Lecture note could not be updated.');
           }
        }

        $sessions = $this->Lectures->Sessions->find('list');
        $terms = $this->Lectures->Terms->find('list');
        $subjects = $this->Lectures->Subjects->find('list');
        $classes = $this->Lectures->Classes->find('list');

        $this->set(compact('sessions', 'terms', 'subjects', 'classes', 'lecture'));
    }


    public function view()
    {

    }


    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lecture = $this->Lectures->get($id);
        if ($this->Lectures->delete($lecture)) {
            $this->Flash->success(__('The Lecture has been deleted.'));
        } else {
            $this->Flash->error(__('The Lecture could not be deleted. Please, try again.'));
        }
        return $this->redirect($this->referer());
    }


    public function insertParameters()
    {
        $postData = $this->request->getData();

        if (isset($postData['class_id']) && !empty($postData['class_id'])) {

            $permissions = TableRegistry::get('UsersManager.TeachersSubjectsClassesPermissions')->query()
                ->enableHydration(false)
                ->contain(['Classes'])
                ->where([
                    'teacher_id' => $this->Auth->user('id'),
                    'class_id' => $postData['class_id']
                ])
                ->first();

            if (isset($permissions['subjects'])) {
                if (in_array(0, $permissions['subjects'])) {
                    $subjects = TableRegistry::get('SubjectsManager.Subjects')->find('list')
                        ->where(['block_id' => $permissions['class']['block_id']]);
                } else {
                    $subjects = TableRegistry::get('SubjectsManager.Subjects')->find('list')
                        ->where([
                            'id IN' => $permissions['subjects'],
                            'block_id' => $permissions['class']['block_id']
                        ]);
                }
            }

            if (isset($permissions['terms'])) {
                if (in_array(0, $permissions['terms'])) {
                    $currentTermId = Setting::read('Application.current_term');
                    $terms = TableRegistry::get('Terms')->find('list')->where(['id' => $currentTermId]);
                } else {
                    $terms = TableRegistry::get('Terms')->find('list')->where(['id IN' => $permissions['terms']])->limit(3);
                }
            }
            if (isset($permissions['sessions'])) {
                if (in_array(0, $permissions['sessions'])) {
                    $currentSessionId = Setting::read('Application.current_session');
                    $sessions = TableRegistry::get('Sessions')->find('list')->where(['id' => $currentSessionId]);
                } else {
                    $sessions = TableRegistry::get('Sessions')->find('list')->where(['id IN' => $permissions['sessions']]);
                }
            }
            $this->set(compact('sessions', 'terms', 'subjects'));
        }
    }


}
