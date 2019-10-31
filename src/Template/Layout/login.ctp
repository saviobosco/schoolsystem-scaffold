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
    <meta name="author" content="saviobosco">
    <?= $this->fetch('meta') ?>
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

    <?php /* $this->Plugins->css('jquery-ui/themes/base/minified/jquery-ui.min.css')*/ ?>
    <?= $this->Plugins->css('bootstrap/css/bootstrap.min.css') ?>
    <?= $this->FrontEnd->css('animate.min.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('style-responsive.css') ?>
    <?php /*$this->fetch('css')*/ ?>
</head>
<body class="">

<!-- begin #page-container -->
<div id="page-container">
    <?= $this->fetch('content') ?>
</div>
<!-- end page container -->

<!-- footer script -->
<!-- ================== BEGIN BASE JS ================== -->
<?= $this->Plugins->script('jquery/jquery-1.9.1.min.js') ?>
<?= $this->Plugins->script('jquery/jquery-migrate-1.1.0.min.js') ?>
<?= $this->fetch('script') ?>

<!-- ================== END BASE JS ================== -->


</body>
</html>
