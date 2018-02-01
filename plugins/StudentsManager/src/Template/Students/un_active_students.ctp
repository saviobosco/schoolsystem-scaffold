<?php

use Cake\Utility\Inflector ;
// including the search parameter element
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= __('UnActive Students') ?>  </h4>
            </div>
            <div class="panel-body">
                <div class="m-b-20">
                    <?= $this->element('searchParametersClass'); ?>
                </div>

                <?= $this->element('Links/mainLinks') ?>

                <table id="data-table" class="table table-responsive table-bordered ">
                    <thead>
                    <tr>
                        <th><?= h('Admission No.') ?></th>
                        <th><?= Inflector::humanize('full_name') ?></th>
                        <th><?= Inflector::humanize('gender') ?></th>
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
                            <td><?= @$classes[$student->class_id] ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Activate'), ['action' => 'activate', $student->id],['class'=>'text-primary','escape'=>false]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="paginator">
                    <ul class="pagination">
                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('next') . ' >') ?>
                    </ul>
                    <p><?= $this->Paginator->counter() ?></p>
                </div>
            </div>
        </div>
    </div>
</div>