<?php
// including the search parameter element
echo $this->element('searchParametersClass');
?>

<div class="row m-t-30">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> All Students </h4>
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-bordered ">
                    <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th><?= $this->Paginator->sort('full_name') ?></th>
                        <th><?= $this->Paginator->sort('class_id') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?= h($student->id) ?></td>
                            <td><?= h($student->full_name) ?></td>
                            <td><?= $student->class->class ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View Skill'), ['action' => 'view', $student->id]) ?>
                                <?= $this->Html->link(__('Edit Skill'), ['action' => 'edit', $student->id]) ?>
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