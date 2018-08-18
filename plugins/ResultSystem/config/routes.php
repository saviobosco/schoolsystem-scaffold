<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'ResultSystem',
    ['path' => '/result-system'],
    function (RouteBuilder $routes) {

        $routes->connect('/students-results',[
            'controller' => 'Students',
            'action' => 'index'
        ]);

        $routes->connect('/',[
            'controller' => 'Students',
            'action' => 'index'
        ]);

        $routes->connect('/view-student-result/**',
            [
                'controller'=>'Students',
                'action'=>'view'
            ]);

        $routes->post('/add-student-result/**',
            [
                'controller'=>'Students',
                'action'=>'store'
            ]
        );

        $routes->connect('/add-student-result/**',
            [
                'controller'=>'Students',
                'action'=>'add'
            ]
        );

        $routes->put('/edit-student-result/**',
            [
                'controller'=>'Students',
                'action'=>'update'
            ]
        );
        $routes->connect('/edit-student-result/**',
            [
                'controller'=>'Students',
                'action'=>'edit'
            ]
        );
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

        $routes->put('/upload-result',[
            'controller' => 'UploadResult',
            'action' => 'processUploadResult'
        ]);
        $routes->connect('/upload-result',[
            'controller' => 'UploadResult',
            'action' => 'uploadResult'
        ]);

        $routes->connect('/students-positions',[
            'controller' => 'StudentsPositions',
            'action' => 'index'
        ]);

        $routes->connect('/student-result-format/**',[
           'controller' => 'Students',
            'action' => 'viewStudentResultForAdmin'
        ]);
        $routes->put('/publish-students-results',[
            'controller' => 'PublishResults',
            'action' => 'processPublishResults'
        ]);
        $routes->connect('/publish-students-results',[
           'controller' => 'PublishResults',
            'action' => 'index'
        ]);
        $routes->post('/students-annual-promotion',[
            'controller' => 'StudentsAnnualPromotion',
            'action' => 'processAnnualPromotion'
        ]);
        $routes->connect('/students-annual-promotion',[
            'controller' => 'StudentsAnnualPromotion',
            'action' => 'index'
        ]);
        $routes->connect('/view-subject-result/*',[
            'controller' => 'Subjects',
            'action' => 'view'
        ]);
        $routes->connect('/edit-subject-result/*',[
            'controller' => 'Subjects',
            'action' => 'edit'
        ]);
        $routes->post('/add-subject-result/*',[
            'controller' => 'Subjects',
            'action' => 'processAdd'
        ]);
        $routes->connect('/add-subject-result/*',[
            'controller' => 'Subjects',
            'action' => 'add'
        ]);
        $routes->connect('/delete-termly-result/:id',[
            'controller' => 'StudentTermlyResults',
            'action' => 'delete'
        ],['id' => '\d+', 'pass' => ['id']]);

        $routes->connect('/delete-annual-result/:id',[
            'controller' => 'StudentAnnualResults',
            'action' => 'delete'
        ],['id' => '\d+', 'pass' => ['id']]);

        $routes->fallbacks('DashedRoute');
    }
);