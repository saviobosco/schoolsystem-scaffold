<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::connect('/', ['plugin'=>'UsersManager','controller' => 'Accounts', 'action' => 'desktop']);

Router::plugin(
    'UsersManager',
    ['path' => '/users-manager'],
    function (RouteBuilder $routes) {

        $routes->fallbacks(DashedRoute::class);

        $routes->post('/teachers/:id/assign_subjects', [
            'controller' => 'TeacherSubject',
            'action' => 'update'
        ], 'users:teacher:assign_subjects:post')
            ->setPass(['id']);

        $routes->post('/teachers/:id/assign_classes', [
            'controller' => 'TeacherClass',
            'action' => 'update'
        ], 'users:teacher:assign_classes:post')
            ->setPass(['id']);

        $routes->post('/teachers/:id/assign_permissions', [
            'controller' => 'TeacherPermissions',
            'action' => 'update'
        ], 'users:teacher:assign_permissions:post')
            ->setPass(['id']);
    }
);
