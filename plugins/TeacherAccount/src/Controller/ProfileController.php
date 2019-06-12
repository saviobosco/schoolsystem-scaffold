<?php
namespace TeacherAccount\Controller;

use TeacherAccount\Controller\AppController;

/**
 * @property \UsersManager\Model\Table\AccountsTable $Accounts
 * Profile Controller
 *
 */
class ProfileController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('UsersManager.Accounts');
    }

    public function edit()
    {
        $user = $this->Accounts->query()->where(['id' => $this->Auth->user('id')])->first();
        $this->set(compact('user'));
    }

    public function update()
    {
        $postData = $this->request->getData();
        $user = $this->Accounts->query()->where(['id' => $this->Auth->user('id')])->first();
        $user = $this->Accounts->patchEntity($user, [
            'first_name' => $postData['first_name'],
            'last_name' => $postData['last_name']
        ]);
        if($this->Accounts->save($user)) {
            $this->Flash->success('Profile was successfully updated.');
            $this->Auth->setUser($user->toArray());
        } else {
            $this->Flash->error('Profile could not be updated.');
        }
        return $this->redirect($this->request->referer());
    }
}
