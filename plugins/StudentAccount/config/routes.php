<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'StudentAccount',
    ['path' => '/student-account'],
    function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);

        $routes->get('/dashboard', [
            'controller' => 'Dashboard',
            'action' => 'index'
        ]);

        $routes->get('/login',
            [
                'plugin' => 'StudentAccount',
                'controller'=>'Login',
                'action'=>'index'
            ]
        );

        $routes->post('/login',
            [
                'plugin' => 'StudentAccount',
                'controller'=>'Login',
                'action'=>'login'
            ]
        );
    }
);
