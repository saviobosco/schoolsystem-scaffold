<?php
$this->extend('/Common/view');
$this->assign('title','Edit Nationality');
?>
<div>
    <?= $this->Form->create($nationality) ?>
    <fieldset>
        <legend><?= __('Edit Nationality') ?></legend>
        <?php
        echo $this->Form->input('nationality',['type'=>'text']);
        echo $this->Form->input('default_selection',['type'=>'checkbox', 'label' => 'Default (Selected By Default)']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success m-t-20']) ?>
    <?= $this->Form->end() ?>
</div>
