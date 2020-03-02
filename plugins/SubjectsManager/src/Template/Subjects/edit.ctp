<?php
/**
 * @var \App\View\AppView $this
 */
$this->extend('/Common/view');
$this->assign('title', 'Add subject');
?>

<?= $this->Form->create($subject) ?>
<fieldset>
    <legend><?= __('Edit Subject') ?></legend>
    <?php
    echo $this->Form->control('name');
    echo $this->Form->control('block_id', ['options' => $blocks]);
    ?>
</fieldset>
<?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary']) ?>
<?= $this->Form->end() ?>
