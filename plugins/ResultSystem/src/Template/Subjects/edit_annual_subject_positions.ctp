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

<div class="row">
    <div class="col-sm-12">
        <h3><?= h($subject->name) ?> - Result Annual Positions </h3>

        <?= $this->Form->create($subject) ?>
        <fieldset>
            <?php if (!empty($subject->student_annual_subject_positions)): ?>
                <table class="table table-bordered">
                    <tr>
                        <th><?= __('Student Admission No') ?></th>
                        <th><?= __('Total') ?></th>
                        <th><?= __('Position') ?></th>

                    </tr>
                    <?php for ($num = 0; $num < count($subject->student_annual_subject_positions); $num++ ): ?>
                        <tr>
                            <td><?= h($subject['student_annual_subject_positions'][$num]['student_id']) ?></td>
                            <td><?= $this->Form->input('student_annual_subject_positions.'.$num.'.total') ?></td>
                            <td><?= $this->Form->input('student_annual_subject_positions.'.$num.'.position') ?></td>
                            <td class="hidden"><?= $this->Form->hidden('student_annual_subject_positions.'.$num.'.student_id') ?></td>
                            <td class="hidden"><?= $this->Form->hidden('student_annual_subject_positions.'.$num.'.subject_id') ?></td>
                            <td class="hidden"><?= $this->Form->hidden('student_annual_subject_positions.'.$num.'.class_id') ?></td>
                            <td class="hidden"><?= $this->Form->hidden('student_annual_subject_positions.'.$num.'.session_id') ?></td>
                        </tr>
                    <?php endfor; ?>
                </table>
            <?php endif; ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
