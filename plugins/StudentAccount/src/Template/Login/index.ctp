<?php
/**
 * Copyright 2010 - 2015, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2015, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

use Cake\Core\Configure;
use Settings\Core\Setting;
$this->assign('title','Student Login');

$formTemplates = [
    'inputContainer' => '<div class="form-group m-b-20 ">{{content}}</div>',
    'submitContainer' => '<div class="login-buttons"> {{content}} </div>'
];
$this->Form->templates($formTemplates);
?>

<!-- begin login -->
<div class="login animated fadeInDown">
    <!-- begin brand -->
    <div class="login-header">
        <div class="brand text-center">
            <?= $this->SchoolAsset->getSchoolLogo() ?>
        </div>
    </div>
    <!-- end brand -->
    <div class="login-content">
        <?= $this->Flash->render() ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-header text-center"> Student Login </h4>
            </div>
            <div class="panel-body">

                <?= $this->Form->create(null, ['url' => ['action' => 'login']]) ?>
                <?= $this->Form->control('username', ['required' => true]) ?>
                <?= $this->Form->control('password', ['required' => true]) ?>
                <?php
                echo $this->Html->link('Go to Homepage','/',['class' => 'pull-right']);
                ?>
                <?= $this->Form->button(__( 'Login'),['class'=>'btn btn-success btn-block btn-lg']); ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<!-- end login -->