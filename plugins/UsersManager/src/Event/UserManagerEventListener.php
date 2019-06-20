<?php
namespace UsersManager\Event;

use Cake\Event\EventListenerInterface;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use CakeDC\Users\Controller\Component\UsersAuthComponent;

class UserManagerEventListener implements EventListenerInterface
{
    public function implementedEvents()
    {
        return [
            UsersAuthComponent::EVENT_AFTER_LOGIN => 'redirectUserAfterLogin',
        ];
    }

    public function redirectUserAfterLogin($event, $user)
    {
        if ($event->isStopped() === false){
            // Log the user login event.
            $this->logLoginToDatabase($event, $user);
            switch($user['role']) {
                case 'student':
                    return ['plugin' => 'StudentAccount', 'controller' => 'Dashboard', 'action' => 'index'];
                    break;
                case 'teacher':
                    return ['plugin' => 'TeacherAccount', 'controller' => 'Dashboard', 'action' => 'index'];
                    break;
                case 'parent':
                    return ['plugin' => 'ParentAccount', 'controller' => 'Dashboard', 'action' => 'index'];
                    break;
                default:
                    return null;
            }
        }
        return null;
    }

    public function logLoginToDatabase($event, $user)
    {
        TableRegistry::get('UsersManager.Logins', ['table' => 'logins'])
            ->save(new Entity([
                'user_id' => $user['id'],
                'ip_address' => $event->getSubject()->request->clientIp()
            ]));
    }
}