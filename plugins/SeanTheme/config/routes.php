<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'SeanTheme',
    ['path' => '/sean-theme'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
