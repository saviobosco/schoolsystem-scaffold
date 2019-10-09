<?php
$this->extend('/Common/view');
$this->assign('title','Edit Religion');
?>
<div>
    <?= $this->Form->create($religion) ?>
    <fieldset>
        <legend><?= __('Edit Religion') ?></legend>
        <?php
        echo $this->Form->input('religion',['type'=>'text']);
        echo $this->Form->input('default_selection',['type'=>'checkbox', 'label' => 'Default (Selected By Default)']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success m-t-20']) ?>
    <?= $this->Form->end() ?>
</div>
