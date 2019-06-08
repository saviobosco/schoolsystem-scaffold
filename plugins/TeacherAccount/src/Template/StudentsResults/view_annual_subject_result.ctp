<?php
$this->assign('title', 'Teacher: View Termly Students Results');
//$this->extend('/Common/view');
$formTemplates = [
    'submitContainer' => '{{content}}'
];
$this->Form->templates($formTemplates);
$queryData = $this->request->getQuery();
?>
<div class="row">
    <div class="col-sm-12">
        <?= $this->Form->create('',['class'=>'form-inline','type'=>'GET']) ?>
        <div class="form-group">
            <?= $this->Form->input('subject_id',['options' => $subjects,'class'=>'form-control','data-select-id'=>'subject','label'=>['text'=>'Subject '],'value'=>(isset($queryData['subject_id']) && !empty($queryData['subject_id'])) ? $queryData['subject_id'] : 1]); ?>
            <?= $this->Form->input('session_id',['options' => $sessions,'class'=>'form-control','data-select-id'=>'school','label'=>['text'=>'Session '],'value'=>(isset($queryData['session_id']) && !empty($queryData['session_id'])) ? $queryData['session_id'] : 1]); ?>
            <?= $this->Form->hidden('class_id',['value'=>(isset($queryData['class_id']) && !empty($queryData['class_id'])) ? $queryData['class_id'] : '']); ?>
            <?= $this->Form->input('term_id',['options' => $terms,'class'=>'form-control','data-select-id'=>'level','label'=>['text'=>'Term'],'value'=>(isset($queryData['term_id']) && !empty($queryData['term_id'])) ? $queryData['term_id'] : 1]); ?>
            <?= $this->Form->submit(__('change'),['class'=>'btn btn-primary']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<?php if (isset($subject)): ?>
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
<?php endif; ?>
