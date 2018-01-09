<?php
$edittemplates = [
    'label' => '',
    'submitContainer' => '{{content}}'
];
$this->Form->templates($edittemplates);

?>

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

                <?= $this->Form->create($subject) ?>
                <fieldset>
                    <?php if (!empty($subject->student_termly_results)): ?>
                        <table class="table table-bordered">
                            <tr>
                                <th><?= __('Student Admission No') ?></th>
                                <?php foreach( $gradeInputs as $gradeInput ): ?>
                                    <th> <?= __($gradeInput) ?> </th>
                                <?php endforeach; ?>
                                <th><?= __('Total') ?></th>

                            </tr>
                            <?php for ($num = 0; $num < count($subject->student_termly_results); $num++ ): ?>
                                <tr>
                                    <td><?= h($subject['student_termly_results'][$num]['student_id']) ?></td>
                                    <?php foreach( $gradeInputs as $key => $value ) : ?>
                                        <td><?= $this->Form->input('student_termly_results.'.$num.'.'.$key) ?></td>
                                    <?php endforeach; ?>
                                    <td><?= $this->Form->input('student_termly_results.'.$num.'.total',['readonly']) ?></td>
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
                <?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>

    </div>
</div>
