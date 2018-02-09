<?php
/**
 * @var \App\View\AppView $this
 */
$this->extend('/Common/view');
$this->assign('title','Add Account');
?>
<?= $this->Form->create($accountHolder) ?>
<fieldset>
    <legend><?= __('Add Account Holder') ?></legend>
    <?php
    echo $this->Form->control('first_name');
    echo $this->Form->control('last_name');
    echo $this->Form->control('account_number');
    echo $this->Form->control('account_type_id', ['options' => $accountTypes, 'empty' => true]);
    echo $this->Form->control('student_id', ['options' => $students, 'empty' => true]);
    echo $this->Form->control('status');
    ?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
