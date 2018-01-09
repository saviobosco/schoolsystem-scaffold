<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'SubjectsManager',
    ['path' => '/subjects-manager'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
