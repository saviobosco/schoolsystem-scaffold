<?php
$this->extend('/Common/view');
$this->assign('title','Application Update');
?>
<?= $this->Form->create(null, [
    'enctype' => 'multipart/form-data'
]); ?>
<?= $this->form->input('file',['type'=>'file','label'=>'Application Update File']) ?>
<?= $this->Form->submit(__('Upload'),['class'=>'btn btn-primary btn-sm m-b-10']) ?>