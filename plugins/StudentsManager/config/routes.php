<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;


// routing for the states
Router::connect('/states/add',['plugin'=>'StudentsManager','controller'=>'States','action'=>'add']);
Router::connect('/states/',['plugin'=>'StudentsManager','controller'=>'States','action'=>'index']);
Router::connect('/states/edit/:id',['plugin'=>'StudentsManager','controller'=>'States','action'=>'edit'],['id' => '\d+', 'pass' => ['id']]);
Router::connect('/states/view/:id',['plugin'=>'StudentsManager','controller'=>'States','action'=>'view'],['id' => '\d+', 'pass' => ['id']]);
Router::connect('/states/delete/:id',['plugin'=>'StudentsManager','controller'=>'States','action'=>'delete'],['id' => '\d+', 'pass' => ['id']]);

Router::plugin(
    'StudentsManager',
    ['path' => '/students-manager'],
    function (RouteBuilder $routes) {

        $routes->connect('/',[
            'controller' => 'Students',
            'action' => 'index'
        ]);

        $routes->connect('/add',
            [
                'controller'=>'Students',
                'action'=>'add'
            ],[
                '_name' => 'students:create'
            ]
        );


        $routes->connect('/view/**',
            [
                'controller'=>'Students',
                'action'=>'view'
            ]
        );

        $routes->connect('/edit/**',
            [
                'controller'=>'Students',
                'action'=>'edit'
            ]
        );

        $routes->connect('/delete/**',
            [
                'controller'=>'Students',
                'action'=>'delete'
            ]
        );

        $routes->connect('/activate/**',
            [
                'controller'=>'Students',
                'action'=>'activate'
            ]
        );

        $routes->connect('/deactivate/**',
            [
                'controller'=>'Students',
                'action'=>'deactivate'
            ]
        );

        $routes->connect('/un-active-students',
            [
                'controller'=>'Students',
                'action'=>'unActiveStudents'
            ]
        );

        $routes->connect('/change-class',
            [
                'controller'=>'StudentsClass',
                'action'=>'changeClass'
            ]
        );

        $routes->get('/class-list',
            [
                'controller'=>'ClassLists',
                'action'=>'index'
            ],'class-lists'
        );

        $routes->post('/class-list',
            [
                'controller'=>'ClassLists',
                'action'=>'create',
                '_ext' => 'xlsx'
            ],'class-lists:create'
        );

        $routes->fallbacks('DashedRoute');
    }
);
