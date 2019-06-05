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
        ],'student:dashboard');

        $routes->get('/profile', [
            'controller' => 'Profile',
            'action' => 'index'
        ],'student:profile');

        $routes->get('/my_results', [
            'controller' => 'StudentResults',
            'action' => 'index'
        ],'student:my_results');

        $routes->get('/my_pins', [
            'controller' => 'ResultPins',
            'action' => 'index'
        ],'student:my_pins');
    }
);
