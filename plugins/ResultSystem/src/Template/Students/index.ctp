<?php

?>
<?= $this->element('searchParametersClass') ?>
<div class="row m-t-30">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> View All Student </h4>
            </div>
            <div class="panel-body">
                <h3><?= __('Students') ?></h3>
                <table id="data-table" class="table table-bordered table-responsive ">
                    <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th><?= $this->Paginator->sort('first_name') ?></th>
                        <th><?= $this->Paginator->sort('last_name') ?></th>
                        <th><?= $this->Paginator->sort('class') ?></th>

                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?= h($student['id']) ?></td>
                            <td><?= h($student['first_name']) ?></td>
                            <td><?= h($student['last_name']) ?></td>
                            <td><?= h($student['class']['class']) ?></td>
                            <td class="actions">
                                <?= $this->Html->link('<i class="fa fa-plus"></i> '.__('Add Result'), ['action' => 'addResult', $student['id'],'?'=>['session_id'=>1,'class_id'=>$student['class_id'],'term_id'=>1]],['escape'=>false,'class'=>'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link('<i class="fa fa-book"></i> '.__('ViewResult'), ['action' => 'view', $student['id'],'?'=>['session_id'=>1,'class_id'=>$student['class_id'],'term_id'=>1]],['escape'=>false,'class'=>'btn btn-primary btn-sm']) ?>
                                <?= $this->Html->link('<i class="fa fa-eye"></i> '.__('EditResult'), ['action' => 'edit', $student['id'], '?'=>['session_id'=>1,'class_id'=>$student['class_id'],'term_id'=>1]],['escape'=>false,'class'=>'btn btn-info btn-sm']) ?>
                                <?= $this->Html->link('<i class="fa fa-print"></i> '.__('View Result Format'), ['action' => 'viewStudentResultForAdmin', $student['id'],'?'=>['session_id'=>1,'class_id'=>$student['class_id'],'term_id'=>1]],['escape'=>false,'class'=>'btn btn-inverse btn-sm']) ?>
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