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
        echo $this->Form->control('class', ['type' => 'text']);
        echo $this->Form->control('block_id');
        echo $this->Form->control('sort_order',['label'=>'Sort Order']);
        echo $this->Form->control('next_grade',['options' => $classes, 'empty' => 'Select Next Class', 'label'=>'Next grade']);
        ?>
    </fieldset>
<?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary m-t-30']) ?>
<?= $this->Form->end() ?>