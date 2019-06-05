<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'ParentAccount',
    ['path' => '/parent-account'],
    function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);

        $routes->get('/dashboard', [
            'controller' => 'Dashboard',
            'action' => 'index'
        ],'parent:dashboard');

        $routes->get('/profile', [
            'controller' => 'Profile',
            'action' => 'index'
        ],'parent:profile');

        $routes->get('/my_wards', [
            'controller' => 'MyWards',
            'action' => 'index'
        ],'parent:my_wards');

    }
);
