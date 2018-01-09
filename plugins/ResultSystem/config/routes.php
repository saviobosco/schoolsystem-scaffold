<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'ResultSystem',
    ['path' => '/result-system'],
    function (RouteBuilder $routes) {

        $routes->connect('/',[
            'controller' => 'Students',
            'action' => 'index'
        ]);

        $routes->connect('/view-student-result/**',
            [
                'controller'=>'Students',
                'action'=>'view'
            ]);

        $routes->connect('/add-student-result/**',
            [
                'controller'=>'Students',
                'action'=>'add'
            ]);

        $routes->connect('/edit-student-result/**',
            [
                'controller'=>'Students',
                'action'=>'edit'
            ]);

        $routes->connect('/check-student-result',
            [
                'controller'=>'Students',
                'action'=>'check_result'
            ]);

        $routes->connect('/student-result',
            [
                'controller'=>'Students',
                'action'=>'view_student_result'
            ]);
        $routes->fallbacks('DashedRoute');
    }
);
Router::connect('/student-results-upload',
    ['plugin'=> 'ResultSystem',
        'controller'=>'StudentTermlyResults',
        'action'=>'upload_result'
    ]);