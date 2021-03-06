<?php
/**
 * @var \App\View\AppView $this
 */
$this->extend('/Common/view');
$this->assign('title','Students');
?>
<div class="m-b-20">
    <div class="row">
        <div class="col-sm-4">
            <?= $this->element('searchParametersClass') ?>
        </div>
        <div class="col-sm-6">
            <?= $this->element('searchStudentWithName') ?>
        </div>
    </div>
</div>
<table id="data-table" class="table table-bordered table-responsive ">
    <thead>
    <tr>
        <th><?= $this->Paginator->sort('id') ?></th>
        <th><?= $this->Paginator->sort('first_name') ?></th>
        <th><?= $this->Paginator->sort('last_name') ?></th>
        <th><?= $this->Paginator->sort('class') ?></th>
        <th><?= $this->Paginator->sort('status') ?></th>

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
            <td><?php
                switch($student->status):
                    case 1:
                        echo '<span class="label label-success"> active </span>';
                        break;
                    case 0:
                        echo '<span class="label label-danger"> unactive </span>';
                        break;
                    default:
                        echo '<span class="label label-success"> unknown </span>';
                endswitch
                ?>
            </td>
            <td class="actions">
                <?= $this->Html->link('<i class="fa fa-plus"></i> '.__('Add Result'), ['action' => 'add', $student['id']],['escape'=>false,'class'=>'btn btn-success btn-sm']) ?>
                <?= $this->Html->link('<i class="fa fa-book"></i> '.__('ViewResult'), ['action' => 'view', $student['id']],['escape'=>false,'class'=>'btn btn-primary btn-sm']) ?>
                <?= $this->Html->link('<i class="fa fa-eye"></i> '.__('EditResult'), ['action' => 'edit', $student['id']],['escape'=>false,'class'=>'btn btn-info btn-sm']) ?>
                <?= $this->Html->link('<i class="fa fa-print"></i> '.__('View Result Format'), ['action' => 'viewStudentResultForAdmin', $student['id']],['escape'=>false,'class'=>'btn btn-inverse btn-sm']) ?>
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