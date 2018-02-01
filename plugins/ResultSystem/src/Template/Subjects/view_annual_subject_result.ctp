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
    <h4><?= __('Related Student Annual Subject Positions') ?></h4>
    <?php if (!empty($studentSubjectAnnualResults)): ?>
        <table class="table table-bordered">
            <tr>
                <th><?= __('Student Id') ?></th>
                <th><?= __('Student Name') ?></th>
                <th><?= __('First Term') ?></th>
                <th><?= __('Second Term') ?></th>
                <th><?= __('Third Term') ?></th>
                <th><?= __('Total') ?></th>
                <th><?= __('Average') ?></th>
                <th><?= __('Remark') ?></th>
                <th><?= __('Position') ?></th>
                <th><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($studentSubjectAnnualResults as $studentSubjectAnnualResult): ?>
                <tr>
                    <td><?= h($studentSubjectAnnualResult['student_id']) ?></td>
                    <td><?= h($studentSubjectAnnualResult['student']['first_name'].' '.$studentSubjectAnnualResult['student']['last_name']) ?></td>
                    <td><?= h($studentSubjectAnnualResult['first_term']) ?></td>
                    <td><?= h($studentSubjectAnnualResult['second_term']) ?></td>
                    <td><?= h($studentSubjectAnnualResult['third_term']) ?></td>
                    <td><?= h($studentSubjectAnnualResult['total']) ?></td>
                    <td><?= h($studentSubjectAnnualResult['average']) ?></td>
                    <td><?= h($studentSubjectAnnualResult['remark']) ?></td>
                    <td><?= @$this->Position->formatPositionOutput($studentAnnualSubjectPositions[$studentSubjectAnnualResult['student_id']]) ?></td>
                    <td><?= $this->Form->postLink(__('Delete'), [
                            'plugin'=>'ResultSystem',
                            'controller'=>'StudentAnnualResults',
                            'action' => 'delete', $studentSubjectAnnualResult['id'],
                        ],
                            ['confirm' => __('Are you sure you want to delete this subject score ?')]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>