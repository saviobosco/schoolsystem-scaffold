<?php
$edittemplates = [
    'submitContainer' => '{{content}}'
];
$this->Form->templates($edittemplates);
$queryData = $this->request->getData();
?>
<div class="row">
    <div class="col-sm-12">
        <?= $this->Form->create('',['class'=>'form-inline','type'=>'GET']) ?>
        <div class="form-group">
            <?= $this->Form->input('class_id',['empty' => 'all Classes', 'options' => $classes,'class'=>'form-control','label'=>['text'=>'Change Class'],'value'=>(isset($queryData['class_id']) && !empty($queryData['class_id'])) ? $queryData['class_id'] : 1]); ?>
            <?= $this->Form->input(__('change'),['class'=>'btn btn-primary','type' => 'submit',
                'templates' => [
                    'submitContainer' => '{{content}}'
                ]
            ]) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>