<?php
$this->layout = "SeanTheme.login";
use Cake\Core\Configure;
use Settings\Core\Setting;
$app_name = Setting::read('Application.school_name');
?>
<div class="login animated fadeInDown">

    <!-- begin brand -->
    <div class="login-header">
        <div class="brand">
            <span class="text-center"> <?= $app_name ?> </span>
            <small>A simple School Administrative System </small>
        </div>
    </div>
    <!-- end brand -->
    <div class="login-content">
        <?= $this->Flash->render() ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-header text-center"> Account Reset </h4>
            </div>
            <div class="panel-body">

                <?= $this->Form->create('User') ?>
                <fieldset>
                    <legend><?= __d('CakeDC/Users', 'Please enter your email to reset your password') ?></legend>
                    <?= $this->Form->control('reference',['label'=>'Email Address']) ?>
                </fieldset>
                <?= $this->Form->button(__d('CakeDC/Users', 'Submit'),['class'=>'btn btn-success btn-block btn-lg']); ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
