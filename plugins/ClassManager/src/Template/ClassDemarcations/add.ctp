<?php
/**
 * @var \App\View\AppView $this
 */
$this->extend('/Common/view');
$this->assign('title','Add Class Demarcation');
?>
<?= $this->Form->create($classDemarcation) ?>
    <fieldset>
        <legend><?= __('Add Class Division ') ?></legend>
        <?php
        echo $this->Form->control('name');
        echo $this->Form->control('class_id', ['options' => $classes]);
        echo $this->Form->control('capacity',['label' => ['text' => 'Class In-take Capacity']]);
        ?>
    </fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>