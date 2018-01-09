<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'Saviobosco/Excel',
    ['path' => '/saviobosco/excel'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
