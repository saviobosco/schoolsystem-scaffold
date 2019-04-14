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
//$this->layout = "SeanTheme.login";
use Cake\Core\Configure;
use Settings\Core\Setting;
$app_name = Setting::read('Application.school_name');
$this->assign('title','Login');
$edittemplates = [
    'inputContainer' => '<div class="form-group m-b-20 ">{{content}}</div>',
    'submitContainer' => '<div class="login-buttons"> {{content}} </div>'
];
$this->Form->templates($edittemplates);
?>
<!-- begin login -->
<div class="login animated fadeInDown">

    <!-- begin brand -->
    <div class="login-header">
        <div class="brand text-center">
            <?= $this->Html->image('school-logo.png', ['class' => 'img-responsive','style'=>'margin:auto']) ?>
        </div>
    </div>
    <!-- end brand -->
    <div class="login-content">
        <?= $this->Flash->render() ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-header text-center"> Account Login </h4>
            </div>
            <div class="panel-body">

                <?= $this->Form->create() ?>
                <fieldset>
                    <?= $this->Form->control('username', ['required' => true]) ?>
                    <?= $this->Form->control('password', ['required' => true]) ?>
                    <?php
                    if (Configure::read('Users.RememberMe.active')) {
                        echo $this->Form->control(Configure::read('Users.Key.Data.rememberMe'), [
                            'type' => 'checkbox',
                            'label' => __d('CakeDC/Users', 'Remember me'),
                            'checked' => Configure::read('Users.RememberMe.checked')
                        ]);
                    }
                    ?>
                    <?php
                    $registrationActive = Configure::read('Users.Registration.active');
                    if ($registrationActive) {
                        echo $this->Html->link(__d('CakeDC/Users', 'Register'), ['action' => 'register']);
                    }
                    if (Configure::read('Users.Email.required')) {
                        if ($registrationActive) {
                            echo ' | ';
                        }
                        echo $this->Html->link(__d('CakeDC/Users', 'Reset Password'), ['action' => 'requestResetPassword']);
                        echo $this->Html->link('Go to Homepage','/',['class' => 'pull-right']);
                    }
                    ?>
                </fieldset>
                <?= $this->Form->button(__d('CakeDC/Users', 'Login'),['class'=>'btn btn-success btn-block btn-lg']); ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<!-- end login -->