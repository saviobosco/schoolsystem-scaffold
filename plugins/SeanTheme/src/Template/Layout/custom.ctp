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
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->fetch('meta') ?>
    <?= $this->Html->meta(
        'favicon.ico',
        '/img/systemfiles/crack-reactor-logo.png',
        ['type' => 'icon']
    );
    ?>
    <?php
    echo $this->Plugins->css('jquery-ui/themes/base/minified/jquery-ui.min.css');
    echo $this->Plugins->css('bootstrap/css/bootstrap.min.css');
    echo $this->Html->css('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    echo $this->Plugins->css('select2/dist/css/select2.min.css');
    echo $this->Html->css('print.css');
    echo $this->Plugins->script('jquery/jquery-1.9.1.min.js');
    echo $this->Plugins->script('jquery/jquery-migrate-1.1.0.min.js');
    ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>

<div class="container body">
    <header class=" navbar navbar-static-top m-b-20 ">
        <nav class=" navbar-default m-b-0 p-20">
            <div class="container">
                <div class="navbar-header">
                    <?= $this->Html->link(Setting::read('Application.school_name'),'/',['class'=>'navbar-brand']) ?>
                </div>

            </div>
        </nav>
        <nav class=" navbar-inverse">
            <div class="container">
                <div>
                    <?php if(empty($this->request->session()->read('Auth.User.id'))): ?>
                        <ul class="nav navbar-nav ">
                            <li><?= $this->Html->link(__('Login'),'/login') ?></li>
                        </ul>
                    <?php endif; ?>
                    <?php if(!empty($this->request->session()->read('Auth.User.id'))): ?>
                        <ul class="nav navbar-nav navbar-right" style="margin-right: 0;">
                            <li><?= $this->Html->link(__('Dashboard'),['plugin'=>null,'controller'=>'Dashboard','action'=>'index']) ?></li>
                            <li><?= $this->Html->link(__('logout'),['plugin'=>null,'controller'=>'MyUsers','action'=>'logout']) ?></li>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
    <div >
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
</div>
<?= $this->Element('footer'); ?>
<?= $this->Site->script('select2/dist/js/select2.full.min.js') ?>
<?= $this->Html->script('app.js') ?>
<script>
    $(document).ready(function() {
        $('select').select2();
    });
</script>
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
