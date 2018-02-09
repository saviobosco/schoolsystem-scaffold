<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'FinanceManager',
    ['path' => '/finance-manager'],
    function (RouteBuilder $routes) {

        $routes->post('/pay-fees/**',[
            'controller' => 'StudentPayments',
            'action' => 'payFees'
        ]);
        $routes->connect('/pay-fees/**',[
            'controller' => 'StudentFees',
            'action' => 'getStudentFees'
        ]);

        $routes->connect('/payment-records/**',[
            'controller' => 'StudentPayments',
            'action' => 'studentPaymentRecord'
        ]);

        $routes->connect('/get-student-bills/**',[
            'controller' => 'StudentFees',
            'action' => 'getStudentBill'
        ]);

        $routes->connect('/payment-receipt/:id',[
            'controller' => 'StudentPayments',
            'action' => 'paymentReceipt'
        ],['id' => '\d+', 'pass' => ['id']]);

        $routes->connect('/fees-statistics',[
            'controller' => 'FeesStatistics',
            'action' => 'index'
        ]);
        $routes->connect('/fee-stat/:id',[
            'controller' => 'FeesStatistics',
            'action' => 'view'
        ],['id' => '\d+', 'pass' => ['id']]);

        $routes->connect('/fees-query',[
            'controller' => 'FeesStatistics',
            'action' => 'query'
        ]);
        $routes->connect('/fees-defaulters',[
            'controller' => 'FeesDefaulters',
            'action' => 'index'
        ]);
        $routes->connect('/fee-defaulter/:id',[
            'controller' => 'FeesDefaulters',
            'action' => 'view'
        ],['id' => '\d+', 'pass' => ['id']]);

        $routes->connect('/fees-complete',[
            'controller' => 'FeesComplete',
            'action' => 'index'
        ]);
        $routes->connect('/fee-complete/:id',[
            'controller' => 'FeesComplete',
            'action' => 'view'
        ],['id' => '\d+', 'pass' => ['id']]);

        $routes->fallbacks(DashedRoute::class);
    }
);
