<?php
$this->extend('/Common/view');
$this->assign('title','Edit Medical Issue');
?>
<div>
    <?= $this->Form->create($medicalIssue) ?>
    <fieldset>
        <legend><?= __('Add Medical issue') ?></legend>
        <?php
        echo $this->Form->input('issue',['type'=>'text']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success m-t-20']) ?>
    <?= $this->Form->end() ?>
</div>

