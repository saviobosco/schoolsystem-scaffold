<?php
$this->extend('/Common/view');
$this->assign('title',$subject->name);
?>
<?= $this->element('searchParametersSessionClassTerm'); ?>
<table class="table table-responsive table-bordered">
    <tr>
        <th><?= __('Block') ?></th>
        <td><?= $subject->block->name ?></td>
    </tr>
</table>

<div class="related">
    <h4><?= __(' Student Termly Results') ?></h4>
    <?php if (isset( $subjectTermlyResults) && !empty($subjectTermlyResults)): ?>
        <table class="table table-bordered table-responsive">
            <thead>
            <tr>
                <th><?= __('Student Id') ?></th>
                <th><?= __('Full Name') ?></th>
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
            <?php foreach ($subjectTermlyResults as $studentTermlyResults): ?>
                <tr>
                    <td><?= h($studentTermlyResults['student_id']) ?></td>
                    <td><?= h($studentTermlyResults['student']['first_name'].' '.$studentTermlyResults['student']['last_name']) ?></td>
                    <?php foreach( $gradeInputs as $key => $value ) : ?>
                        <td><?= h($studentTermlyResults[$key]) ?></td>
                    <?php endforeach; ?>
                    <td><?= h($studentTermlyResults['total']) ?></td>
                    <td><?= h($studentTermlyResults['grade']) ?></td>
                    <td><?= h($studentTermlyResults['remark']) ?></td>
                    <td><?= @$this->Position->formatPositionOutput($subjectStudentPositions[$studentTermlyResults['student_id']]) ?></td>
                    <td><?= $this->Form->postLink(__('Delete'), [
                            'plugin'=>'ResultSystem',
                            'controller'=>'StudentTermlyResults',
                            'action' => 'delete', $studentTermlyResults['id'],
                        ],
                            ['confirm' => __('Are you sure you want to delete this subject score ?')]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <?php  if (empty($this->request->getQuery())) : ?>
        <div class="alert alert-danger">
            <p> Select term, class and session </p>
        </div>
    <?php endif; ?>
</div>