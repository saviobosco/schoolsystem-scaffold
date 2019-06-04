<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 11/4/18
 * Time: 10:27 AM
 */

namespace ResultSystem\Controller;

/**
 * Class StudentClassCountsController
 * @package ResultSystem\Controller
 * @property \ResultSystem\Model\Table\TermsTable $Terms
 * @property \ResultSystem\Model\Table\SessionsTable $Sessions
 * @property \ResultSystem\Model\Table\ClassesTable $Classes
 * @property \ResultSystem\Model\Table\StudentClassCountsTable $StudentClassCounts
 */
class StudentClassCountsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('ResultSystem.Terms');
        $this->loadModel('ResultSystem.Sessions');
        $this->loadModel('ResultSystem.Classes');
    }
    public function index()
    {
        $queryData = $this->request->getQuery();
        $sessions = $this->Sessions->find('list')->toArray();
        $classes = $this->Classes->find('list')->toArray();
        $terms = $this->Terms->find('list')->toArray();
        $this->set(compact('sessions', 'terms', 'classes'));
        if (! empty($queryData)) {
            $studentClassCount = $this->StudentClassCounts->getStudentsClassCount($queryData['session_id'], $queryData['class_id'], $queryData['term_id']);
            if (is_null($studentClassCount)) {
                $studentClassCount = $this->StudentClassCounts->newEntity();
            }
            $this->set(compact('studentClassCount'));
        }
    }

    public function update()
    {
        $queryData = $this->request->getQuery();
        if(empty($queryData)) {
            return;
        }
        $studentClassCount = $this->StudentClassCounts->getStudentsClassCount($queryData['session_id'], $queryData['class_id'], $queryData['term_id']);
        if (is_null($studentClassCount)) {
            $studentClassCount = $this->StudentClassCounts->newEntity($this->request->getData());
        } else {
            $studentClassCount = $this->StudentClassCounts->patchEntity($studentClassCount, $this->request->getData());
        }
        $this->StudentClassCounts->save($studentClassCount);
        $this->Flash->success('Students Count was successfully saved!');
        return $this->redirect($this->request->referer());
    }
}