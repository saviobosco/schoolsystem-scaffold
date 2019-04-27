<?php
use Settings\Core\Setting;
$this->extend('/Common/view');
$this->assign('title','Upload Banner Image');
?>
    <div>
        <?=  $this->Html->image(Setting::read('Application.image_banner'),['class'=>'img-responsive']) ?>
    </div>
    <p> Upload the school Image Banner</p>
<?= $this->Form->create(null, [
    'url'=>[
        'action'=>'uploadBannerImage'
    ],
    'enctype' => 'multipart/form-data'
]); ?>

<?= $this->form->input('banner',['type'=>'file']) ?>
<?= $this->Form->submit(__('Upload'),['class'=>'btn btn-primary btn-sm m-b-10']) ?>