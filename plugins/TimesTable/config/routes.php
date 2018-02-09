<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'TimesTable',
    ['path' => '/times-table'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
