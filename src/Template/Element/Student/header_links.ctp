<?php
$queryData = $this->request->getQuery();
?>
<div class="m-t-10 m-b-10">
    <?= $this->Html->link('<i class="fa fa-users"> </i> All Student',['plugin'=>($this->request->params['plugin']) ? $this->request->params['plugin'] : null ,'controller'=>'Students','action' => 'index',],['class'=>'p-r-15','escape' => false]) ?>
    <?= $this->Html->link('<i class="fa fa-edit"> </i> Edit Student Profile',['plugin'=>($this->request->params['plugin']) ? $this->request->params['plugin'] : null ,'controller'=>'Students','action' => 'edit', $student->id],['class'=>'p-r-15','escape' => false]) ?>
    <?= $this->Html->link('<i class="fa fa-plus"> </i> Add Student Result',['plugin'=>'ResultSystem' ,'controller'=>'Students','action' => 'addResult', $student->id,'?'=>$queryData],['class'=>'p-r-15','escape' => false]) ?>
    <?= $this->Html->link('<i class="fa fa-book"> </i> Edit Student Result',['plugin'=>'ResultSystem' ,'controller'=>'Students','action' => 'edit', $student->id,'?'=>$queryData],['class'=>'p-r-15','escape' => false]) ?>
    <?= $this->Html->link('<i class="fa fa-eye"> </i> View Student Result',['plugin'=>'ResultSystem' ,'controller'=>'Students','action' => 'view', $student->id,'?'=>$queryData],['class'=>'p-r-15','escape' => false]) ?>
    <?= $this->Html->link('<i class="fa fa-book"> </i> Edit Student Skills',['plugin'=>'SkillsGradingSystem' ,'controller'=>'Students','action' => 'edit', $student->id,'?'=>$queryData],['class'=>'p-r-15','escape' => false]) ?>
    <?= $this->Html->link('<i class="fa fa-eye"> </i> View Student Skills',['plugin'=>'SkillsGradingSystem','controller'=>'Students','action' => 'view', $student->id,'?'=>$queryData],['class'=>'p-r-15','escape' => false]) ?>
    <?= $this->Form->postLink(__('<i class="fa fa-close"> </i> Delete Student'), ['plugin'=>($this->request->params['plugin']) ? $this->request->params['plugin'] : null ,'controller'=>'Students', 'action' => 'delete', $student->id], ['confirm' => __('Are you sure you want to delete # {0}?', $student->id),'class'=>'text-danger','escape' => false]) ?>
</div>