<?php
$edittemplates = [
    'label' => '',
    'submitContainer' => '{{content}}'
];
$this->Form->templates($edittemplates);
$this->extend('/Common/view');
$this->assign('title','Edit Termly Results');
?>

<?= $this->element('searchParametersSessionClassTerm'); ?>
<?php if ( isset( $student)) : ?>
<?= $this->element('Student/header_links') ?>
<?= $this->Form->create($student) ?>
<div class="row m-t-30">
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
            <tr>
                <th><?= __('Term') ?></th>
                <td><?= h(@$terms[$this->request->query['term_id']]) ?></td>
            </tr>
            <tr>
                <th><?= __('Session') ?></th>
                <td><?= h(@$sessions[$this->request->query['session_id']]) ?></td>
            </tr>
        </table>
    </div>
    <div class="col-sm-5">
        <?php if (!empty($student->student_termly_results)): ?>
            <table class="table table-responsive table-bordered">
                <?= $this->Form->hidden('student_positions.0.student_id',['value' => $student->id ]) ?>
                <?= $this->Form->hidden('student_positions.0.class_id',['value' => @$this->SearchParameter->getDefaultValue($this->request->query['class_id'],1)]) ?>
                <?= $this->Form->hidden('student_positions.0.term_id',['value' => @$this->SearchParameter->getDefaultValue($this->request->query['term_id'],1)]) ?>
                <?= $this->Form->hidden('student_positions.0.session_id',['value' => @$this->SearchParameter->getDefaultValue($this->request->query['session_id'],1)]) ?>
                <tr>
                    <td>
                        Total
                    </td>
                    <td>
                        <?= $this->Form->input('student_positions.0.total',['class' => 'form-control','label'=>['text'=> 'Total']])  ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Average
                    </td>
                    <td>
                        <?= $this->Form->input('student_positions.0.average',['class' => 'form-control','label'=>['text'=> 'Average']])  ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Grade
                    </td>
                    <td>
                        <?= $this->Form->input('student_positions.0.grade',['class' => 'form-control','label'=>['text'=> 'Grade']])  ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Position
                    </td>
                    <td>
                        <?= $this->Form->input('student_positions.0.position',['class' => 'form-control','label'=>['text'=> 'Position']])  ?>
                    </td>
                </tr>

            </table>
        <?php endif; ?>
    </div>
</div>

<fieldset>
    <legend><?= __('Edit Student Termly Result') ?></legend>
    <?php if (!empty($student->student_termly_results)): ?>
        <table class="table table-bordered table-responsive " data-toggle='tooltip' title=''>
            <tr>
                <th><?= __('Subject') ?></th>
                <?php foreach( $gradeInputs as $gradeInput ): ?>
                    <th> <?= __($gradeInput) ?> </th>
                <?php endforeach; ?>
                <th><?= __('Total') ?></th>
            </tr>
            <?php for ($num = 0; $num < count($student->student_termly_results); $num++ ): ?>
                <tr>
                    <td><?= h($subjects[$student['student_termly_results'][$num]['subject_id']]) ?></td>
                    <?php foreach( $gradeInputs as $key => $value ) : ?>
                        <td><?= $this->Form->input('student_termly_results.'.$num.'.'.$key) ?></td>
                    <?php endforeach; ?>
                    <td><?= $this->Form->input('student_termly_results.'.$num.'.total',[]) ?></td>
                    <td class="hidden"><?= $this->Form->hidden('student_termly_results.'.$num.'.student_id') ?></td>
                    <td class="hidden"><?= $this->Form->hidden('student_termly_results.'.$num.'.student_id') ?></td>
                    <td class="hidden"><?= $this->Form->hidden('student_termly_results.'.$num.'.subject_id') ?></td>
                    <td class="hidden"><?= $this->Form->hidden('student_termly_results.'.$num.'.class_id') ?></td>
                    <td class="hidden"><?= $this->Form->hidden('student_termly_results.'.$num.'.term_id') ?></td>
                    <td class="hidden"><?= $this->Form->hidden('student_termly_results.'.$num.'.session_id') ?></td>
                </tr>
            <?php endfor; ?>
        </table>
    <?php endif; ?>
</fieldset>
    <fieldset>
        <legend>General Remarks </legend>
        <!-- This is for the student remark -->
        <?= $this->Form->hidden('student_general_remarks.0.student_id',['value' => $student->id ]) ?>
        <?= $this->Form->hidden('student_general_remarks.0.class_id',['value' => @$this->SearchParameter->getDefaultValue($this->request->query['class_id'],1)]) ?>
        <?= $this->Form->hidden('student_general_remarks.0.term_id',['value' => @$this->SearchParameter->getDefaultValue($this->request->query['term_id'],1)]) ?>
        <?= $this->Form->hidden('student_general_remarks.0.session_id',['value' => @$this->SearchParameter->getDefaultValue($this->request->query['session_id'],1)]) ?>
        <?php foreach($remarkInputs as $remarkInputKey => $remarkInputValue ) : ?>
            <label for="<?= $remarkInputKey ?>"> <?= h($remarkInputValue) ?> </label>
            <?= $this->Form->input("student_general_remarks.0.$remarkInputKey",['class' => 'form-control','label'=>['text'=> 'Result Remark']])  ?>
        <?php endforeach; ?>
    </fieldset>
    <fieldset>
        <legend> Publish Result</legend>
        <label for="result status">Result Publish Status </label>
        <?php $publishResultConfig = ['type'=>'checkbox']; if (empty($student->student_publish_results)) {
            $publishResultConfig['checked'] = false;
        } ?>
        <?= $this->Form->input('student_publish_results.0.status',$publishResultConfig) ?>
        <?= $this->Form->hidden('student_publish_results.0.student_id',['value' => $student->id ]) ?>
        <?= $this->Form->hidden('student_publish_results.0.class_id',['value' => @$this->SearchParameter->getDefaultValue($this->request->query['class_id'],1)]) ?>
        <?= $this->Form->hidden('student_publish_results.0.term_id',['value' => @$this->SearchParameter->getDefaultValue($this->request->query['term_id'],1)]) ?>
        <?= $this->Form->hidden('student_publish_results.0.session_id',['value' => @$this->SearchParameter->getDefaultValue($this->request->query['session_id'],1)]) ?>

    </fieldset>
    <?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary']) ?>
<?= $this->Form->end() ?>
<?= $this->Form->postLink(__('Delete Result'), ['action' => 'delete', $student->id,'?' => $this->request->getQuery()], ['escape'=> false, 'class' => 'pull-right btn btn-danger', 'confirm' => __('Are you sure you want to delete all results for student {0} in the selected term?', $student->id)]) ?>
<?php endif; ?>

<?php if ( empty($this->request->getQuery())) : ?>
    <div class="alert alert-danger">
        <p> Please specify the term , class and session.</p>
    </div>
<?php endif; ?>
