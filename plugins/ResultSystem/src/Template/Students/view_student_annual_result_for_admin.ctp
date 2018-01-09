<?php

$this->layout = 'result';
$edittemplates = [
    'submitContainer' => '{{content}}'
];
$this->Form->templates($edittemplates);
$this->assign('title',$sessions[$this->request->query['session_id']].' '.$terms[1].' Result');
?>

<div class="container-fluid m-t-20">

    <?php
    if ( is_null($studentResultPublishStatus) || $studentResultPublishStatus->status === 0 ) {

    // end the execution here and return
    echo '<h2 class="text-center"> This Result has not yet been published  </h2>';
    }
    ?>

    <?php
    // including the search parameter element if the Student.term_id session is 3
    echo $this->element('searchParametersSessionClassTerm');
    ?>


    <div class="row banner-image m-b-15 m-t-20 ">
        <div class="col-sm-10">
            <?= $this->Html->image('result-banner.png') ?>
        </div>
        <div class="col-sm-2">
            <div class="profile-picture">
                <?= $this->Html->image('student-pictures/students/photo/'.$student->photo_dir.'/'.$student->photo,['alt' => $student->id]) ?>
            </div>
        </div>
    </div>
    <h5 class="text-center m-t-10 m-b-10" style="text-decoration: underline;font-weight: 700"> Student Annual Result </h5>
    <div class="row m-t-5">
        <div class="col-sm-6">
            <div>
                <table class="table result-details-table">
                    <tbody>
                    <tr>
                        <th> Name</th>
                        <td colspan="4" class="name"> <?= $student->full_name ?></td>
                    </tr>
                    <tr>
                        <th>
                            Admission No
                        </th>
                        <td colspan="4" class="f">
                            <?= $student->id ?>
                        </td>
                    </tr>
                    <tr>
                        <th><?= __('Term') ?></th>
                        <td colspan="2"><?= ucfirst($terms[@$this->SearchParameter->getDefaultValue($this->request->query['term_id'],$this->request->session()->read('Student.term_id'))]) ?></td>
                        <th><?= __('Session') ?></th>
                        <td colspan=""><?= h($sessions[@$this->SearchParameter->getDefaultValue($this->request->query['session_id'],1)]) ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-sm-6">
            <table class="table result-details-table ">

                <?php if (!empty( $studentPosition )): ?>
                    <tr>
                        <th> <?= __('Position') ?> </th>
                        <td><?= $this->Position->formatPositionOutput($studentPosition->position)?> </td>
                        <th><?= __('Out of') ?></th>
                        <td><?= h(@$studentsCount->student_count) ?></td>
                    </tr>
                    <tr>
                        <th> <?= __('Total') ?></th>
                        <td> <?= $studentPosition->total ?></td>
                        <th><?= __('average') ?></th>
                        <td><?= h($studentPosition->average) ?></td>
                    </tr>

                    <tr>
                        <th> <?= __('Grade') ?></th>
                        <td> <?= $studentPosition->grade ?></td>
                        <th><?= __('Next term begins') ?></th>
                        <td><?= $this->Result->nextTermDate(@$nextTerm->start_date) ?></td>
                    </tr>
                    <tr>
                        <th>
                            Promoted
                        </th>
                        <td>
                            <?= ($studentPosition->promoted === null OR $studentPosition->promoted == 0 ) ? 'No' : 'Yes' ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>

    </div>


    <div class="row ">
        <div class="col-sm-9">

            <div class="row">
                <div class="col-sm-12">
                    <?php if (!empty($student->student_annual_results)): ?>
                        <table class="table table-bordered table-responsive table-result ">
                            <thead>
                            <tr class="bigger-height" >
                                <th><?= __('Subject') ?></th>
                                <th><div><p style="margin-left: -5px;"><?= __('First Term') ?></p></div></th>
                                <th><div><p style="margin-left: -15px;"><?= __('Second Term') ?></p></div></th>
                                <th><div><p style="margin-left: -5px;"><?= __('Third Term') ?></p></div></th>
                                <th><div><p><?= __('Total') ?></p></div></th>
                                <th><div><p><?= __('Average') ?></p></div></th>
                                <th><div><p><?= __('Grade') ?></p></div></th>
                                <th><div><p><?= __('Remark') ?></p></div></th>
                                <th><div><p><?= __('Position') ?></p></div></th>
                            </tr>
                            </thead>
                            <?php foreach ($student->student_annual_results as $studentAnnualResults): ?>
                                <tr>
                                    <td><?= h($subjects[$studentAnnualResults->subject_id]) ?></td>
                                    <td><?= h($studentAnnualResults->first_term) ?></td>
                                    <td><?= h($studentAnnualResults->second_term) ?></td>
                                    <td><?= h($studentAnnualResults->third_term) ?></td>
                                    <td><?= h($studentAnnualResults->total) ?></td>
                                    <td><?= h($studentAnnualResults->average) ?></td>
                                    <td><?= h($studentAnnualResults->grade) ?></td>
                                    <td><?= h($studentAnnualResults->remark) ?></td>
                                    <td><?= @$this->Position->formatPositionOutput($studentAnnualSubjectPositions[$studentAnnualResults->subject_id]) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php else: ?>
                        <p class="text-center text-danger" style="font-size: 17px"> Result for this Annual Session is not ready yet, Please try again later </p>
                    <?php endif; ?>

                    <div class="row" style="margin-left: 0px;">
                        <div class="col-sm-9 m-b-20" style="border: 1px solid #000000;">
                            <p class="text-center" style="margin: 10px"> REMARKS</p>
                            <?php foreach($remarkInputs as $remarkKey => $remarkValue) : ?>
                                <div class="remarks">
                                    <div class="actual-remark">
                                        <p> <?= strtoupper($remarkValue) ?>: <?= $studentRemark[$remarkKey] ?> </p>
                                    </div>
                                    <div class="comment-name">
                                        <p>NAME:<?= (isset($resultRemarkDetails[$remarkKey])) ? '&nbsp;'.strtoupper($resultRemarkDetails[$remarkKey]).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'  ?>
                                        </p> <p style="display: inline"> SIGNATURE </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <div class="comment-name">
                                <p>SIGNATURE/STAMP:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="">DATE: </span> </p>
                            </div>

                        </div>
                        <div class="col-sm-3 col-xs-3">
                            <?= $this->Result->displayFees($fees) ?>
                        </div>

                    </div>




                </div>
            </div>


        </div>

        <div class="col-sm-3">
            <div class="row">

                <!-- affective skills col -->
                <div class="col-sm-12">
                    <?php if (!empty($studentAffectiveDispositions)): ?>
                        <table class=" table-skill-score m-b-10 table-bordered table-responsive">
                            <thead>
                            <tr>
                                <th colspan="2" class="p-5">
                                    <p class="text-center" style="text-decoration: underline"> Keys </p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p> 5 - excellent </p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p> 4 - very good </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p> 3 - good </p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p> 2 - pass </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p class="text-center"> 1 - fail </p>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>Affective Disposition</th>
                                <th>Score</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($studentAffectiveDispositions as $studentAffectiveDisposition): ?>
                                <tr>
                                    <td> <?= h($studentAffectiveDisposition->affective->name)?></td>
                                    <td> <?= h($studentAffectiveDisposition->score)?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    <?php endif; ?>

                    <?php if (!empty($studentPsychomotorSkills)): ?>
                        <table class="table-skill-score m-b-10 table-bordered table-responsive table-result">
                            <thead>
                            <tr>
                                <th>
                                    Psychomotor Skills</th>
                                <th>Score</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($studentPsychomotorSkills as $studentPsychomotorSkill): ?>
                                <tr>
                                    <td> <?= h($studentPsychomotorSkill->psychomotor->name)?></td>
                                    <td> <?= h($studentPsychomotorSkill->score)?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
                <!-- end of affective col -->
            </div>
        </div>
    </div>

</div>

