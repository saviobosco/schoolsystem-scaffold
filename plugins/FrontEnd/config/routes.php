<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'FrontEnd',
    ['path' => '/front-end'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
