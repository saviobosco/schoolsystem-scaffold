<?php
$this->assign('title', 'Teacher: View Students Results');
//$this->extend('/Common/view');
$formTemplates = [
    'submitContainer' => '{{content}}'
];
$this->Form->templates($formTemplates);
$queryData = $this->request->getQuery();
?>

<div class="row">
    <div class="col-sm-12">
        <?= $this->Form->create('',['class'=>'form-inline','type'=>'GET']) ?>
        <div class="form-group">
            <?= $this->Form->input('subject_id',['options' => $subjects,'class'=>'form-control','data-select-id'=>'subject','label'=>['text'=>'Subject '],'value'=>(isset($queryData['subject_id']) && !empty($queryData['subject_id'])) ? $queryData['subject_id'] : 1]); ?>
            <?= $this->Form->input('session_id',['options' => $sessions,'class'=>'form-control','data-select-id'=>'school','label'=>['text'=>'Session '],'value'=>(isset($queryData['session_id']) && !empty($queryData['session_id'])) ? $queryData['session_id'] : 1]); ?>
            <?= $this->Form->hidden('class_id',['value'=>(isset($queryData['class_id']) && !empty($queryData['class_id'])) ? $queryData['class_id'] : '']); ?>
            <?= $this->Form->input('term_id',['options' => $terms,'class'=>'form-control','data-select-id'=>'level','label'=>['text'=>'Term'],'value'=>(isset($queryData['term_id']) && !empty($queryData['term_id'])) ? $queryData['term_id'] : 1]); ?>
            <?= $this->Form->submit(__('change'),['class'=>'btn btn-primary']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>