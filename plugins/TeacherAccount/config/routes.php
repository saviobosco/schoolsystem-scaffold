<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'TeacherAccount',
    ['path' => '/teacher-account'],
    function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);

        $routes->get('/dashboard', [
            'controller' => 'Dashboard',
            'action' => 'index'
        ],'teacher:dashboard');

        $routes->get('/profile', [
            'controller' => 'Profile',
            'action' => 'index'
        ],'teacher:profile');

        $routes->get('/students-results/add', [
            'controller' => 'StudentsResults',
            'action' => 'add'
        ],'teacher:students_results:add');

        $routes->post('/students-results/add', [
            'controller' => 'StudentsResults',
            'action' => 'store'
        ],'teacher:students_results:store');

        $routes->get('/students-results/edit', [
            'controller' => 'StudentsResults',
            'action' => 'edit'
        ],'teacher:students_results:edit');

        $routes->put('/students-results/edit', [
            'controller' => 'StudentsResults',
            'action' => 'update'
        ],'teacher:students_results:update');

        $routes->get('/students-results/view', [
            'controller' => 'StudentsResults',
            'action' => 'view'
        ],'teacher:students_results:view');
    }
);
