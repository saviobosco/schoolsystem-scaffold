<?php
$edittemplates = [
    'submitContainer' => '{{content}}'
];
$this->Form->templates($edittemplates);

?>
<div class="row">
    <div class="col-sm-12">
        <?= $this->Form->create('',['class'=>'form-inline','type'=>'GET']) ?>
        <div class="form-group">
            <?= $this->Form->input('class_id',['empty' => 'all Classes', 'options' => $classes,'class'=>'form-control','label'=>['text'=>'Change Class'],'value'=>@$this->SearchParameter->getDefaultValue($this->request->query['class_id'])]); ?>
            <?= $this->Form->input(__('change'),['class'=>'btn btn-primary','type' => 'submit',
                'templates' => [
                    'submitContainer' => '{{content}}'
                ]
            ]) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>