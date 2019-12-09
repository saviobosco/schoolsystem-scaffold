<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Student[]|\Cake\Collection\CollectionInterface $students
 */

$formTemplates = [
    'submitContainer' => '{{content}}'
];
$this->Form->setTemplates($formTemplates);
$this->extend('/Common/view');
$this->assign('title','Generate Students Login');
?>
<div class="alert alert-info">
    <p> Note: This is a heavy operation, might take some time. </p>
</div>
<?= $this->Form->create() ?>
<?= $this->Form->control('class_id', ['options' => $classes]) ?>
<?= $this->Form->control('username_field', ['options' => [
    'first_name' => 'First Name',
    'last_name' => 'Last Name',
    'id' => 'Admission Number'
]]) ?>
<?= $this->Form->control('password_field', ['options' => [
    'id' => 'Admission Number',
    'first_name' => 'First Name',
    'last_name' => 'Last Name'
]]) ?>
<div class="form-group">
    <label for="overwrite_credentials">
        <input id="overwrite_credentials" type="checkbox" name="overwrite_credentials"> overwrite students with login credentials
    </label>
</div>
<?= $this->Form->submit(__('Submit'),[
    'class'=>'btn btn-primary'
]) ?>
<?= $this->Form->end() ?>