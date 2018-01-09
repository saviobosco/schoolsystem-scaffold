<?php
$edittemplates = [
    'submitContainer' => '{{content}}'
];
$this->Form->templates($edittemplates);

?>

<?php
// including the search parameter element
echo $this->element('searchParametersSessionClassTerm');
?>

<div class="row m-t-30">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> View Student Student </h4>
            </div>
            <div class="panel-body">
                <?= $this->element('Student/header_links') ?>

                <div class="row">
                    <div class="col-sm-2">
                        <div class="profile-picture">
                            <?= $this->Html->image('student-pictures/students/photo/'.$student->photo_dir.'/'.$student->photo,['alt' => $student->id,'width' => '150px']) ?>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <table class="table table-bordered">
                            <tr>
                                <th><?= __('Name') ?></th>
                                <td><?= h($student->full_name) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Admission No.') ?></th>
                                <td><?= h($student->id) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Class') ?></th>
                                <td><?= h($student->class->class) ?></td>
                            </tr>
                        </table>

                    </div>
                    <!-- begin of second col-sm-5 -->
                    <div class="col-sm-5">
                        <table class="table table-bordered">
                            <tr>
                                <th><?= __('Term') ?></th>
                                <td><?= h(@$terms[$this->request->query['term_id']]) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Session') ?></th>
                                <td><?= h(@$sessions[$this->request->query['session_id']]) ?></td>
                            </tr>
                            <?php if (!empty( $studentPosition )): ?>
                                <tr>
                                    <td> <?= __('Total') ?></td>
                                    <td> <?= $studentPosition->total ?></td>
                                </tr>
                                <tr>
                                    <td> <?= __('Average') ?> </td>
                                    <td><?= $studentPosition->average?> </td>
                                </tr>
                                <tr>
                                    <td> <?= __('Position') ?> </td>
                                    <td><?= $this->Position->formatPositionOutput($studentPosition->position)?> </td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                    <!-- end of second col-sm-6 -->
                </div>

                <div class="related">
                    <?php if (!empty($student->student_termly_results)): ?>
                        <table class="table table-responsive table-bordered">
                            <tr>
                                <th><?= __('Subject') ?></th>
                                <?php foreach( $gradeInputs as $gradeInput ): ?>
                                    <th> <?= __($gradeInput) ?> </th>
                                <?php endforeach; ?>
                                <th><?= __('Total') ?></th>
                                <th><?= __('Grade') ?></th>
                                <th><?= __('Remark') ?></th>
                                <th><?= __('Position') ?></th>
                                <th><?= __('Action') ?></th>
                                <!-- <th><?= __('Position on class Demarcation') ?></th> -->

                            </tr>
                            <?php for ($num = 0 ; $num < count($student->student_termly_results) ; $num++ ): ?>
                                <tr>
                                    <td><?= h($subjects[$student->student_termly_results[$num]['subject_id']]) ?></td>
                                    <?php foreach( $gradeInputs as $key => $value ) : ?>
                                    <td><?= h($student->student_termly_results[$num][$key]) ?></td>
                                    <?php endforeach; ?>
                                    <td><?= h($student->student_termly_results[$num]['total']) ?></td>
                                    <td><?= h($student->student_termly_results[$num]['grade']) ?></td>
                                    <td><?= h($student->student_termly_results[$num]['remark']) ?></td>
                                    <td><?= @$this->Position->formatPositionOutput($studentSubjectPositions[$student->student_termly_results[$num]['subject_id']])?></td>
                                    <td><?= $this->Form->postLink(__('Delete'), ['action' => 'deleteStudentResultRow', $student->student_termly_results[$num]['id'],'?'=>$this->request->getQuery()], ['confirm' => __('Are you sure you want to delete this subject score ?')]) ?> </td>
                                </tr>
                            <?php endfor; ?>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
