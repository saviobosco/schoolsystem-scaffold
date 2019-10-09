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
use Cake\Core\Configure;
use Settings\Core\Setting;
$title = Setting::read('Application.school_name');
$application_detail = Configure::read('Application');
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title ?> :
        <?= $this->fetch('title') ?>
    </title>

    <?= $this->Html->meta(
        'favicon.ico',
        'school-system.png',
        ['type' => 'icon']
    );
    ?>
    <?= $this->fetch('meta') ?>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <?php
    echo $this->Plugins->css('bootstrap/css/bootstrap.min.css');
    echo $this->Plugins->css('font-awesome/css/font-awesome.min.css');
    //echo $this->Html->css('animate.css');
    echo $this->Html->css('style.css');
    echo $this->Html->css('style-responsive.min.css');
    //echo $this->Plugins->css('switchery/switchery.min.css');

    //echo $this->Plugins->css('DataTables/media/css/dataTables.bootstrap.min.css');
    //echo $this->Plugins->css('DataTables/extensions/Responsive/css/responsive.bootstrap.min.css');
    echo $this->Html->css('print.css');
    ?>
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
            <?= $this->fetch('css') ?>
            <?= $this->fetch('topScripts') ?>
    <!-- ================== END PAGE LEVEL CSS STYLE ================== -->
    <!-- ================== BEGIN BASE JS ================== -->
    <?php
    echo $this->Plugins->script('jquery/jquery-1.9.1.min.js');
    //echo $this->Plugins->script('jquery/jquery-migrate-1.1.0.min.js');
    ?>
    <!-- ================== END BASE JS ================== -->
</head>

<body>
<!-- begin #page-container -->
<div id="page-container" class=" page-sidebar-fixed page-header-fixed">
    <?php if(!empty($this->request->session()->read('Auth.User.id'))): ?>
        <?= $this->element('loggedInHeader'); ?>
    <?php endif; ?>

    <?php $renderPluginSidebar = false; ( $this->request->session()->read('Auth.User.role') === 'superuser' ) ?: $renderPluginSidebar = true;  ?>
    <?php
    switch($this->request->session()->read('Auth.User.role')) {
        case 'superuser':
        case 'admin':
        case 'bursar':
        case 'user':
            echo $this->element('sidebar', [], ['plugin'=>$renderPluginSidebar]);
            break;
        case 'student':
            echo $this->element('Sidebar/student');
            break;
        case 'parent':
            echo $this->element('Sidebar/parent');
            break;
        case 'teacher':
            echo $this->element('Sidebar/teacher');
            break;
        default:
            echo $this->element('sidebar', [], ['plugin'=>$renderPluginSidebar]);
    }
    ?>

    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin page-header -->
        <div id="ajax-request-feedback">

        </div>
        <?= $this->Flash->render('auth') ?>
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
    <!-- end #content -->
    <div class="footer">
        <p class="pull-right"><?= $application_detail['Name'] ?> <?= $application_detail['Version'] ?> Powered by &copy; <a class="text-orange" href="<?= $application_detail['Href_link'] ?>" title="Visit <?= $application_detail['Company'] ?>" data-toggle='tooltip' trigger="focus" ><?= Configure::read('Application.Company') ?></a> All copyright reserved.</p>
    </div>


    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->
</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<?php
//echo $this->Site->script('jquery-ui/ui/minified/jquery-ui.min.js');
echo $this->Site->script('bootstrap/js/bootstrap.min.js');
?>
<!--[if lt IE 9]>
<?php
echo $this->Site->script('crossbrowserjs/html5shiv.js',['pathPrefix' => 'assets/']);
echo $this->Site->script('crossbrowserjs/respond.min.js',['pathPrefix' => 'assets/']);
echo $this->Site->script('crossbrowserjs/excanvas.min.js',['pathPrefix' => 'assets/']);
 ?>
<![endif]-->
<?php
//echo $this->Site->script('slimscroll/jquery.slimscroll.min.js');
//echo $this->Site->script('select2/dist/js/select2.full.min.js');
//echo $this->Site->script('switchery/switchery.min.js');
?>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<?php
/*echo $this->Site->script('bootstrap-datepicker/js/bootstrap-datepicker.js');*/
?>
<?= $this->fetch('script') ?>
<?= $this->fetch('bottomScripts') ?>
<?= $this->Html->script('apps.js'); ?>

<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
</body>
</html>







