<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Settings\Core\Setting;
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= Setting::read('Application.school_name') ?>
    </title>
    <?= $this->fetch('meta') ?>
    <?= $this->Html->meta(
        'favicon.ico',
        'school-system.png',
        ['type' => 'icon']
    );
    ?>
    <?php
    echo $this->Plugins->css('bootstrap/css/bootstrap.min.css');
    //echo $this->Html->css('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    echo $this->Html->css('print.css');
    echo $this->Plugins->script('jquery/jquery-1.9.1.min.js');
    ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <style>
        body {
            font: 400 15px Lato, sans-serif;
            line-height: 1.8;
            color: #000000;
            background-color: #f4f6f7;
        }
        a,a:hover,a:focus,a:active {
            color: #0F6DB7;
        }
        h2 {
            font-size: 24px;
            text-transform: uppercase;
            color: #303030;
            font-weight: 600;
            margin-bottom: 30px;
        }
        h4 {
            font-size: 19px;
            line-height: 1.375em;
            color: #303030;
            font-weight: 400;
            margin-bottom: 30px;
        }

        .item h4 {
            font-size: 19px;
            line-height: 1.375em;
            font-weight: 400;
            font-style: italic;
            margin: 70px 0;
        }
        .item span {
            font-style: normal;
        }

        @media screen and (max-width: 768px) {
            .col-sm-4 {
                text-align: center;
                /*margin: 25px 0; */
            }
            .btn-lg {
                width: 100%;
                margin-bottom: 35px;
            }
        }
        @media screen and (max-width: 480px) {
            .logo {
                font-size: 150px;
            }
        }


        .m-auto { margin: 0 auto !important; }
        .m-0 { margin: 0px !important; }
        .m-1 { margin: 1px !important; }
        .m-2 { margin: 2px !important; }
        .m-3 { margin: 3px !important; }
        .m-4 { margin: 4px !important; }
        .m-5 { margin: 5px !important; }
        .m-10 { margin: 10px !important; }
        .m-15 { margin: 15px !important; }
        .m-20 { margin: 20px !important; }
        .m-25 { margin: 25px !important; }
        .m-30 { margin: 30px !important; }
        .m-35 { margin: 35px !important; }
        .m-40 { margin: 40px !important; }

        .m-t-0 { margin-top: 0px !important; }
        .m-t-1 { margin-top: 1px !important; }
        .m-t-2 { margin-top: 2px !important; }
        .m-t-3 { margin-top: 3px !important; }
        .m-t-4 { margin-top: 4px !important; }
        .m-t-5 { margin-top: 5px !important; }
        .m-t-10 { margin-top: 10px !important; }
        .m-t-15 { margin-top: 15px !important; }
        .m-t-20 { margin-top: 20px !important; }
        .m-t-25 { margin-top: 25px !important; }
        .m-t-30 { margin-top: 30px !important; }
        .m-t-35 { margin-top: 35px !important; }
        .m-t-40 { margin-top: 40px !important; }
        .m-t-50 { margin-top: 50px !important; }
        .m-t-70 { margin-top: 70px !important; }
        .m-t-90 { margin-top: 90px !important; }

        .m-r-0 { margin-right: 0px !important; }
        .m-r-1 { margin-right: 1px !important; }
        .m-r-2 { margin-right: 2px !important; }
        .m-r-3 { margin-right: 3px !important; }
        .m-r-4 { margin-right: 4px !important; }
        .m-r-5 { margin-right: 5px !important; }
        .m-r-10 { margin-right: 10px !important; }
        .m-r-15 { margin-right: 15px !important; }
        .m-r-20 { margin-right: 20px !important; }
        .m-r-25 { margin-right: 25px !important; }
        .m-r-30 { margin-right: 30px !important; }
        .m-r-35 { margin-right: 35px !important; }
        .m-r-40 { margin-right: 40px !important; }

        .m-b-0 { margin-bottom: 0px !important; }
        .m-b-1 { margin-bottom: 1px !important; }
        .m-b-2 { margin-bottom: 2px !important; }
        .m-b-3 { margin-bottom: 3px !important; }
        .m-b-4 { margin-bottom: 4px !important; }
        .m-b-5 { margin-bottom: 5px !important; }
        .m-b-10 { margin-bottom: 10px !important; }
        .m-b-15 { margin-bottom: 15px !important; }
        .m-b-20 { margin-bottom: 20px !important; }
        .m-b-25 { margin-bottom: 25px !important; }
        .m-b-30 { margin-bottom: 30px !important; }
        .m-b-35 { margin-bottom: 35px !important; }
        .m-b-40 { margin-bottom: 40px !important; }
        .m-b-90 { margin-bottom: 90px !important; }

        .m-l-0 { margin-left: 0px !important; }
        .m-l-1 { margin-left: 1px !important; }
        .m-l-2 { margin-left: 2px !important; }
        .m-l-3 { margin-left: 3px !important; }
        .m-l-4 { margin-left: 4px !important; }
        .m-l-5 { margin-left: 5px !important; }
        .m-l-10 { margin-left: 10px !important; }
        .m-l-15 { margin-left: 15px !important; }
        .m-l-20 { margin-left: 20px !important; }
        .m-l-25 { margin-left: 25px !important; }
        .m-l-30 { margin-left: 30px !important; }
        .m-l-35 { margin-left: 35px !important; }
        .m-l-40 { margin-left: 40px !important; }

        .p-0 { padding: 0px !important; }
        .p-1 { padding: 1px !important; }
        .p-2 { padding: 2px !important; }
        .p-3 { padding: 3px !important; }
        .p-4 { padding: 4px !important; }
        .p-5 { padding: 5px !important; }
        .p-10 { padding: 10px !important; }
        .p-15, .wrapper { padding: 15px !important; }
        .p-20 { padding: 20px !important; }
        .p-25 { padding: 25px !important; }
        .p-30 { padding: 30px !important; }
        .p-35 { padding: 35px !important; }
        .p-40 { padding: 40px !important; }

        .p-t-0 { padding-top: 0px !important; }
        .p-t-1 { padding-top: 1px !important; }
        .p-t-2 { padding-top: 2px !important; }
        .p-t-3 { padding-top: 3px !important; }
        .p-t-4 { padding-top: 4px !important; }
        .p-t-5 { padding-top: 5px !important; }
        .p-t-10 { padding-top: 10px !important; }
        .p-t-15 { padding-top: 15px !important; }
        .p-t-20 { padding-top: 20px !important; }
        .p-t-25 { padding-top: 25px !important; }
        .p-t-30 { padding-top: 30px !important; }
        .p-t-35 { padding-top: 35px !important; }
        .p-t-40 { padding-top: 40px !important; }

        .p-r-0 { padding-right: 0px !important; }
        .p-r-1 { padding-right: 1px !important; }
        .p-r-2 { padding-right: 2px !important; }
        .p-r-3 { padding-right: 3px !important; }
        .p-r-4 { padding-right: 4px !important; }
        .p-r-5 { padding-right: 5px !important; }
        .p-r-10 { padding-right: 10px !important; }
        .p-r-15 { padding-right: 15px !important; }
        .p-r-20 { padding-right: 20px !important; }
        .p-r-25 { padding-right: 25px !important; }
        .p-r-30 { padding-right: 30px !important; }
        .p-r-35 { padding-right: 35px !important; }
        .p-r-40 { padding-right: 40px !important; }

        .p-b-0 { padding-bottom: 0px !important; }
        .p-b-1 { padding-bottom: 1px !important; }
        .p-b-2 { padding-bottom: 2px !important; }
        .p-b-3 { padding-bottom: 3px !important; }
        .p-b-4 { padding-bottom: 4px !important; }
        .p-b-5 { padding-bottom: 5px !important; }
        .p-b-10 { padding-bottom: 10px !important; }
        .p-b-15 { padding-bottom: 15px !important; }
        .p-b-20 { padding-bottom: 20px !important; }
        .p-b-25 { padding-bottom: 25px !important; }
        .p-b-30 { padding-bottom: 30px !important; }
        .p-b-35 { padding-bottom: 35px !important; }
        .p-b-40 { padding-bottom: 40px !important; }

        .p-l-0 { padding-left: 0px !important; }
        .p-l-1 { padding-left: 1px !important; }
        .p-l-2 { padding-left: 2px !important; }
        .p-l-3 { padding-left: 3px !important; }
        .p-l-4 { padding-left: 4px !important; }
        .p-l-5 { padding-left: 5px !important; }
        .p-l-10 { padding-left: 10px !important; }
        .p-l-15 { padding-left: 15px !important; }
        .p-l-20 { padding-left: 20px !important; }
        .p-l-25 { padding-left: 25px !important; }
        .p-l-30 { padding-left: 30px !important; }
        .p-l-35 { padding-left: 35px !important; }
        .p-l-40 { padding-left: 40px !important; }


        .required > label::after {
            content: " *";
            color: #C3232D;
        }

        /* 2.3 Header & header elements */

        .header {
            z-index: 1020;
            margin-bottom: 0;
        }
        .navbar {
            border: none;
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
            /*-webkit-box-shadow: 0 0 2px rgba(0,0,0,0.3);
            box-shadow: 0 0 2px rgba(0,0,0,0.3);*/
        }
        .navbar-default {
            background: #ffffff; /* #4BBADB formal color */
            box-shadow: 0;
        }
        .navbar-inverse {
            border-bottom:1px solid #ECECEC;
            background: #ffffff;
        }
        .navbar.navbar-inverse .navbar-brand,
        .navbar.navbar-inverse .navbar-nav > li > a {
            color: #004466;
        }

        .navbar-brand {
            /*padding: 12px 20px;*/
            height: 100%;
            font-weight: 500;
            line-height: 30px;
        }
        .navbar-brand > img {
            max-height: 100%;
            height: 100%;
            width: auto;
            margin: 0 auto
        }
        .navbar-default .navbar-brand {
            color: #001A27;
            font-size: 40px;
            font-weight: 500;
            font-family: 'Open Sans', sans-serif;
        }

        .navbar-default .navbar-brand:focus, .navbar-default .navbar-brand:hover {
            color: #005e8d;
        }

        .navbar-toggle {
            margin-top: 10px;
            margin-bottom: 10px;
            padding: 10px;
            border: none;
        }
        .navbar-toggle.pull-left {
            margin-left: 15px;
            margin-right: 0;
        }
        .navbar-default .navbar-toggle .icon-bar {
            background: #333;
        }
        .navbar-toggle:hover,
        .navbar-toggle:focus {
            background: none !important;
            opacity: 0.6;
            filter: alpha(opacity=60);
        }
        .navbar-nav > li > a {
            line-height: 20px;
            padding: 17px 15px;
        }
        .navbar-inverse .navbar-nav > li > a {
            color: #1F5E8D;
        }
        .navbar-inverse .navbar-nav > li > a:hover,
        .navbar-nav > li > a:focus {
            color: #1F5E8D;
        }

        .navbar-nav > .open > a,
        .navbar-nav > .open > a:hover,
        .navbar-nav > .open > a:focus {
            background: none !important;
            color: #333;
            opacity: 1.0;
            filter: alpha(opacity=100);
        }

        .navbar-nav > li > .dropdown-menu {
            border-top: 1px solid #eee;
        }
        .navbar-nav > li > .dropdown-menu.media-list .media-heading {
            font-weight: 600;
        }
        .navbar-nav > li > a .label {
            position: absolute;
            top: 7px;
            right: 3px;
            display: block;
            background: #ff5b57;
            line-height: 12px;
            font-weight: 300;
            padding: .3em .6em .3em;
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
        }

        .navbar-default .navbar-nav .open .dropdown-menu > li > a {
            color: #333;
        }
        .navbar .navbar-nav > li.divider {
            height: 34px;
            margin-top: 10px;
            background: #e2e7eb;
            width: 1px;
        }
        .navbar.navbar-inverse .navbar-nav > li.divider {
            background: #3F4B55;
        }

        /* -------------------------------
           3.0 Content Setting
        ------------------------------- */

        /* 3.1 General Content Setting */
        .body {
            margin-top: 10px;
            border-radius: 4px;
            background-color: #ffffff;
            margin-bottom: 20px;
            border: 1px solid rgba(0,0,0,0.15);
            -moz-box-shadow: 0px 0px 6px rgba(0,0,0,0.05);
            -webkit-box-shadow: 0px 0px 6px rgba(0,0,0,0.05);
            box-shadow: 0px 0px 6px rgba(0,0,0,0.05);
        }

        /* -------------------------------
           8.0 Footer Setting
        ------------------------------- */

        /* 8.2 Footer Copyright Setting */

        .footer-copyright {
            padding: 20px 0;
            font-size: 15px;
            color: #000000;
        }
        .footer-copyright:before,
        .footer-copyright:after {
            content: '';
            display: table;
            clear: both;
        }

        @media (max-width: 767px) {
            .navbar-default .navbar-brand {
                font-size: 13px;
                font-weight: 500;
            }
        }
    </style>
</head>
<body>

<div class="container body">
    <header>
        <nav class="navbar navbar-inverse m-b-0 p-20">
            <div class="container-fluid">
                <div class="navbar-header">
                    <?= $this->Html->link($this->Html->image('school-logo.png', ['class' => 'img-responsive']) ,'/',['class'=>'navbar-brand','escape'=>false]) ?>
                    <h2>
                        <?= Setting::read('Application.school_name'); ?>
                    </h2>
                </div>
            </div>
        </nav>
        <nav class=" navbar-inverse m-b-10">
            <?php if(empty($this->request->session()->read('Auth.User.id'))): ?>
                <ul class="nav navbar-nav navbar-right ">
                    <li><?= $this->Html->link(__('Administrative Login'),'/login') ?></li>
                </ul>
            <?php endif; ?>
            <?php if(!empty($this->request->session()->read('Auth.User.id'))): ?>
                <ul class="nav navbar-nav navbar-right" style="margin-right: 0;">
                    <li><?= $this->Html->link(__('Dashboard'),['plugin'=>null,'controller'=>'Dashboard','action'=>'index']) ?></li>
                    <li><?= $this->Html->link(__('logout'),['plugin'=>null,'controller'=>'MyUsers','action'=>'logout']) ?></li>
                </ul>
            <?php endif; ?>
        </nav>
    </header>
    <div>
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
    <hr>
    <?= $this->Element('footer'); ?>
</div>
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5c07a21efd65052a5c93d94d/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
</body>
</html>
