<?php
namespace StudentAccount\Controller;

use StudentAccount\Controller\AppController;
use Cake\Validation\Validator;
use CakeDC\Users\Exception\UserNotFoundException;
use CakeDC\Users\Exception\WrongPasswordException;
use Exception;
/**
 * ChangePassword Controller
 * @property \StudentAccount\Model\Table\StudentLoginsTable $StudentLogins
 */
class ChangePasswordController extends AppController
{
    public function index()
    {
        $this->loadModel('StudentAccount.StudentLogins');
        $user = $this->StudentLogins->get($this->Auth->user('id'));
        if ($this->request->is(['post', 'put','patch'])) {
            try {
                $validator = $this->StudentLogins->validationPasswordConfirm(new Validator());
                $validator = $this->StudentLogins->validationCurrentPassword($validator);
                $user = $this->StudentLogins->patchEntity(
                    $user,
                    $this->request->getData(),
                    ['validate' => $validator]
                );
                if ($user->getErrors()) {
                    $this->Flash->error(__('Password could not be changed'));
                } else {
                    $user = $this->StudentLogins->changePassword($user);
                    if ($user) {
                        $this->Flash->success(__d('CakeDC/Users', 'Password has been changed successfully'));

                        //return $this->redirect($redirect);
                    } else {
                        $this->Flash->error(__d('CakeDC/Users', 'Password could not be changed'));
                    }
                }
            } catch (UserNotFoundException $exception) {
                $this->Flash->error(__d('CakeDC/Users', 'User was not found'));
            } catch (WrongPasswordException $wpe) {
                $this->Flash->error(__d('CakeDC/Users', '{0}', $wpe->getMessage()));
            } catch (Exception $exception) {
                $this->Flash->error(__d('CakeDC/Users', 'Password could not be changed'));
                $this->log($exception->getMessage());
            }
        }
        $this->set(compact('user'));
    }


}
