<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::connect('/classes',['plugin'=>'ClassManager','controller'=>'Classes','action'=>'index']);
Router::connect('/classes/add',['plugin'=>'ClassManager','controller'=>'Classes','action'=>'add']);
Router::connect('/classes/edit/:id',['plugin'=>'ClassManager','controller'=>'Classes','action'=>'edit'],['id' => '\d+', 'pass' => ['id']]);
Router::connect('/classes/view/:id',['plugin'=>'ClassManager','controller'=>'Classes','action'=>'view'],['id' => '\d+', 'pass' => ['id']]);
Router::connect('/classes/delete/:id',['plugin'=>'ClassManager','controller'=>'Classes','action'=>'delete'],['id' => '\d+', 'pass' => ['id']]);

// Routes for class demarcation
Router::connect('/class-demarcations',['plugin'=>'ClassManager','controller'=>'ClassDemarcations','action'=>'index']);
Router::connect('/class-demarcations/add',['plugin'=>'ClassManager','controller'=>'ClassDemarcations','action'=>'add']);
Router::connect('/class-demarcations/edit/:id',['plugin'=>'ClassManager','controller'=>'ClassDemarcations','action'=>'edit'],['id' => '\d+', 'pass' => ['id']]);
Router::connect('/class-demarcations/delete/:id',['plugin'=>'ClassManager','controller'=>'ClassDemarcations','action'=>'delete'],['id' => '\d+', 'pass' => ['id']]);

Router::plugin(
    'ClassManager',
    ['path' => '/class-manager'],
    function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
    }
);
