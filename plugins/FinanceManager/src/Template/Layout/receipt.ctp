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

$cakeDescription = 'Finance Manager';
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title> Finance Manager :</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <?php
    echo $this->Plugins->css('bootstrap/css/bootstrap.min.css');
    ?>
    <?= $this->Html->css('print.css') ?>
    <?= $this->Html->css('receipt.css') ?>
    <?= $this->Plugins->script('jquery/jquery-1.9.1.min.js'); ?>
    <?= $this->fetch('topScripts') ?>
    <!-- ================== END BASE JS ================== -->
</head>
<body>
<!-- begin #content -->
<div class="container">
    <?= $this->fetch('content') ?>
</div>
<!-- end #content -->
</body>
<script>
    $(document).ready(function() {
        // get the student copy and append to school copy
        var studentCopy = $('#student-copy');
        var schoolCopy = $('#school-copy');
        schoolCopy.append(studentCopy.html())
    });
</script>
</html>