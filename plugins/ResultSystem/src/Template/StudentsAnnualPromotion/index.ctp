<?php
$this->extend('/Common/view');
$this->assign('title','Annual Promotion');
?>
<?= $this->element('searchParametersSessionClass') ?>
    <h3><?= __('Students Annual Promotion') ?></h3>
<?php if ( isset($students) AND !empty($students) ) : ?>
    <?= $this->Form->create()?>
    <?= $this->Form->submit(__('Submit'),['class' => 'btn btn-primary m-b-20']) ?>
    <table class="table table-bordered table-responsive ">
        <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('first_name') ?></th>
            <th><?= $this->Paginator->sort('last_name') ?></th>
            <th><?= h('Total') ?></th>
            <th><?= h('Average') ?></th>
            <th><?= h('Grade') ?></th>
            <th><?= h('Position') ?></th>
            <td> Promoted <label for="selectall"><input type="checkbox" id="selectall"> select all</label>  </td>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($students as $num => $student): ?>
            <tr>
                <td><?= h($student['student_id']) ?></td>
                <td><?= h($student['student']['first_name']) ?></td>
                <td><?= h($student['student']['last_name']) ?></td>
                <td><?= h(@$student['total']) ?></td>
                <td><?= h(@$student['average']) ?></td>
                <td><?= h(@$student['grade']) ?></td>
                <td><?= h(@$student['position']) ?></td>
                <td class="actions">
                    <?php
                    $checkboxConfig = ['type'=>'checkbox','label'=>'', 'class' => 'checkbox1'];
                    if (@$student['promoted'] === null OR 0 === (int)@$student['promoted'] ) {
                        $checkboxConfig['checked'] = false;
                    } elseif($student['promoted'] === true OR 1 === (int)$student['promoted']) {
                        $checkboxConfig['checked'] = true;
                    }
                    ?>
                    <?= $this->Form->input('student_annual_positions.'.$num.'.promoted',$checkboxConfig)  ?>
                    <?= $this->Form->hidden('student_annual_positions.'.$num.'.student_id',['value' => $student['student_id'] ]) ?>
                    <?= $this->Form->hidden('student_annual_positions.'.$num.'.class_id',['value' => $student['class_id']]) ?>
                    <?= $this->Form->hidden('student_annual_positions.'.$num.'.session_id',['value' => $student['session_id']]) ?>
                    <?= $this->Form->hidden('student_annual_positions.'.$num.'.term_id',['value' => $student['term_id']]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?= $this->Form->submit(__('Submit'),['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
<?php endif; ?>
<?= $this->element('selectParameters') ?>