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
    }
);
