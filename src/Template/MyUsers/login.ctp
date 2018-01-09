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
$this->layout = "SeanTheme.login";
use Cake\Core\Configure;

$edittemplates = [
    'inputContainer' => '<div class="form-group m-b-20 ">{{content}}</div>',
    'submitContainer' => '<div class="login-buttons"> {{content}} </div>'
];
$this->Form->templates($edittemplates);
?>

<div class="login login-v2">
    <!-- begin brand -->
    <div class="login-header">
        <div class="brand img-responsive text-center">
            <?= $this->html->image(Configure::read('Application.logo')) ?>
        </div>
    </div>
    <!-- end brand -->
    <div class="login-content">
        <?= $this->Flash->render('auth') ?>
        <?= $this->Flash->render() ?>
        <?= $this->Form->create() ?>
        <?= $this->Form->input('username', ['required' => true,'class'=>'form-control']) ?>
        <?= $this->Form->input('password', ['required' => true,'class'=>'form-control']) ?>
        <?php
        if (Configure::read('Users.reCaptcha.login')) {
            echo $this->User->addReCaptcha();
        }
        if (Configure::check('Users.RememberMe.active')) {
            echo $this->Form->input(Configure::read('Users.Key.Data.rememberMe'), [
                'type' => 'checkbox',
                'label' => __d('Users', 'Remember me'),
                'checked' => 'checked'
            ]);
        }
        ?>
        <?= implode(' ', $this->User->socialLoginList()); ?>
        <?= $this->Form->button(__d('Users', 'Login'),['class'=>'btn btn-primary']); ?>
        <?= $this->Form->end() ?>
        <p class="pull-right"><?= $this->Html->link(__d('users', 'Reset Password'), ['action' => 'requestResetPassword']) ?></p>
        <p class="pull-left"><?= $this->Html->link(__('Go to Homepage'), '/') ?></p>
    </div>
</div>
