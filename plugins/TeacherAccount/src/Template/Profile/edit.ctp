<?php
$this->assign('title', 'Teacher-Account: Edit Profile')
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Edit Account </h4>
            </div>
            <div class="panel-body">

                <?= $this->Form->create($user) ?>
                <fieldset>
                    <?php
                    echo $this->Form->input('username',['class'=>'form-control','readonly']);
                    //echo $this->Form->input('password',['class'=>'form-control']);
                    echo $this->Form->input('email',['class'=>'form-control']);
                    echo $this->Form->input('first_name',['class'=>'form-control']);
                    echo $this->Form->input('last_name',['class'=>'form-control']);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>