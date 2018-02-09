<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Add New Student </h4>
            </div>
            <div class="panel-body">

                <?= $this->Form->create($student) ?>
                <fieldset>
                    <legend><?= __('Add Student') ?></legend>
                    <?php
                    echo $this->Form->control('id',['label' => 'Admission Number','type'=>'text']);
                    echo $this->Form->control('first_name');
                    echo $this->Form->control('last_name');
                    echo $this->Form->label('Gender');
                    echo $this->Form->radio('gender',[
                        ['value' => 'male', 'text' => 'Male',],
                        ['value' => 'female', 'text' => 'Female',]
                    ],['hiddenField'=>false,'label'=>true,'templates'=>['input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>',]]);
                    echo $this->Site->datePickerInput('date_of_birth');
                    //echo $this->Form->control('state_id');
                    echo $this->Form->control('class_id',['empty'=>'Select Class','required'=>true]);
                    echo $this->Form->control('session_id',['empty'=>'Select Session','required'=>true]);
                    echo $this->Form->control('religion_id',['options'=>$religions]);
                    echo $this->Form->control('home_residence');
                    echo $this->Form->control('guardian');
                    echo $this->Form->control('relationship_to_guardian');
                    echo $this->Form->control('occupation_of_guardian');
                    echo $this->Form->control('guardian_phone_number');
                    echo $this->Form->control('return_here',['type'=>'checkbox','checked'=>true])
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Add Student'),['class'=>'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

