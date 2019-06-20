<?php
namespace App\Auth;

use Cake\Auth\BaseAuthenticate;
use Cake\Core\Configure;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use CakeDC\Users\Controller\Component\UsersAuthComponent;

class RememberMeAuthenticate extends BaseAuthenticate
{
    /**
     * Authenticate callback
     * Reads the stored cookie and auto login the user
     *
     * @param \Cake\Http\ServerRequest $request Cake request object.
     * @param Response $response Cake response object.
     * @return mixed
     */
    public function authenticate(ServerRequest $request, Response $response)
    {
        if (Configure::check('Users.RememberMe.active') && !Configure::read('Users.RememberMe.active')) {
            return false;
        }

        $cookieName = $this->getConfig('Cookie.name') ?:
            Configure::read('Users.RememberMe.Cookie.name') ?:
                'remember_me';
        if (!$this->_registry->getController()->Cookie) {
            $this->_registry->getController()->loadComponent('Cookie');
        }
        $cookie = $this->_registry->getController()->Cookie->read($cookieName);
        if (empty($cookie)) {
            return false;
        }
        $this->setConfig('fields.username', 'id');
        $user = $this->_findUser($cookie['id']);
        if ($user &&
            !empty($cookie['user_agent']) &&
            $request->getHeaderLine('User-Agent') === $cookie['user_agent']
        ) {
            if ($user['active'] === false) {
                if (!$this->_registry->getController()->Flash) {
                    $this->_registry->getController()->loadComponent('Flash');
                }
                $this->_registry->getController()->Flash->error('Your Account is Unactive.');
                return false;
            }
            $this->_registry->getController()->dispatchEvent(UsersAuthComponent::EVENT_AFTER_LOGIN, ['user' => $user]);
            return $user;
        }

        return false;
    }
}
