<?php
namespace StudentsManager\Controller;

use StudentsManager\Controller\AppController;

/**
 * StudentLoginDetails Controller
 * @property \StudentAccount\Model\Table\StudentLoginsTable $StudentLogins
 */
class StudentLoginDetailsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('StudentAccount.StudentLogins');
    }


    public function index($id = null)
    {
        // get the student login details
        $studentLoginDetail = $this->StudentLogins->query()
            ->where(['student_id' => $id])
            ->first();
        if (!$studentLoginDetail) {
            $studentLoginDetail = $this->StudentLogins->newEntity();
        }
        $this->set(compact('studentLoginDetail', 'id'));
    }

    public function update($id = null)
    {
        $studentLoginDetail = $this->StudentLogins->query()
            ->where(['student_id' => $id])
            ->first();
        if (!$studentLoginDetail) {
            $studentLoginDetail = $this->StudentLogins->newEntity(['student_id' => $id]);
        }
        $studentLoginDetail = $this->StudentLogins->patchEntity($studentLoginDetail, $this->request->getData());
        if ($this->StudentLogins->save($studentLoginDetail)) {

            $responseMessage = '<div class="alert alert-success"> Student login details was successfully updated </div>';
        } else {
            $responseMessage = '<div class="alert alert-danger"> Student login details could not be updated.Please try again.</div>';
        }
        return $this->response->withStringBody($responseMessage);
    }

    public function accountStatus($id = null)
    {
        $studentLoginDetail = $this->StudentLogins->query()
            ->where(['student_id' => $id])
            ->first();
        if (!$studentLoginDetail) {
            $responseMessage = '<div class="alert alert-danger"> Invalid Action</div>';
        } else {
            $studentLoginDetail = $this->StudentLogins->patchEntity($studentLoginDetail, $this->request->getData());
            if ($this->StudentLogins->save($studentLoginDetail)) {

                $responseMessage = '<div class="alert alert-success"> Student login status was successfully updated </div>';
            } else {
                $responseMessage = '<div class="alert alert-danger"> Student login status could not be updated.Please try again.</div>';
            }
        }

        return $this->response->withStringBody($responseMessage);
    }
}
