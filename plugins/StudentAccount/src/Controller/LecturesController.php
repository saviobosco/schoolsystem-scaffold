<?php


namespace StudentAccount\Controller;


use Cake\Datasource\Exception\RecordNotFoundException;
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
    }

    public function index()
    {

        // get all subjects lectures arranged by the subjects
        // and in the right order
        // get the current class
        // get the current term
        // get the current session.
        $current_term_id = Setting::read('Application.current_term');
        $current_session_id = Setting::read('Application.current_session');
        $current_class_id = $this->Auth->user()['student']['class_id'];
        try {
            $current_term = $this->Lectures->Terms->get($current_term_id)->name;
            $current_session = $this->Lectures->Sessions->get($current_session_id)->session;
            $current_class = $this->Lectures->Classes->get($current_class_id)->class;

            $this->set(compact('current_term', 'current_session', 'current_class'));
        } catch (RecordNotFoundException $recordNotFoundException) {
            // sub due the error message
        }

        $lectures = $this->Lectures->find('all')
            ->select(['subject_id'])
            ->where([
                'session_id' => $current_session_id,
                'class_id' => $current_class_id,
                'term_id' => $current_term_id
            ]);

        $subjectIds = $lectures->extract('subject_id')->toArray();
        //dd($subjectIds);
        if (!empty($subjectIds)) {
            $subjects = $this->Lectures->Subjects
                ->find('all')
                ->where(['id IN' => $subjectIds])->toArray();

            $this->set(compact('subjects'));
        }
    }

    public function getLectureNotes()
    {
        $getQuery = $this->request->getQuery();
        try {
            $subject = $this->Lectures->Subjects->get($getQuery['subject_id']);
        } catch (RecordNotFoundException $recordNotFoundException) {
            // sub due the error messages
        }

        $current_term_id = Setting::read('Application.current_term');
        $current_session_id = Setting::read('Application.current_session');
        $current_class_id = $this->Auth->user()['student']['class_id'];

        try {
            $current_term = $this->Lectures->Terms->get($current_term_id)->name;
            $current_session = $this->Lectures->Sessions->get($current_session_id)->session;
            $current_class = $this->Lectures->Classes->get($current_class_id)->class;

            $this->set(compact('current_term', 'current_session', 'current_class'));
        } catch (RecordNotFoundException $recordNotFoundException) {
            // sub due the error message
        }

        $lectures = $this->Lectures->find('all')
            ->where([
                'subject_id' => $getQuery['subject_id'],
                'session_id' => $current_session_id,
                'class_id' => $current_class_id,
                'term_id' => $current_term_id
            ])
            ->orderAsc('created_at');

        $this->set(compact('lectures', 'subject'));
    }


    public function view($id = null)
    {
        $lecture = $this->Lectures->get($id, [
            'contain' => ['Subjects','Classes','Terms', 'Sessions']
        ]);

        $this->set('lecture', $lecture);
        $this->set('_serialize', ['lecture']);
    }

}
