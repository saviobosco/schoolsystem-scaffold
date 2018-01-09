<?php

use Cake\Utility\Inflector ;
// including the search parameter element
// debug($graduatedStudents);
?>

<div class="pull-right">
    <?= $this->Html->link('All Students',['plugin' => null,'controller'=>'Students','action'=>'index'],['escape'=>false,'class'=>'p-r-10']) ?>
</div>

<div class="row">
    <div class="col-sm-12">
        <h3><?= __('Graduated Students') ?></h3>
        <table class="table table-responsive table-bordered ">
            <thead>
            <tr>
                <th><?= h('Admission No.') ?></th>
                <th><?= Inflector::humanize('full_name') ?></th>
                <th><?= Inflector::humanize('gender') ?></th>
                <th><?= Inflector::humanize('session admitted') ?></th>
                <th><?= Inflector::humanize('session graduated') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($graduatedStudents as $student): ?>
                <tr>
                    <td><?= h($student->id) ?></td>
                    <td><?= h($student->full_name) ?></td>
                    <td><?= h($student->gender) ?></td>
                    <td><?= $student->session->session ?></td>
                    <td><?= $student->session_graduated->session ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>