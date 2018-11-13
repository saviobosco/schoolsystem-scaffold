<?php
/**
 * @var \App\View\AppView $this
 */
$this->extend('/Common/view');
$this->assign('title','Students Class Count');
$templates = [
    'label' => '',
    'submitContainer' => '{{content}}'
];
$this->Form->setTemplates($templates);
$queryData = $this->request->getQuery();


?>
<?= $this->element('searchParametersSessionClassTerm'); ?>

<?php if(! empty($queryData)): ?>
<?= $this->Form->create($studentClassCount,['method'=>'POST']) ?>
    <fieldset>
        <legend><?= __('Students Class Count') ?></legend>
        <?= $this->Form->control('student_count') ?>
        <?= $this->Form->hidden('class_id',['value' => @$queryData['class_id']]) ?>
        <?= $this->Form->hidden('term_id',['value' => @$queryData['term_id']]) ?>
        <?= $this->Form->hidden('session_id',['value' => @$queryData['session_id']]) ?>
    </fieldset>
<?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary']) ?>
<?= $this->Form->end() ?>
<?php else : ?>
    <?= $this->element('selectParameters') ?>
<?php endif; ?>
