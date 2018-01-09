<?php
$user = ${$tableAlias};
 $this->assign('title','Editing User '.$user->full_name); ?>
<div>
    <div class="col-sm-12">
        <?= $this->Form->create($user) ?>
        <fieldset>
            <legend><?= __('Edit Teacher') ?></legend>
            <?php
            echo $this->Form->input('first_name',['class'=>'form-control']);
            echo $this->Form->input('last_name',['class'=>'form-control']);
            echo $this->Form->input('role', [
                'options' => ['student'=>'Student','teacher'=>'Teacher','admin' => 'Admin'],
                'class'=>'form-control','escape'=>false,
            ]);
            echo $this->Form->input('is_superuser',['type'=>'checkbox','data-render'=>'switchery']);
            echo $this->Form->input('active',['type'=>'checkbox','data-render'=>'switchery']);
            ?>

        </fieldset>
        <?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>



