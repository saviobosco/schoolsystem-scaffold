<?php
/**
 * @var \App\View\AppView $this
 */
$this->extend('/Common/view');
$this->assign('title','Edit Payment Type');
?>
<?= $this->Form->create($paymentType) ?>
    <fieldset>
        <legend><?= __('Edit Payment Type') ?></legend>
        <?php
        echo $this->Form->control('type');
        ?>
    </fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>