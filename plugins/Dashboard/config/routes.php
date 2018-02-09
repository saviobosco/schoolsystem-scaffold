<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'Dashboard',
    ['path' => '/dashboard'],
    function (RouteBuilder $routes) {
        $routes->connect('/',[
            'controller' => 'Dashboard',
            'action' => 'index'
        ]);
        $routes->connect('/dashboard',[
            'controller' => 'Dashboard',
            'action' => 'index'
        ]);

        $routes->fallbacks(DashedRoute::class);
    }
);