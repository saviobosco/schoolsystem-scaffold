<?php
$getQuery = $this->request->getQuery();
$this->layout = 'result';
$edittemplates = [
    'submitContainer' => '{{content}}'
];
$this->Form->templates($edittemplates);
$this->assign('title', ( !empty($this->request->getQuery()) ) ? $sessions[$this->request->query['session_id']].' > '.$classes[$this->request->query['class_id']].' > '.$terms[$this->request->query['term_id']].' Result' : 'Please select a parameter');

?>
<div class="container-fluid">
    <?= $this->element('searchParametersSessionClassTerm') ?>
    <?php if ( empty($getQuery)) : ?>
        <div class="alert alert-danger"> <p> Please select the Term , Class and Session </p> </div>
    <?php endif; ?>

    <?php if (isset($studentsResults)) : ?>

        <?php foreach ( $studentsResults as $studentResult ) : ?>

            <div class="student_result m-t-20" style="margin: 100px 100px">
                <?= $this->element('ResultSystem.StudentResult/Shared/is_published',[
                    'studentResultPublishStatus' => $studentResult['studentResultPublishStatus']
                ]) ?>
                <div class="row banner-image m-b-15 m-t-20 ">
                    <div class="col-sm-10">
                        <?php /* $this->Html->image('result-banner.png')*/ ?>
                    </div>
                    <div class="col-sm-2">
                        <div class="profile-picture">
                            <?= $this->Html->image('student-pictures/students/photo/'.$studentResult['studentDetails']['photo_dir'].'/'.$studentResult['studentDetails']['photo'],['alt' => $studentResult['studentDetails']['id']]) ?>
                        </div>
                    </div>
                </div>
                <h5 class="text-center m-t-10" style="text-decoration: underline;font-weight: 700"> Student Termly Result </h5>
                <div class="row m-t-5">
                    <div class="col-sm-6">
                        <?= $this->element('ResultSystem.StudentResult/Shared/student_detail_panel',[
                            'student' => $studentResult['studentDetails']
                        ]) ?>
                    </div>
                    <div class="col-sm-6">
                        <?php if (4 === (int)$getQuery['term_id']) : ?>
                            <?= $this->element('ResultSystem.StudentResult/AnnualResult/result_detail',[
                                'studentPosition' => $studentResult['studentPosition']
                            ]) ?>
                        <?php else : ?>
                            <?= $this->element('ResultSystem.StudentResult/TermlyResult/result_detail',[
                                'studentPosition' => $studentResult['studentPosition']
                            ]) ?>
                        <?php endif; ?>

                    </div>
                </div>
                <div class="row ">
                    <div class="col-sm-9">

                        <?php if (4 === (int)$getQuery['term_id']) : ?>
                            <?= $this->element('ResultSystem.StudentResult/AnnualResult/annual_result',[
                                'studentAnnualResults' => $studentResult['studentAnnualResults'],
                                'studentSubjectPositions' => $studentResult['studentSubjectPositions'],
                            ]) ?>
                        <?php else : ?>
                            <?= $this->element('ResultSystem.StudentResult/TermlyResult/termly_result',[
                                'studentTermlyResults' => $studentResult['studentTermlyResults'],
                                'studentSubjectPositions' => $studentResult['studentSubjectPositions'],
                            ]) ?>
                        <?php endif; ?>

                        <?= $this->element('ResultSystem.StudentResult/Shared/result_remarks',[
                            'studentRemark' => $studentResult['studentRemark']
                        ]) ?>
                        <!-- <div class="col-sm-3 col-xs-3">
                    <?php //$this->Result->displayFees($fees) ?>
                </div> -->
                    </div>
                    <div class="col-sm-3">
                        <div class="row">

                            <!-- affective skills col -->
                            <div class="col-sm-12">
                                <?= $this->element('ResultSystem.StudentResult/Shared/affective_disposition_scores',[
                                    'studentAffectiveDispositions' => $studentResult['studentAffectiveDispositions']
                                ]) ?>

                                <?= $this->element('ResultSystem.StudentResult/Shared/psychomotor_skill_scores',[
                                    'studentPsychomotorSkills' => $studentResult['studentPsychomotorSkills']
                                ]) ?>
                            </div>
                            <!-- end of affective col -->
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>

    <?php endif; ?>
</div>


<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>