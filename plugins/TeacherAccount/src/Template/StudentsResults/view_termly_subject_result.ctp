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
<?php endif; ?>
