<?php

$this->layout = 'result';
$edittemplates = [
    'submitContainer' => '{{content}}'
];
$this->Form->templates($edittemplates);
$this->assign('title', ( !empty($this->request->getQuery()) ) ? $sessions[$this->request->query['session_id']].' > '.$classes[$this->request->query['class_id']].' > '.$terms[$this->request->query['term_id']].' Result' : 'Please select a parameter');
?>
<div style="width: 900px;
    border: 1px solid black;
    margin-top: 20px;
    margin-bottom: 20px;
    padding-top: 20px;
    padding-bottom: 20px;" class="container-fluid m-t-20">
    <?= $this->element('searchParametersSessionClassTerm') ?>

    <?php if ( isset($student) ) : ?>
        <?= $this->element('ResultSystem.StudentResult/Shared/is_published') ?>
    <div class="row banner-image m-b-15 m-t-20 ">
        <div class="col-sm-10">
            <?= $this->element('image_banner') ?>
        </div>
        <div class="col-sm-2">
            <div class="profile-picture">
                <?= $this->Html->image('student-photos/'.$student['id'] . '.jpg',['alt' => $student['id']]) ?>
            </div>
        </div>
    </div>
    <h5 class="text-center m-t-10" style="text-decoration: underline;font-weight: 700"> Student Termly Result </h5>
    <div class="row m-t-5">
        <div class="col-sm-6">
            <?= $this->element('ResultSystem.StudentResult/Shared/student_detail_panel',[
                'session_id' => $this->request->query['session_id'],
                'class_id' => $this->request->query['class_id'],
                'term_id' => $this->request->query['term_id']
            ]) ?>
        </div>
        <div class="col-sm-6">
            <?= $this->element('ResultSystem.StudentResult/TermlyResult/result_detail') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9">

            <?= $this->element('ResultSystem.StudentResult/TermlyResult/termly_result') ?>
            <?= $this->cell('ResultSystem.ResultGrades') ?>

            <?= $this->element('ResultSystem.StudentResult/Shared/result_remarks') ?>

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

    <?php if ( empty($this->request->getQuery())) : ?>
        <div class="alert alert-danger"> <p> Please select the Term , Class and Session </p> </div>
    <?php endif; ?>
</div>