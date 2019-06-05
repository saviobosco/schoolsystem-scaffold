<?php

use Cake\Event\EventManager;
EventManager::instance()->on(new \UsersManager\Event\UserManagerEventListener());