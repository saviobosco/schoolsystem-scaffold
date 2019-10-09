<?php
$this->extend('/Common/view');
$this->assign('title','Edit Result Input');
?>
<div>
    <?= $this->Form->create($resultInput, ['type' => 'PUT']) ?>
    <div class="row">
        <div class="col-sm-2">
            <?= $this->Form->label('column') ?>
            <?= $this->Form->select('main_value', $main_values) ?>
        </div>
        <div class="col-sm-2">
            <?= $this->Form->input('replacement', ['label' => 'Actual Name']) ?>
        </div>
        <div class="col-sm-2">
            <?= $this->Form->input('percentage', ['type' =>'number', 'label' => 'Percent']) ?>
        </div>
        <div class="col-sm-2">
            <?= $this->Form->input('output_order', ['label' => 'Sort Order']) ?>
        </div>
        <div class="col-sm-2">
            <?= $this->Form->label('Session') ?>
            <?= $this->Form->select('session_id', $sessions) ?>
        </div>
        <div class="col-sm-2 m-t-25" >
            <?= $this->Form->submit('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>