<?php
$queryData = $this->request->getQuery();
?>
<div class="m-t-10 m-b-10">
    <?= $this->Html->link('<i class="fa fa-users"> </i> All Student',['plugin'=>'ResultSystem','controller'=>'Students','action' => 'index',],['class'=>'p-r-15','escape' => false]) ?>
    <?= $this->Html->link('<i class="fa fa-plus"> </i> Add Student Result',['plugin'=>'ResultSystem' ,'controller'=>'Students','action' => 'add', $student->id,'?'=>$queryData],['class'=>'p-r-15','escape' => false]) ?>
    <?= $this->Html->link('<i class="fa fa-book"> </i> Edit Student Result',['plugin'=>'ResultSystem' ,'controller'=>'Students','action' => 'edit', $student->id,'?'=>$queryData],['class'=>'p-r-15','escape' => false]) ?>
    <?= $this->Html->link('<i class="fa fa-eye"> </i> View Student Result',['plugin'=>'ResultSystem' ,'controller'=>'Students','action' => 'view', $student->id,'?'=>$queryData],['class'=>'p-r-15','escape' => false]) ?>
    <?= $this->Html->link('<i class="fa fa-book"> </i> Edit Student Skills',['plugin'=>'SkillsGradingSystem' ,'controller'=>'Students','action' => 'edit', $student->id,'?'=>$queryData],['class'=>'p-r-15','escape' => false]) ?>
    <?= $this->Html->link('<i class="fa fa-eye"> </i> View Student Skills',['plugin'=>'SkillsGradingSystem','controller'=>'Students','action' => 'view', $student->id,'?'=>$queryData],['class'=>'p-r-15','escape' => false]) ?>
    <?= $this->Html->link('<i class="fa fa-print"> </i> View Result Format',['plugin'=>'ResultSystem','controller'=>'Students','action' => 'viewStudentResultForAdmin', $student->id,'?'=>$queryData],['class'=>'p-r-15','escape' => false]) ?>
</div>