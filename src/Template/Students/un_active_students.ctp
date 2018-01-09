<?php

use Cake\Utility\Inflector ;
// including the search parameter element
?>
<div class="pull-right">
    <?= $this->Html->link('All Students',['plugin' => null,'controller'=>'Students','action'=>'index'],['escape'=>false,'class'=>'p-r-10']) ?>
</div>

<div class="row">
    <div class="col-sm-12">
        <h3><?= __('Students') ?></h3>
        <table class="table table-responsive table-bordered ">
            <thead>
            <tr>
                <th><?= h('Admission No.') ?></th>
                <th><?= Inflector::humanize('full_name') ?></th>
                <th><?= Inflector::humanize('gender') ?></th>
                <th><?= Inflector::humanize('session') ?></th>
                <th><?= Inflector::humanize('class') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($unActiveStudents as $student): ?>
                <tr>
                    <td><?= h($student->id) ?></td>
                    <td><?= h($student->full_name) ?></td>
                    <td><?= h($student->gender) ?></td>
                    <td><?= $student->session->session ?></td>
                    <td><?= $student->class_demarcation->name ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $student->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $student->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $student->id], ['confirm' => __('Are you sure you want to delete # {0}?', $student->id)]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>