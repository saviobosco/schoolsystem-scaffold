<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * ClassLists Controller
 *
 *
 * @method \App\Model\Entity\ClassList[] paginate($object = null, array $settings = [])
 */
class ClassListsController extends AppController
{

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $studentsTable = TableRegistry::get('StudentsManager.Students');
        $classesTable = TableRegistry::get('StudentsManager.Classes');

        $classLists = [];

        if ($this->request->getQuery('class_id')) {
            $this->paginate = [
                'limit' => 50,
                'maxLimit' => 100
            ];
            $studentsQuery = $studentsTable->query()
            ->select(['id', 'first_name', 'last_name', 'class_id'])
                ->where(['class_id' => $this->request->getQuery('class_id')]);
            $classLists = $this->paginate($studentsQuery);
        }

        $classes = $classesTable->find('list');
        $this->set(compact('classLists', 'classes'));
        $this->set('_serialize', ['classLists']);
    }
}
