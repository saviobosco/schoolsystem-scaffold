<?php
namespace UsersManager\Event;

use Cake\Event\EventListenerInterface;
use CakeDC\Users\Controller\Component\UsersAuthComponent;

class UserManagerEventListener implements EventListenerInterface
{
    public function implementedEvents()
    {
        return [
            UsersAuthComponent::EVENT_AFTER_LOGIN => 'redirectUserAfterLogin'
        ];
    }

    public function redirectUserAfterLogin($event, $user)
    {
        if ($event->isStopped() === false){
            switch($user['role']) {
                case 'student':
                    return ['plugin' => 'StudentAccount', 'controller' => 'Dashboard', 'action' => 'index'];
                    break;
                case 'teacher':
                    return ['plugin' => 'TeacherAccount', 'controller' => 'Dashboard', 'action' => 'index'];
                    break;
                case 'parent':
                    return ['plugin' => 'StudentAccount', 'controller' => 'Dashboard', 'action' => 'index'];
                    break;
                default:
                    return null;
            }
        }
        return null;
    }
}