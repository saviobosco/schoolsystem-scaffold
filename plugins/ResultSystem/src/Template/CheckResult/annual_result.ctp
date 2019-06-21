<?php

$this->layout = 'result';
$formTemplates = [
    'submitContainer' => '{{content}}'
];
$queryData = $this->request->getQuery();
$this->Form->templates($formTemplates);
$this->assign('title',$sessions[$this->request->query['session_id']].' '.$terms[$this->request->query['term_id']].' Result');
?>

<div style="width: 900px;
    border: 1px solid black;
    margin-top: 20px;
    margin-bottom: 20px;
    padding-top: 20px;
    padding-bottom: 20px;" class="container-fluid m-t-20">
    <div class="row">
        <div class="col-sm-12">
            <?= $this->Form->create('',['class'=>'form-inline','type'=>'GET']) ?>
            <div class="form-group">
                <?= $this->Form->input('id',[ 'type' => 'hidden', 'value'=>(isset($queryData['id']) && !empty($queryData['id'])) ? $queryData['id'] : '']); ?>
                <?= $this->Form->input('ts',[ 'type' => 'hidden', 'value'=>(isset($queryData['ts']) && !empty($queryData['ts'])) ? $queryData['ts'] : '']); ?>
                <?= $this->Form->input('session_id',[ 'type' => 'hidden', 'value'=>(isset($queryData['session_id']) && !empty($queryData['session_id'])) ? $queryData['session_id'] : '']); ?>
                <?= $this->Form->input('class_id',[ 'type' => 'hidden', 'value'=>(isset($queryData['class_id']) && !empty($queryData['class_id'])) ? $queryData['class_id'] : '']); ?>
                <?= $this->Form->input('term_id',['options' => [3 => 'Third Term', 4 => 'Annual'],'class'=>'form-control','data-select-id'=>'level','label'=>['text'=>'Term'],'value'=>(isset($queryData['term_id']) && !empty($queryData['term_id'])) ? $queryData['term_id'] : 1]); ?>
                <?= $this->Form->submit(__('change'),['class'=>'btn btn-primary']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
    <div class="row banner-image m-b-15 m-t-20">
        <div class="col-sm-10">
            <?= $this->element('image_banner') ?>
        </div>
        <div class="col-sm-2">
            <div class="profile-picture">
                <?= $this->Html->image('student-photos/'.$student['id'] . '.jpg',['alt' => $student['id']]) ?>
            </div>
        </div>
    </div>
    <h5 class="text-center m-t-10 m-b-10" style="text-decoration: underline;font-weight: 700"> Student Annual Result </h5>
    <?php if ( is_null($studentResultPublishStatus) || $studentResultPublishStatus['status'] === 0 ) : ?>
        <h1 style="text-align: center"> This result has not been published. Please contact the school. </h1>
    <?php else : ?>
        <div class="row m-t-5">
            <div class="col-sm-6">
                <?= $this->element('ResultSystem.StudentResult/Shared/student_detail_panel') ?>
            </div>

            <div class="col-sm-6">
                <?= $this->element('ResultSystem.StudentResult/AnnualResult/result_detail') ?>
            </div>

        </div>


        <div class="row ">
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-12">

                        <?= $this->element('ResultSystem.StudentResult/AnnualResult/annual_result') ?>
                        <?= $this->cell('ResultSystem.ResultGrades') ?>

                        <?= $this->element('ResultSystem.StudentResult/Shared/result_remarks') ?>

                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="row">
                    <!-- affective skills col -->
                    <div class="col-sm-12">

                        <?= $this->element('ResultSystem.StudentResult/Shared/affective_disposition_scores') ?>

                        <?= $this->element('ResultSystem.StudentResult/Shared/psychomotor_skill_scores') ?>

                    </div>
                    <!-- end of affective col -->
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>

