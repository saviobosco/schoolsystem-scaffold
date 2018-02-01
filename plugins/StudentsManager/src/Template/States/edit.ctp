<?php
/**
 * @var \App\View\AppView $this
 */
$this->extend('/Common/view');
$this->assign('title','Edit State');
?>
<?= $this->Form->create($state) ?>
<fieldset>
    <legend><?= __('Edit State') ?></legend>
    <?php
    echo $this->Form->control('state');
    ?>
</fieldset>
<?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary']) ?>
<?= $this->Form->end() ?>
