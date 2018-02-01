<?php
/**
 * @var \App\View\AppView $this
 */
$this->extend('/Common/view');
$this->assign('title','Add Class');
?>
<?= $this->Form->create($class) ?>
    <fieldset>
        <legend><?= __('Add Class') ?></legend>
        <?php
        echo $this->Form->control('class');
        echo $this->Form->control('block_id');
        echo $this->Form->control('no_of_subjects',['label'=>['text'=>'No of Subjects Offered']]);
        ?>
    </fieldset>
<?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary']) ?>
<?= $this->Form->end() ?>