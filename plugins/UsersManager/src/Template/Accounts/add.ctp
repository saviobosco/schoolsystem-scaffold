<?php
$user = $account;
$this->assign('title','Add New User');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Add New User </h4>
            </div>
            <div class="panel-body">

                <?= $this->Form->create($user) ?>
                <fieldset>
                    <legend><?= __('Add New User') ?></legend>
                    <?php
                    echo $this->Form->input('username',['class'=>'form-control']);
                    echo $this->Form->input('password',['class'=>'form-control']);
                    echo $this->Form->input('email',['class'=>'form-control']);
                    echo $this->Form->input('first_name',['class'=>'form-control']);
                    echo $this->Form->input('last_name',['class'=>'form-control']);
                    echo $this->Form->input('role', [
                        'options' => \Cake\Core\Configure::read('UserRoles'),
                        'class'=>'form-control','escape'=>false,
                    ]);
                    echo $this->Form->input('is_superuser',['data-render'=>'switchery']);
                    echo $this->Form->input('active',['type'=>'checkbox','data-render'=>'switchery']);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
