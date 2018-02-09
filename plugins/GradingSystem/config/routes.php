<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'GradingSystem',
    ['path' => '/grading-system'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
