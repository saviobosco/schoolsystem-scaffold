<?php
$user = ${$tableAlias};
echo $this->assign('title','Add New User'); ?>
<section>
    <div class="row m-b-30">
        <div class="col-sm-9">
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
                    'options' => ['student'=>'Student','teacher'=>'Teacher','admin' => 'Admin'],
                        'class'=>'form-control','escape'=>false,
                ]);
                echo $this->Form->input('is_superuser',['data-render'=>'switchery']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary']) ?>
            <?= $this->Form->end() ?>
        </div>
        <div class="col-sm-3 m-t-50 teacher-right">
            <aside>
                <div class="well">
                    <h5 class="text-danger"> Note </h5>
                    <ul>
                        <li> Every User is not active by default. You will need to activate the user's account after registering.</li>
                        <li> Users with super user role have unrestricted access .</li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>

</section>