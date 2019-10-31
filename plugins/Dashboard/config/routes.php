<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'Dashboard',
    ['path' => '/dashboard'],
    function (RouteBuilder $routes) {
        $routes->connect('/',[
            'controller' => 'Dashboard',
            'action' => 'index'
        ]);
        $routes->connect('/dashboard',[
            'controller' => 'Dashboard',
            'action' => 'index'
        ]);

        $routes->get('/medical_issues',[
            'controller' => 'MedicalIssues',
            'action' => 'index'
        ], 'medical_issues:index');

        $routes->post('/medical_issues',[
            'controller' => 'MedicalIssues',
            'action' => 'store'
        ], 'medical_issues:store');

        $routes->get('/religions',[
            'controller' => 'Religions',
            'action' => 'index'
        ], 'religions:index');

        $routes->get('/nationalities',[
            'controller' => 'Nationalities',
            'action' => 'index'
        ], 'nationalities:index');

        $routes->post('/nationalities',[
            'controller' => 'Nationalities',
            'action' => 'store'
        ], 'nationalities:store');

        $routes->get('/student_types',[
            'controller' => 'StudentTypes',
            'action' => 'index'
        ], 'student_types:index');

        $routes->post('/student_types',[
            'controller' => 'StudentTypes',
            'action' => 'store'
        ], 'student_types:store');

        $routes->fallbacks(DashedRoute::class);
    }
);