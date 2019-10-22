<?php
$this->extend('/Common/view');
$this->assign('title','Upload School Logo');
?>
<?php if(!empty($file)) : ?>
    <div>
        <?=  $this->Html->image('schools/'.Cake\Core\Configure::read('sub_domain').'/'.$file[0],['class'=>'img-responsive']) ?>
    </div>
<?php endif; ?>
    <p> Upload the school Logo</p>
<?= $this->Form->create(null, [
    'url'=>[
        'action'=>'uploadSchoolLogo'
    ],
    'enctype' => 'multipart/form-data'
]); ?>

<?= $this->form->input('logo',['type'=>'file']) ?>
<?= $this->Form->submit(__('Upload'),['class'=>'btn btn-primary btn-sm m-b-10']) ?>