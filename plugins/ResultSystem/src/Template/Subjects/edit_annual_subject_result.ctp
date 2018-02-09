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
                <h4 class="panel-title"><?= h($subject->name) ?> - Annual Result </h4>
            </div>
            <div class="panel-body">

                <?= $this->Form->create($subject) ?>
                <fieldset>
                    <?php if (!empty($subject->student_annual_results)): ?>
                        <table class="table table-bordered">
                            <tr>
                                <th><?= __('Student Admission No') ?></th>
                                <th><?= __('First Term') ?></th>
                                <th><?= __('Second Term') ?></th>
                                <th><?= __('Third Term') ?></th>
                                <th><?= __('Total') ?></th>
                            </tr>
                            <?php for ($num = 0; $num < count($subject->student_annual_results); $num++ ): ?>
                                <tr>
                                    <td><?= h($subject['student_annual_results'][$num]['student_id']) ?></td>
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
