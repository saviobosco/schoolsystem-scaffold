<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'StudentsManager',
    ['path' => '/students-manager'],
    function (RouteBuilder $routes) {

        $routes->connect('/view-student/**',
            [
                'controller'=>'Students',
                'action'=>'view'
            ]
        );

        $routes->connect('/edit-student/**',
            [
                'controller'=>'Students',
                'action'=>'edit'
            ]
        );

        $routes->connect('/delete-student/**',
            [
                'controller'=>'Students',
                'action'=>'delete'
            ]
        );

        $routes->connect('/add-student/**',
            [
                'controller'=>'Students',
                'action'=>'add'
            ]
        );

        $routes->fallbacks('DashedRoute');
    }
);
