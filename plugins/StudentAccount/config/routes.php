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
        ],['_name' => 'student:dashboard']);

        $routes->get('/profile', [
            'controller' => 'Profile',
            'action' => 'index'
        ],['_name' => 'student:profile']);

        $routes->get('/my_results', [
            'controller' => 'StudentResults',
            'action' => 'index'
        ],['_name' => 'student:my_results']);

        $routes->get('/my_pins', [
            'controller' => 'ResultPins',
            'action' => 'index'
        ],['_name' => 'student:my_pins']);
    }
);
