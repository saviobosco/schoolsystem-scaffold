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
$cakeDescription = Setting::read('Application.school_name');
$application_detail = Configure::read('Application');
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?> :
        <?= $this->fetch('title') ?>
    </title>

    <?= $this->Html->meta(
        'favicon.ico',
        'school-system.png',
        ['type' => 'icon']
    );
    ?>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <?php
    echo $this->Plugins->css('jquery-ui/themes/base/minified/jquery-ui.min.css');
    echo $this->Plugins->css('bootstrap/css/bootstrap.min.css');
    echo $this->Html->css('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    echo $this->Html->css('animate.css');
    echo $this->Html->css('style.css');
    echo $this->Html->css('style-responsive.min.css');
    echo $this->Plugins->css('select2/dist/css/select2.min.css');
    echo $this->Plugins->css('switchery/switchery.min.css');

    echo $this->Plugins->css('DataTables/media/css/dataTables.bootstrap.min.css');
    echo $this->Plugins->css('DataTables/extensions/Responsive/css/responsive.bootstrap.min.css');
    echo $this->Html->css('print.css');
    ?>
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    <?= $this->fetch('css') ?>
    <?= $this->fetch('topScripts') ?>
    <!-- ================== END PAGE LEVEL CSS STYLE ================== -->
    <!-- ================== BEGIN BASE JS ================== -->
    <?= $this->Site->script('pace/pace.min.js')  ?>
    <?php
    echo $this->Plugins->script('jquery/jquery-1.9.1.min.js');
    echo $this->Plugins->script('jquery/jquery-migrate-1.1.0.min.js');

    ?>
    <!-- ================== END BASE JS ================== -->
    <?= $this->fetch('meta') ?>
</head>

<body>
<!-- begin #page-loader -->
<!--<div id="page-loader" class="fade in"><span class="spinner"></span></div> -->
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class=" page-sidebar-fixed page-header-fixed">

    <!-- begin #header -->
    <div id="header" class="header navbar navbar-default navbar-fixed-top">
        <!-- begin container-fluid -->
        <div class="container-fluid">
            <!-- begin mobile sidebar expand / collapse button -->
            <div class="navbar-header">
                <?= $this->Html->link(Setting::read('Application.school_name'), '/', ['class' => 'navbar-brand']) ?>
                <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- end mobile sidebar expand / collapse button -->

            <!-- begin header navigation right -->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown navbar-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                        <!--<img src="assets/img/user-13.jpg" alt="" /> -->
                        <span class="hidden-xs"><?= $this->request->session()->read('Auth.User.student.first_name').' '.$this->request->session()->read('Auth.User.student.last_name') ?></span> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu animated fadeInLeft">
                        <li class="arrow"></li>
                        <li>
                            <?= $this->html->link('<i class="fa fa-power-off"></i> <span>Log Out</span>',[
                                'plugin'=>'StudentAccount',
                                'controller'=>'Logout',
                                'action' => 'index'
                            ],[
                                'escape' => false
                            ]) ?>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- end header navigation right -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end #header -->

    <?php $renderPluginSidebar = false; ( $this->request->session()->read('Auth.User.role') === 'superuser' ) ?: $renderPluginSidebar = true;  ?>

    <?= $this->element('sidebar',[],['plugin'=>$renderPluginSidebar]) ?>

    <!-- begin #content -->
    <div id="content" class="content">

        <!-- begin breadcrumb -->
        <?php
        /*$this->Html->addCrumb($this->request->params['controller'],Inflector::underscore('/'.$this->request->params['controller'] ));
        $this->Html->addCrumb('Add User', ['controller' => 'Users', 'action' => 'add']);
        echo $this->Html->getCrumbList([
            'lastClass' => 'active',
            'class' => 'breadcrumb pull-right',
        ],
            $startText = [
                'text' => '<i class="fa fa-home fa-2x"></i>',
                'url' => '/',
                'escape' => false
            ]); */
        ?>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Welcome, <?= $this->request->session()->read('Auth.User.student.first_name') ?> <small> last seen: <?= (new \Cake\I18n\Time($this->request->session()->read('Auth.User.last_seen')))->format('M j, Y \a\t g:i a')  ?> </small></h1>
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
echo $this->Site->script('jquery-ui/ui/minified/jquery-ui.min.js');
echo $this->Site->script('bootstrap/js/bootstrap.min.js');
?>
<!--[if lt IE 9]>
<?php
echo $this->Site->script('crossbrowserjs/html5shiv.js',['pathPrefix' => 'assets/']);
echo $this->Site->script('crossbrowserjs/respond.min.js',['pathPrefix' => 'assets/']);
echo $this->Site->script('crossbrowserjs/excanvas.min.js',['pathPrefix' => 'assets/']);
?>
<![endif]-->
<?= $this->Html->script('jquery.form.min.js') ?>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<?php
echo $this->Site->script('bootstrap-datepicker/js/bootstrap-datepicker.js');
echo $this->Html->script('table-manage-default.demo.js');
?>
<?= $this->fetch('script') ?>
<?= $this->fetch('bottomScripts') ?>
<?= $this->Html->script('apps.js'); ?>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        App.init();
        //$('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>
</html>







