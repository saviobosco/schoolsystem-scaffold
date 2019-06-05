<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'TeacherAccount',
    ['path' => '/teacher-account'],
    function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);

        $routes->get('/dashboard', [
            'controller' => 'Dashboard',
            'action' => 'index'
        ],'teacher:dashboard');

        $routes->get('/profile', [
            'controller' => 'Profile',
            'action' => 'index'
        ],'teacher:profile');

    }
);
