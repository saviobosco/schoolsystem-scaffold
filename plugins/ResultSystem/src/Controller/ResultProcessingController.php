<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/21/16
 * Time: 4:15 AM
 */

namespace ResultSystem\Controller;

use Cake\Collection\Collection;
use Cake\Utility\Text;
use ResultSystem\Controller\AppController;
use ResultSystem\ResultProcessing\AnnualResultProcessing;
use ResultSystem\ResultProcessing\TermlyResultProcessing;
use ResultSystem\ResultProcessing\ClassCount;
use ResultSystem\Model\Entity\GradeableTrait;

/**
 * Students Controller
 *
 * @property \ResultSystem\Model\Table\SessionsTable $Sessions
 * @property \ResultSystem\Model\Table\ClassesTable $Classes
 * @property \ResultSystem\Model\Table\TermsTable $Terms
 */
class ResultProcessingController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('ResultSystem.Sessions');
        $this->loadModel('ResultSystem.Classes');
        $this->loadModel('ResultSystem.Terms');
    }

    public function index()
    {
        $sessions = $this->Sessions->find('list');
        $classes = $this->Classes->find('list');
        $terms = $this->Terms->find('list')->limit(3);
        $this->set(compact('sessions','classes','terms'));
    }

    public function processTermlyResult()
    {
        $postData = $this->request->getData();
        // process the result with the supplied parameters
        $termlyResultProcessing  = new TermlyResultProcessing();
        if ($termlyResultProcessing->isBusy()) {
            $this->Flash->error('The Result Processing server is busy now. Try again later.');
            return;
        }
        $termlyResultProcessing->startProcessing();

        if (isset($postData['cal_student_total']) && !empty($postData['cal_student_total'])) {
            $returnData = $termlyResultProcessing->calculateTermlyTotalAndAverage($postData['class_id'],$postData['term_id'],$postData['session_id'],$postData['no_of_subjects']);
            if (is_array($returnData)) {
                if ( !empty($returnData['subjectCountIssues'])) {
                    $list = '<ol>';
                    for( $i = 0; $i < count($returnData['subjectCountIssues']); $i++) {
                        $list .= '<li>'. $returnData['subjectCountIssues'][$i] .'</li>';
                    }
                    $list .= '</ol>';
                    $this->Flash->set('<p><i class="fa fa-warning"></i><b> The following issues occurred while processing your request :</b></p>'.
                        $list.'<p> Please review them and try again</p>',[
                        'element'=>'unescaped_error',
                        'escape'=>false]);
                }
                if (!empty($returnData['error'])) {
                    $this->Flash->error($returnData['error']);
                }
                $termlyResultProcessing->stopProcessing();
                return $this->redirect($this->referer());
            }
            if ($returnData === null) {
                $this->Flash->success('Successfully Calculated the students termly results ');
            }
        }

        // check is the cal_student_position is checked and calculate student positions
        if (isset($postData['cal_student_position']) && !empty($postData['cal_student_position'])) {
            if ($termlyResultProcessing->calculateTermlyPosition($postData['class_id'],$postData['term_id'],$postData['session_id'])){
                $this->Flash->success(__('Successfully calculated the students positions'));
            } else {
                $this->Flash->error(__('Seems you have not calculated the students total. Please calculate the students total and try again.'));
                $termlyResultProcessing->stopProcessing();
                return $this->redirect($this->referer());
            }
        }

        if (isset($postData['cal_subject_position']) && !empty($postData['cal_subject_position'])) {
            if($termlyResultProcessing->calculateStudentTermlySubjectPosition($postData['class_id'],$postData['term_id'],$postData['session_id'])) {
                $this->Flash->success(__('Successfully calculated the students subject positions'));
            }
        }

        if (isset($postData['cal_class_average']) && !empty($postData['cal_class_average'])) {
            if($termlyResultProcessing->calculateSubjectClassAverage($postData['class_id'],$postData['term_id'],$postData['session_id'])) {
                $this->Flash->success(__('Successfully calculated the class averages'));
            }
        }
        $termlyResultProcessing->stopProcessing();

        if (isset($postData['cal_class_count']) && !empty($postData['cal_class_count'])) {
            $classCount = new ClassCount();
            $classCount->getStudentNumberInClasses($postData['class_id'],$postData['session_id'],$postData['term_id']);
            $this->Flash->success('Successfully counted the students in the class');
        }
        return $this->redirect($this->referer());
    }

    public function processAnnualResult()
    {
        $postData = $this->request->getData();
        $annualResultProcessing = new AnnualResultProcessing();
        if ($annualResultProcessing->isBusy()) {
            $this->Flash->error('The Result Processing server is busy now. Try again later.');
            return $this->redirect($this->referer());
        }
        $annualResultProcessing->startProcessing();

        if (isset($postData['cal_student_total']) && !empty($postData['cal_student_total'])) {
            $returnData = $annualResultProcessing->calculateAnnualTotals($postData['class_id'], $postData['session_id'], $postData['term_id']);
            if (is_array($returnData)) {
                if ( !empty($returnData['subjectCountIssues'])) {
                    $list = '<ol>';
                    for( $i = 0; $i < count($returnData['subjectCountIssues']); $i++) {
                        $list .= '<li>'. $returnData['subjectCountIssues'][$i] .'</li>';
                    }
                    $list .= '</ol>';
                    $this->Flash->set('<p><i class="fa fa-warning"></i><b> The following issues occurred while processing your request :</b></p>'.
                        $list.'<p> Please review them and try again</p>',[
                        'element'=>'unescaped_error',
                        'escape'=>false]);
                }
            } else {
                $this->Flash->success('Successfully Calculated the students annual results');
            }
        }
        if (isset($postData['cal_student_position']) && !empty($postData['cal_student_position'])) {
            if ($annualResultProcessing->calculateAnnualPosition($postData['class_id'], $postData['session_id'], $postData['term_id'])){
                $this->Flash->success(__('Successfully calculated the students positions'));
            } else {
                $this->Flash->error(__('Seems you have not calculated the students total. Please calculate the students total and try again.'));
                $annualResultProcessing->stopProcessing();
                return $this->redirect($this->referer());
            }
        }
        if (isset($postData['cal_subject_position']) && !empty($postData['cal_subject_position'])) {
            if($annualResultProcessing->calculateStudentAnnualSubjectPosition($postData['class_id'], $postData['session_id'], $postData['term_id'])) {
                $this->Flash->success(__('Successfully calculated the students subject positions'));
            }
        }
        $annualResultProcessing->stopProcessing();

        if (isset($postData['cal_class_count']) && !empty($postData['cal_class_count'])) {
            $classCount = new ClassCount();
            $classCount->getStudentNumberInClasses($postData['class_id'],$postData['session_id'],$postData['term_id']);
            $this->Flash->success('Successfully counted the students in the class');
        }
        return $this->redirect($this->referer());
    }
}