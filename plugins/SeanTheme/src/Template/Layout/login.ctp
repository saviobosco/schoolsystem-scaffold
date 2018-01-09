<?php
/* This is the main FrontEnd Layout file for this application
?>
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

$serverName = $this->request->env('SERVER_NAME');
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta name="description" content="">
    <meta name="keywords" content=" ">
    <meta name="author" content="blogwp.com">
    <title>
        <?= $this->fetch('title') ?> |
        <?= $serverName ?>
    </title>
    <?= $this->Html->meta(
        'favicon.ico',
        'school-system.png',
        ['type' => 'icon']
    );
    ?>

    <?= $this->Plugins->css('jquery-ui/themes/base/minified/jquery-ui.min.css') ?>
    <?= $this->Plugins->css('bootstrap/css/bootstrap.min.css') ?>
    <?= $this->Plugins->css('font-awesome/css/font-awesome.min.css') ?>
    <?= $this->FrontEnd->css('animate.min.css') ?>
    <?= $this->FrontEnd->css('style-login.css') ?>
    <?= $this->FrontEnd->css('style-responsive-login.css') ?>
    <?= $this->FrontEnd->css('theme/default-login.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body class="pace-top bg-white">

<div class="login-cover">
    <div class="login-cover-image"><img src="https://images.unsplash.com/photo-1473649085228-583485e6e4d7?dpr=1&auto=format&fit=crop&w=1500&h=844&q=80&cs=tinysrgb&crop=&bg=" alt="Student-photo" /></div>
    <div class="login-cover-bg"></div>
</div>
<div id="page-container" >
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>

</div>
<a id="scroll-top"></a>

<!-- footer script -->
<!-- ================== BEGIN BASE JS ================== -->
<?= $this->Plugins->script('jquery/jquery-1.9.1.min.js') ?>
<?= $this->Plugins->script('jquery/jquery-migrate-1.1.0.min.js') ?>
<?= $this->Plugins->script('jquery-ui/ui/minified/jquery-ui.min.js') ?>
<?= $this->Plugins->script('bootstrap/js/bootstrap.min.js') ?>
<?= $this->Plugins->script('scrollMonitor/scrollMonitor.js') ?>

<?= $this->fetch('script') ?>

<?= $this->FrontEnd->script('apps.js') ?>

<!-- ================== END BASE JS ================== -->

<script>
    $(document).ready(function() {
        App.init();
    });
</script>


</body>
</html>
