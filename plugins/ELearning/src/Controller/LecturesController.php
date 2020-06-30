<?php


namespace ELearning\Controller;


use Cake\Datasource\Exception\MissingModelException;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Settings\Core\Setting;
use TeacherAccount\Controller\AppController;

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
        $this->paginate = [
            'contain' => ['Subjects'],
            'order' => [
                'Lectures.sort_order' => 'asc',
            ]
        ];

        $classes = $this->Lectures->Classes->find('list')->toArray();
        $classes = ['' => '--Select Class--'] + $classes;

        $subjects = ['' => '--Select Subjects --'] + $this->Lectures->Subjects->find('list')->toArray();
        $terms = ['' => '--Select Terms --'] + $this->Lectures->Terms->find('list')->toArray();
        $sessions =['' => '--Select Session--'] + $this->Lectures->Sessions->find('list')->toArray();
        $this->set(compact('sessions', 'terms', 'subjects'));

        if (isset($getQuery['class_id']) && !empty($getQuery['class_id'])) {
            $this->paginate['conditions'] = ['class_id' => $getQuery['class_id']];
        }
        if (isset($getQuery['subject_id'])  && !empty($getQuery['subject_id'])) {
            $this->paginate['conditions'] = ['subject_id' => $getQuery['subject_id']];
        }
        if (isset($getQuery['session_id'])  && !empty($getQuery['session_id'])) {
            $this->paginate['conditions'] = ['session_id' => $getQuery['session_id']];
        }
        if (isset($getQuery['term_id'])  && !empty($getQuery['term_id'])) {
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

        $classes = $this->Lectures->Classes->find('list')->toArray();
        $classes = ['' => '--Select Class--'] + $classes;

        $sessions = $this->Lectures->Sessions->find('list');
        $terms = $this->Lectures->Terms->find('list');

        $this->set(compact('sessions', 'terms', 'classes', 'lecture'));
        $this->set('_serialize', ['sessions', 'terms', 'classes', 'lecture']);
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
        $block_id = $this->Lectures->Classes
            ->find()
            ->enableHydration()
            ->select(['block_id'])
            ->extract('block_id')
            ->first();

        $sessions = $this->Lectures->Sessions->find('list');
        $terms = $this->Lectures->Terms->find('list');
        $subjects = $this->Lectures->Subjects->find('list')
            ->where(['block_id' => $block_id]);
        $classes = $this->Lectures->Classes->find('list');

        $this->set(compact('sessions', 'terms', 'subjects', 'classes', 'lecture'));
    }


    public function view($id = null)
    {
        $lecture = $this->Lectures->get($id, [
            'contain' => ['Subjects','Classes','Terms', 'Sessions']
        ]);

        $this->set('lecture', $lecture);
        $this->set('_serialize', ['lecture']);

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


    public function getSubjects()
    {
        $postData = $this->request->getData();

        try {
            $class = $this->Lectures->Classes->get($postData['class_id']);
        } catch (MissingModelException $missingModelException) {
            throw new NotFoundException('Class doesn\'t exist.');
        }

        $subjects = $this->Lectures->Subjects->find('list')->where([
            'block_id' => $class['block_id']
        ])->toArray();

        $this->set(compact('subjects'));
    }

}
