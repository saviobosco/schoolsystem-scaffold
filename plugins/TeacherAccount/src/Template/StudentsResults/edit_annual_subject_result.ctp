<?php
$this->assign('title', 'Teacher: Edit Students Annual Results');
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


<div class="row m-t-20">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"><?= h($subject->name) ?> - Annual Result </h4>
            </div>
            <div class="panel-body">

                <?= $this->Form->create($subject) ?>
                <fieldset>
                    <?php if (!empty($subject->student_annual_results)): ?>
                        <table class="table table-bordered">
                            <tr>
                                <th><?= __('Student Admission No') ?></th>
                                <th><?= __('Student Full Name') ?></th>
                                <th><?= __('First Term') ?></th>
                                <th><?= __('Second Term') ?></th>
                                <th><?= __('Third Term') ?></th>
                                <th><?= __('Total') ?></th>
                            </tr>
                            <?php for ($num = 0; $num < count($subject->student_annual_results); $num++ ): ?>
                                <tr>
                                    <td><?= h($subject['student_annual_results'][$num]['student_id']) ?></td>
                                    <td><?= h($subject['student_annual_results'][$num]['student']['first_name'].' '.$subject['student_annual_results'][$num]['student']['last_name']) ?></td>
                                    <td><?= $this->Form->input('student_annual_results.'.$num.'.first_term') ?></td>
                                    <td><?= $this->Form->input('student_annual_results.'.$num.'.second_term') ?></td>
                                    <td><?= $this->Form->input('student_annual_results.'.$num.'.third_term') ?></td>
                                    <td><?= $this->Form->input('student_annual_results.'.$num.'.total',['readonly']) ?></td>
                                    <td class="hidden"><?= $this->Form->hidden('student_annual_results.'.$num.'.student_id') ?></td>
                                    <td class="hidden"><?= $this->Form->hidden('student_annual_results.'.$num.'.subject_id') ?></td>
                                    <td class="hidden"><?= $this->Form->hidden('student_annual_results.'.$num.'.class_id') ?></td>
                                    <td class="hidden"><?= $this->Form->hidden('student_annual_results.'.$num.'.term_id') ?></td>
                                    <td class="hidden"><?= $this->Form->hidden('student_annual_results.'.$num.'.session_id') ?></td>
                                </tr>
                            <?php endfor; ?>
                        </table>
                    <?php endif; ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

