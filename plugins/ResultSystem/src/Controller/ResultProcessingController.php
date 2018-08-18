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
        if ( $this->request->is(['patch', 'post', 'put']) ) {
            $postData = $this->request->getData();
            $this->processResult($postData);
        }
        $sessions = $this->Sessions->find('list');
        $classes = $this->Classes->find('list');
        $terms = $this->Terms->find('list');
        $this->set(compact('sessions','classes','terms'));
    }


    protected function processResult($postData)
    {
        // initialize the ClassCount Class .
        $classCount = new ClassCount();
        if ( isset($postData['term_id'] ) &&  4 === (int)$postData['term_id'] ) {
            $annualResultProcessing = new AnnualResultProcessing();
            if ($annualResultProcessing->isBusy()) {
                $this->Flash->error('The Result Processing server is busy now. Try again later.');
                return;
            }
            $annualResultProcessing->startProcessing();
            $returnData = $annualResultProcessing->calculateAnnualTotals($postData['class_id'], $postData['session_id']);
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
            }
            $annualResultProcessing->calculateAnnualPosition($postData['class_id'], $postData['session_id']);
            $annualResultProcessing->calculateStudentAnnualSubjectPosition($postData['class_id'], $postData['session_id']);
            $annualResultProcessing->stopProcessing();
            $classCount->getStudentNumberInClasses($postData['class_id'],$postData['session_id'],$postData['term_id']);
            $this->Flash->success('Successfully Calculated the students annual results');
            return;
        }
        // process the result with the supplied parameters
        $termlyResultProcessing  = new TermlyResultProcessing();
        if ($termlyResultProcessing->isBusy()) {
            $this->Flash->error('The Result Processing server is busy now. Try again later.');
            return;
        }
        $termlyResultProcessing->startProcessing();

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
                return;
            }
        if ($returnData === null) {
            $this->Flash->success('Successfully Calculated the students termly results ');
        }
        // check is the cal_student_position is checked and calculate student positions
        if (isset($postData['cal_student_position']) && !empty($postData['cal_student_position'])) {
            if ($termlyResultProcessing->calculateTermlyPosition($postData['class_id'],$postData['term_id'],$postData['session_id'])){
                $this->Flash->success(__('Successfully calculated the students positions'));
            }
        }

        if (isset($postData['cal_subject_position']) && !empty($postData['cal_subject_position'])) {
            if($termlyResultProcessing->calculateStudentTermlySubjectPosition($postData['class_id'],$postData['term_id'],$postData['session_id'])) {
                $this->Flash->success(__('Successfully calculated the students subject positions'));
            }
        }

        if (isset($postData['cal_class_average']) && !empty($postData['cal_class_average'])) {
            if($termlyResultProcessing->calculateSubjectClassAverage($postData['class_id'],$postData['term_id'],$postData['session_id'])) {
                $this->Flash->success(__('Successfully calculated the students positions'));
            }
        }
        $termlyResultProcessing->stopProcessing();

        if (isset($postData['cal_class_count']) && !empty($postData['cal_class_count'])) {
            $classCount->getStudentNumberInClasses($postData['class_id'],$postData['session_id'],$postData['term_id']);
            $this->Flash->success('Successfully counted the students in the class');
        }
    }
}