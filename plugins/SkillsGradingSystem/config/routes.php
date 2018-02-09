<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'SkillsGradingSystem',
    ['path' => '/skills-grading-system'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
        $routes->connect('/view-student-skill/**',
            [
                'controller'=>'Students',
                'action'=>'view'
            ]);

        /** edit student skills */
        $routes->connect('/add-student-skill/**',
            [
                'controller'=>'Students',
                'action'=>'add'
            ]);

        /** edit student skills */
        $routes->connect('/edit-student-skill/**',
            [
                'controller'=>'Students',
                'action'=>'edit'
            ]);

        /** delete student skills */
        $routes->connect('/delete-student-skill/**',
            [
                'controller'=>'Students',
                'action'=>'delete'
            ]);
    }
);
