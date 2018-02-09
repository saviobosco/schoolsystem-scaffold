<?php
/**
 * @var \App\View\AppView $this
 */
$this->extend('/Common/view');
$this->assign('title','Edit Class Demarcation');
?>
<?= $this->Form->create($classDemarcation) ?>
    <fieldset>
        <?php
        echo $this->Form->control('name');
        echo $this->Form->control('class_id', ['options' => $classes]);
        echo $this->Form->control('capacity',['label' => ['text' => 'Class In-take Capacity']]);
        ?>
    </fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>