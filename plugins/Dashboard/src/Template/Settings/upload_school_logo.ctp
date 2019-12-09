<?php
use Settings\Core\Setting;

$this->extend('/Common/view');
$this->assign('title','Upload School Logo');
?>

<?=  @$this->Html->image($schoolLogo['value'],['class'=>'img-responsive']) ?>

    <p> Upload the school Logo</p>
<?= $this->Form->create(null, [
    'url'=>[
        'action'=>'uploadSchoolLogo'
    ],
    'enctype' => 'multipart/form-data'
]); ?>

<?= $this->form->input('logo',['type'=>'file']) ?>
<?= $this->Form->submit(__('Upload'),['class'=>'btn btn-primary btn-sm m-b-10']) ?>