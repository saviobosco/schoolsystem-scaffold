<?php
$this->extend('/Common/view');
$this->assign('title','Edit Student Type');
?>
<div>
    <?= $this->Form->create($studentType) ?>
    <fieldset>
        <legend><?= __('Edit Student Type') ?></legend>
        <?php
        echo $this->Form->input('name',['type'=>'text']);
        echo $this->Form->input('default_selection',['type'=>'checkbox', 'label' => 'Default (Selected By Default)']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success m-t-20']) ?>
    <?= $this->Form->end() ?>
</div>
