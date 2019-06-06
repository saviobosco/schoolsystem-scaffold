<?php
$this->assign('title', 'Teacher: Edit Students Results');
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

<?php if ($subject): ?>
    <div class="row m-t-20">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title"> <?= h($subject->name) ?> </h4>
                </div>
                <div class="panel-body">

                    <?php if (!empty($subject->student_termly_results)): ?>
                        <?= $this->Form->create($subject) ?>
                        <fieldset>
                            <table class="table table-bordered">
                                <tr>
                                    <th><?= __('Student Admission No') ?></th>
                                    <th><?= __('Full Name') ?></th>
                                    <?php foreach ($gradeInputs as $gradeInput): ?>
                                        <th> <?= __($gradeInput) ?> </th>
                                    <?php endforeach; ?>
                                    <th><?= __('Total') ?></th>

                                </tr>
                                <?php $resultCounts = count($subject->student_termly_results);
                                for ($num = 0; $num < $resultCounts; $num++): ?>
                                    <tr>
                                        <td><?= h($subject['student_termly_results'][$num]['student_id']) ?></td>
                                        <td><?= h($subject['student_termly_results'][$num]['student']['first_name'].' '.$subject['student_termly_results'][$num]['student']['last_name']) ?></td>
                                        <?php foreach ($gradeInputs as $key => $value) : ?>
                                            <td><?= $this->Form->input('student_termly_results.' . $num . '.' . $key) ?></td>
                                        <?php endforeach; ?>
                                        <td><?= $this->Form->input('student_termly_results.' . $num . '.total', ['readonly']) ?></td>
                                        <td class="hidden"><?= $this->Form->hidden('student_termly_results.' . $num . '.student_id') ?></td>
                                        <td class="hidden"><?= $this->Form->hidden('student_termly_results.' . $num . '.subject_id') ?></td>
                                        <td class="hidden"><?= $this->Form->hidden('student_termly_results.' . $num . '.class_id') ?></td>
                                        <td class="hidden"><?= $this->Form->hidden('student_termly_results.' . $num . '.term_id') ?></td>
                                        <td class="hidden"><?= $this->Form->hidden('student_termly_results.' . $num . '.session_id') ?></td>
                                    </tr>
                                <?php endfor; ?>
                            </table>
                        </fieldset>
                        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                        <?= $this->Form->end() ?>
                    <?php endif; ?>
                    <?= $this->element('selectParameters') ?>
                </div>
            </div>

        </div>
    </div>
<?php endif; ?>
