<?php
/**
 * @var \App\View\AppView $this
 */
$this->extend('/Common/view');
$this->assign('title','Add Payment Type');
?>
<?= $this->Form->create($paymentType) ?>
    <fieldset>
        <legend><?= __('Add Payment Type') ?></legend>
        <?php
        echo $this->Form->control('type');
        ?>
    </fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>