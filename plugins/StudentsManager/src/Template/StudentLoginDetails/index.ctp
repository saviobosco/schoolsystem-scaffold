<?= $this->Form->create($studentLoginDetail,['url'=>[
    'controller'=>'StudentLoginDetails',
    'action'=>'update', $id
],'type'=>'POST','role'=>'form', 'target' => 'change-student-login-detail-view']) ?>

<?= $this->Form->control('username') ?>
<?= $this->Form->control('password',['value' => '',
    'class'=>'form-control']); ?>
<?= $this->Form->button(__('Update'),['type'=>'submit','class'=>'btn btn-primary','escape'=>false]) ?>
<?= $this->Form->end() ?>

<hr>
<?php if(!$studentLoginDetail->isNew()) : ?>
<p> Deactivate Account</p>
<?= $this->Form->create($studentLoginDetail,['url'=>[
    'controller'=>'StudentLoginDetails',
    'action'=>'accountStatus', $id
],'type'=>'POST','role'=>'form', 'target' => 'change-student-login-detail-view']) ?>
<?= $this->Form->control('status', ['options' => [1 => 'Active', 0 => 'Unactive']]) ?>
<?= $this->Form->button(__('Update'),['type'=>'submit','class'=>'btn btn-primary','escape'=>false]) ?>
<?php endif; ?>