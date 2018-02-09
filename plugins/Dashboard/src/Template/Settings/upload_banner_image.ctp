<?php
$this->extend('/Common/view');
$this->assign('title','Upload Banner Image');
?>
<?php if(!empty($file)) : ?>
    <div>
        <?=  $this->Html->image($file[0],['class'=>'img-responsive']) ?>
    </div>
<?php endif; ?>
    <p> Upload the school Image Banner</p>
<?= $this->Form->create(null, [
    'url'=>[
        'action'=>'uploadBannerImage'
    ],
    'enctype' => 'multipart/form-data'
]); ?>

<?= $this->form->input('banner',['type'=>'file']) ?>
<?= $this->Form->submit(__('Upload'),['class'=>'btn btn-primary btn-sm m-b-10']) ?>