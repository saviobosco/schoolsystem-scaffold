<?php
// including the search parameter element
echo $this->element('searchParametersSessionClassTerm');
?>

<div class="row m-t-20">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= h($subject->name) ?> </h4>
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-bordered">
                    <tr>
                        <th><?= __('Block') ?></th>
                        <td><?= $subject->block->name ?></td>
                    </tr>
                </table>

                <div class="related">
                    <h4><?= __(' Student Termly Results') ?></h4>
                    <?php if (!empty($subject->student_termly_results)): ?>
                        <table id="data-table" class="table table-bordered table-responsive">
                            <thead>
                            <tr>
                                <th><?= __('Student Id') ?></th>
                                <th><?= __('Name') ?></th>
                                <?php foreach( $gradeInputs as $gradeInput ): ?>
                                    <th> <?= __($gradeInput) ?> </th>
                                <?php endforeach; ?>
                                <th><?= __('Total') ?></th>
                                <th><?= __('Grade') ?></th>
                                <th><?= __('Remark') ?></th>
                                <th><?= __('Position') ?></th>
                                <th><?= __('Actions') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($subject->student_termly_results as $studentTermlyResults): ?>
                                <tr>
                                    <td><?= h($studentTermlyResults->student_id) ?></td>
                                    <td><?= h($studentTermlyResults->student->full_name) ?></td>
                                    <?php foreach( $gradeInputs as $key => $value ) : ?>
                                        <td><?= h($studentTermlyResults->$key) ?></td>
                                    <?php endforeach; ?>
                                    <td><?= h($studentTermlyResults->total) ?></td>
                                    <td><?= h($studentTermlyResults->grade) ?></td>
                                    <td><?= h($studentTermlyResults->remark) ?></td>
                                    <td><?= @$this->Position->formatPositionOutput($subjectStudentPositions[$studentTermlyResults->student_id]) ?></td>
                                    <td><?= $this->Form->postLink(__('Delete'),
                                            ['plugin'=>'ResultSystem',
                                            'action' => 'deleteSubjectResultRow', $studentTermlyResults->id,
                                            '?'=>$this->request->getQuery()
                                            ],
                                            ['confirm' => __('Are you sure you want to delete this student subject score ?')]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>