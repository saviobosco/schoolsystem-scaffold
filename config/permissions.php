<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 4/30/16
 * Time: 1:09 PM
 */

return [
    'Users.SimpleRbac.permissions' => [
        // superuser rights only
        [
            'role' => 'superuser',
            'prefix' => '*',
            'extension' => '*',
            'plugin' => '*',
            'controller' => '*',
            'action' => '*',
        ],
        [
            'role' => ['admin','bursar','user'],
            'plugin' => ['ResultSystem'],
            'controller' => ['StudentResultPins'],
            'action' => '*',
            'allowed' => false
        ],
        [
            'role' => ['admin','bursar','user'],
            'plugin' => ['UsersManager'],
            'controller' => ['Accounts'],
            'action' => ['index','add','edit','delete'],
            'allowed' => false
        ],
        [
            'role' => ['admin','bursar','user'],
            'plugin' => 'ClassManager',
            'controller' => '*',
            'action' => '*',
            'allowed' => false
        ],
        [
            'role' => ['admin','bursar','user'],
            'plugin' => null,
            'controller' => 'Dashboard',
            'action' => '*',
            'allowed' => false
        ],
        [
            'role' => ['admin','bursar','user'],
            //'plugin' => 'ClassManager',
            'controller' => 'Sessions',
            'action' => '*',
            'allowed' => false
        ],
        // admin rights
        [
            'role' => ['bursar','user'],
            'plugin' => ['ClassManager','ResultSystem','SkillsGradingSystem','GradingSystem','SubjectsManager'],
            'controller' => '*',
            'action' => '*',
            'allowed' => false
        ],
        // bursar rights only
        [
            'role' => ['admin','user'],
            'plugin' => ['FinanceManager'],
            'controller' => '*',
            'action' => '*',
            'allowed' => false
        ],
        // user rights only
        [
            'role' => ['admin','bursar'],
            'plugin' => ['StudentsManager'],
            'controller' => '*',
            'action' => '*',
            'allowed' => false
        ],
        [
            'role' => ['user','bursar','admin'],
            'controller' => '*',
            'action' => '*',
            'plugin' => '*'
        ],

    ]
];
