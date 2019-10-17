<?php
$edittemplates = [
    'label' => '',
    'submitContainer' => '{{content}}'
];
$this->Form->templates($edittemplates);
$this->extend('/Common/view');
$this->assign('title','Edit Annual Results');
?>
<?= $this->element('searchParametersSessionClassTerm') ?>
    <div class="row m-t-20">
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
    </div>

<?= $this->Form->create($student) ?>
<?php if (!empty($student->student_annual_results)): ?>
    <fieldset>
        <legend><?= __('Edit Student Annual Result') ?></legend>
            <table class="table table-bordered table-responsive " data-toggle='tooltip' title=''>
                <tr>
                    <th><?= __('Subject') ?></th>
                    <th><?= __('First Term') ?></th>
                    <th><?= __('Second Term') ?></th>
                    <th><?= __('Third Term') ?></th>
                    <th ><?= __('Total') ?></th>
                    <th><?= __('Grade') ?></th>
                    <th><?= __('Remark') ?></th>
                </tr>
                <?php for ($num = 0; $num < count($student->student_annual_results); $num++ ): ?>
                    <tr>
                        <td class="hidden"><?= $this->Form->hidden('student_annual_results.'.$num.'.student_id') ?></td>
                        <td class="hidden"><?= $this->Form->hidden('student_annual_results.'.$num.'.subject_id') ?></td>
                        <td class="hidden"><?= $this->Form->hidden('student_annual_results.'.$num.'.class_id') ?></td>
                        <td class="hidden"><?= $this->Form->hidden('student_annual_results.'.$num.'.session_id') ?></td>
                        <td><?= h($subjects[$student['student_annual_results'][$num]['subject_id']]) ?></td>
                        <td><?= $this->Form->input('student_annual_results.'.$num.'.first_term') ?></td>
                        <td><?= $this->Form->input('student_annual_results.'.$num.'.second_term') ?></td>
                        <td><?= $this->Form->input('student_annual_results.'.$num.'.third_term') ?></td>
                        <td><?= $this->Form->input('student_annual_results.'.$num.'.total') ?></td>
                        <td><?= $this->Form->input('student_annual_results.'.$num.'.grade') ?></td>
                        <td><?= $this->Form->input('student_annual_results.'.$num.'.remark') ?></td>
                    </tr>
                <?php endfor; ?>
            </table>
    </fieldset>

    <fieldset>
        <legend> Position Details </legend>
        <?= $this->Form->hidden('student_positions.0.student_id',['value' => $student->id ]) ?>
        <?= $this->Form->hidden('student_positions.0.class_id',['value' => $this->request->query['class_id']]) ?>
        <?= $this->Form->hidden('student_positions.0.session_id',['value' => $this->request->query['session_id']]) ?>
        <?= $this->Form->hidden('student_positions.0.term_id',['value' => $this->request->query['term_id']]) ?>

        <label for="student total"> Total </label>
        <?= $this->Form->input('student_positions.0.total',['class' => 'form-control','label'=>['text'=> 'Total']])  ?>

        <label for="student average"> Average </label>
        <?= $this->Form->input('student_positions.0.average',['class' => 'form-control','label'=>['text'=> 'Average']])  ?>

        <label for="student grade"> Grade </label>
        <?= $this->Form->input('student_positions.0.grade',['class' => 'form-control','label'=>['text'=> 'Grade']])  ?>

        <label for="student position"> Position </label>
        <?= $this->Form->input('student_positions.0.position',['class' => 'form-control','label'=>['text'=> 'Position']])  ?>

        <label for="student promoted"> Promoted ?  </label>
        <?= $this->Form->input('student_positions.0.promoted',[ 'type'=>'checkbox'])  ?>

    </fieldset>
    <fieldset>
        <legend> General Remarks </legend>
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
        <legend> Publish Result </legend>
        <label for="result status"> Publish Status </label>
        <?php $publishResultConfig = ['type'=>'checkbox']; if (empty($student->student_publish_results)) {
            $publishResultConfig['checked'] = false;
        } ?>

        <?= $this->Form->input('student_publish_results.0.status',$publishResultConfig) ?>
        <?= $this->Form->hidden('student_publish_results.0.student_id',['value' => $student->id ]) ?>
        <?= $this->Form->hidden('student_publish_results.0.class_id',['value' => @$this->SearchParameter->getDefaultValue($this->request->query['class_id'],1)]) ?>
        <?= $this->Form->hidden('student_publish_results.0.term_id',['value' => @$this->SearchParameter->getDefaultValue($this->request->query['term_id'],1)]) ?>
        <?= $this->Form->hidden('student_publish_results.0.session_id',['value' => @$this->SearchParameter->getDefaultValue($this->request->query['session_id'],1)]) ?>

    </fieldset>

<?php endif; ?>
<?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary']) ?>
<?= $this->Form->end() ?>