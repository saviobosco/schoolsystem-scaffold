<?php
/**
 * @var \App\View\AppView $this
 */
$this->extend('/Common/view');
$this->assign('title','Add Results');
$templates = [
    'label' => '',
    'submitContainer' => '{{content}}'
];
$this->Form->setTemplates($templates);
$queryData = $this->request->getQuery();

if ( isset($studentResultExists) AND !empty($studentResultExists)) {
    foreach( $studentResultExists as $subjectExist ) {
        unset($subjects[$subjectExist]);
    }
}
?>
<?= $this->element('searchParametersSessionClassTerm'); ?>
<?= $this->element('Student/header_links') ?>
<div class="row m-t-30">
    <div class="col-sm-2">
        <div class="profile-picture">
            <?= $this->Html->image('student-pictures/students/photo/'.$student->photo_dir.'/'.$student->photo,['alt' => $student->id,'width' => '150px']) ?>
        </div>
    </div>
    <div class="col-sm-6">
        <table class="table table-responsive table-bordered">
            <tr>
                <th>Student Admission No :</th>
                <td><?= $student->id ?></td>
            </tr>
            <tr>
                <th>Student Name :</th>
                <td> <?= $student->full_name ?></td>
            </tr>
            <tr>
                <th>Class :</th>
                <td><?= $student->class->class ?> </td>
            </tr>
        </table>
    </div>
    <div class="col-sm-4">
        <?php if (!empty($queryData)) :?>
            <table class="table table-bordered table-responsive ">
                <thead>
                <tr>
                    <td colspan="2"> <b> Add Result for the following Details Below </b>  </td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th> Session : </th>
                    <td> <?= $sessions[$queryData['session_id']] ?></td>
                </tr>
                <tr>
                    <th> Class :</th>
                    <td>  <?= $classes[$queryData['class_id']] ?> </td>
                </tr>
                <tr>
                    <th> Term : </th>
                    <td> <?= $terms[$queryData['term_id']] ?> </td>
                </tr>
                </tbody>
            </table>
        <?php else : ?>
        <?= $this->element('selectParameters') ?>
        <?php endif; ?>
    </div>
</div>

<?php if ( isset($selectParameter) AND $selectParameter === true) : ?>
    <div class="alert alert-danger">
        <p> Please select the session , class and term  </p>
    </div>
<?php endif; ?>

<?= $this->Form->create($student,['method'=>'POST',]) ?>
<fieldset>
    <legend><?= __('Add Student Termly Result') ?></legend>
    <?php if (!empty($subjects)): ?>
        <table  class="table table-bordered table-responsive ">
            <tr>
                <th><?= __('Subject') ?></th>
                <?php foreach( $gradeInputs as $gradeInput ): ?>
                    <th> <?= __($gradeInput) ?> </th>
                <?php endforeach; ?>
            </tr>
            <?php foreach( $subjects as $num => $name ): ?>
                <tr>
                    <td><?= h($subjects[$num]) ?></td>
                    <?php foreach( $gradeInputs as $key => $value ) : ?>
                        <td><?= $this->Form->input('student_termly_results.'.$num.'.'.$key) ?></td>
                    <?php endforeach; ?>
                    <td class="hidden"><?= $this->Form->hidden('student_termly_results.'.$num.'.student_id',['value'=>$student->id]) ?></td>
                    <td class="hidden"><?= $this->Form->hidden('student_termly_results.'.$num.'.subject_id',['value'=>$num]) ?></td>
                    <td class="hidden"><?= $this->Form->hidden('student_termly_results.'.$num.'.class_id',['value'=>$queryData['class_id']]) ?></td>
                    <td class="hidden"><?= $this->Form->hidden('student_termly_results.'.$num.'.term_id',['value'=>$queryData['term_id']]) ?></td>
                    <td class="hidden"><?= $this->Form->hidden('student_termly_results.'.$num.'.session_id',['value'=>$queryData['session_id']]) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- This is for the student remark -->
        <?= $this->Form->hidden('student_general_remarks.0.student_id',['value' => $student->id ]) ?>
        <?= $this->Form->hidden('student_general_remarks.0.class_id',['value' => @$queryData['class_id']]) ?>
        <?= $this->Form->hidden('student_general_remarks.0.term_id',['value' => @$queryData['term_id']]) ?>
        <?= $this->Form->hidden('student_general_remarks.0.session_id',['value' => @$queryData['session_id']]) ?>
        <?php foreach($remarkInputs as $remarkInputKey => $remarkInputValue ) : ?>
            <label for="<?= $remarkInputKey ?>"> <?= h($remarkInputValue) ?> </label>
            <?= $this->Form->input("student_general_remarks.0.$remarkInputKey",['class' => 'form-control','label'=>['text'=> 'Result Remark']])  ?>
        <?php endforeach; ?>
    <?php endif; ?>
</fieldset>
<?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary']) ?>
<?= $this->Form->end() ?>