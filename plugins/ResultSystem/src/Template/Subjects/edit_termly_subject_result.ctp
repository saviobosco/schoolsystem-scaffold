<?php
$this->extend('/Common/view2');
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
            <div class="panel-body table-responsive">

                <?php if (!empty($subject->student_termly_results)): ?>
                    <?= $this->Form->create($subject) ?>
                    <table class="table table-bordered" style="font-size: 12px;">
                        <tr>
                            <th><?= __('Student Admission No') ?></th>
                            <th><?= __('Full Name') ?></th>
                            <?php foreach ($gradeInputs as $gradeInput): ?>
                                <th> <?= __($gradeInput) ?> </th>
                            <?php endforeach; ?>
                            <th><?= __('Total') ?></th>
                            <th><?= __('Grade') ?></th>
                            <th><?= __('Remark') ?></th>

                        </tr>
                        <?php $resultCounts = count($subject->student_termly_results);
                        for ($num = 0; $num < $resultCounts; $num++): ?>
                            <tr>
                                <td><?= h($subject['student_termly_results'][$num]['student_id']) ?></td>
                                <td><?= h($subject['student_termly_results'][$num]['student']['first_name'].' '.$subject['student_termly_results'][$num]['student']['last_name']) ?></td>
                                <?php foreach ($gradeInputs as $key => $value) : ?>
                                    <td><?= $this->Form->input('student_termly_results.' . $num . '.' . $key) ?></td>
                                <?php endforeach; ?>
                                <td><?= $this->Form->input('student_termly_results.' . $num . '.total') ?></td>
                                <td><?= $this->Form->input('student_termly_results.' . $num . '.grade') ?></td>
                                <td><?= $this->Form->input('student_termly_results.' . $num . '.remark') ?></td>
                                <td class="hidden"><?= $this->Form->hidden('student_termly_results.' . $num . '.student_id') ?></td>
                                <td class="hidden"><?= $this->Form->hidden('student_termly_results.' . $num . '.subject_id') ?></td>
                                <td class="hidden"><?= $this->Form->hidden('student_termly_results.' . $num . '.class_id') ?></td>
                                <td class="hidden"><?= $this->Form->hidden('student_termly_results.' . $num . '.term_id') ?></td>
                                <td class="hidden"><?= $this->Form->hidden('student_termly_results.' . $num . '.session_id') ?></td>
                            </tr>
                        <?php endfor; ?>
                    </table>

                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                    <?= $this->Form->end() ?>
                <?php endif; ?>
                <?= $this->element('selectParameters') ?>
            </div>
        </div>

    </div>
</div>
