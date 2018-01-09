<?php

?>
<?= $this->element('searchParametersSessionClass') ?>
<div class="row m-t-30">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Annual Promotion </h4>
            </div>
            <div class="panel-body">
                <h3><?= __('Students') ?></h3>
                <?php if ( isset($students) AND !empty($students) ) : ?>
                <?= $this->Form->create()?>
                <table id="data-table" class="table table-bordered table-responsive ">
                    <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th><?= $this->Paginator->sort('first_name') ?></th>
                        <th><?= $this->Paginator->sort('last_name') ?></th>
                        <th><?= h('Class') ?></th>
                        <th><?= h('Total') ?></th>
                        <th><?= h('Average') ?></th>
                        <th><?= h('Grade') ?></th>
                        <th><?= h('Position') ?></th>
                        <td> Promoted? </td> <?php // Todo : add a widget to activate all checkboxes at once ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $studentCounts = count($students);
                    for ($num = 0; $num < $studentCounts ; $num++): ?>
                        <tr>
                            <td><?= h($students[$num]['id']) ?></td>
                            <td><?= h($students[$num]['first_name']) ?></td>
                            <td><?= h($students[$num]['last_name']) ?></td>
                            <td><?= h($students[$num]['Classes']['class']) ?></td>
                            <td><?= h($students[$num]['student_annual_positions'][0]['total']) ?></td>
                            <td><?= h($students[$num]['student_annual_positions'][0]['average']) ?></td>
                            <td><?= h($students[$num]['student_annual_positions'][0]['grade']) ?></td>
                            <td><?= h($students[$num]['student_annual_positions'][0]['position']) ?></td>
                            <td class="actions">
                                <?php if (!empty($students[$num]['student_annual_positions'])) : ?>

                                    <?php
                                    $checkboxConfig = ['type'=>'checkbox','label'=>''];
                                    //$checkboxConfig['value'] = $students[$num]['student_annual_positions'][0]['promoted'];
                                    /*if ($students[$num]['student_annual_positions'][0]['promoted'] === null OR $students[$num]['student_annual_positions'][0]['promoted'] == 0) {
                                        $checkboxConfig['checked'] = false;
                                    } else {
                                        $checkboxConfig['checked'] = true;
                                    }*/
                                    ?>
                                    <?= $this->Form->input('student_annual_positions.'.$num.'.promoted',$checkboxConfig)  ?>
                                    <?= $this->Form->hidden('student_annual_positions.'.$num.'.student_id',['value' => $students[$num]['id'] ]) ?>
                                    <?= $this->Form->hidden('student_annual_positions.'.$num.'.class_id',['value' => @$students[$num]['student_annual_positions'][0]['session_id']]) ?>
                                    <?= $this->Form->hidden('student_annual_positions.'.$num.'.session_id',['value' => @$students[$num]['student_annual_positions'][0]['class_id']]) ?>
                                <?php else : ?>
                                    <p> The student does not have an annual result</p>
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endfor; ?>
                    </tbody>
                </table>
                <?= $this->Form->submit(__('Submit'),['class' => 'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>