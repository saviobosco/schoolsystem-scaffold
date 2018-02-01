<?php
$edittemplates = [
    'submitContainer' => '{{content}}'
];
$this->Form->templates($edittemplates);
$queryData = $this->request->getQuery();
?>

<?php
// including the search parameter element
echo $this->element('searchParametersSessionClassTerm');
?>

<div class="row m-t-40 ">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> View Annual Result </h4>
            </div>
            <div class="panel-body">
                <?= $this->element('Student/header_links') ?>
                <div class="row">

                    <!-- start of col-sm-6 -->
                    <div class="col-sm-6">
                        <table class="table table-bordered">
                            <tr>
                                <th><?= __('Full Name') ?></th>
                                <td><?= h($student->full_name) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Admission No') ?></th>
                                <td><?= h($student->id) ?></td>
                            </tr>
                        </table>
                    </div>
                    <!-- end of col-sm-6 -->

                    <!-- start of col-sm-6 -->
                    <div class="col-sm-6">
                        <table class="table table-bordered">
                            <tr>
                                <th><?= __('Term') ?></th>
                                <td><?= h($terms[(isset($this->request->query['term_id']) && !empty($this->request->query['term_id'])) ? $this->request->query['term_id'] : 1 ]) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Session') ?></th>
                                <td><?= h($sessions[(isset($this->request->query['session_id']) && !empty($this->request->query['session_id'])) ? $this->request->query['session_id'] : 1 ]) ?></td>
                            </tr>
                            <?php if (!empty( $studentPosition )): ?>
                                <tr>
                                    <td> <?= __('Position') ?> </td>
                                    <td><?= $this->Position->formatPositionOutput($studentPosition->position)?> </td>
                                </tr>
                                <tr>
                                    <td> <?= __('Total') ?></td>
                                    <td> <?= $studentPosition->total ?></td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                    <!-- end of col-sm-6 -->

                </div>


                <div class="related">
                    <h4><?= __(' Annual Results') ?></h4>
                    <?php if (!empty($student->student_annual_results)): ?>
                        <table class="table table-bordered ">
                            <tr>
                                <th><?= __('Subject') ?></th>
                                <th><?= __('First Term') ?></th>
                                <th><?= __('Second Term') ?></th>
                                <th><?= __('Third Term') ?></th>
                                <th><?= __('Total') ?></th>
                                <th><?= __('Average') ?></th>
                                <th><?= __('Grade') ?></th>
                                <th><?= __('Remark') ?></th>
                                <th><?= __('Position') ?></th>
                                <th><?= __('Action') ?></th>
                            </tr>
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
                                    <td><?= $this->Form->postLink(__('Delete'), ['controller'=>'StudentAnnualResults','action' => 'delete', $studentAnnualResults->id], ['confirm' => __('Are you sure you want to delete this subject score ?')]) ?> </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>
