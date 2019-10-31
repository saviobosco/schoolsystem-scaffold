<?php
/**
 * @var \App\View\AppView $this
 */
$this->extend('/Common/view');
$this->assign('title','Students');
?>
<div class="m-b-20">
    <div class="row">
        <div class="col-sm-12">
            <?= $this->element('studentsSearchCriteria') ?>
        </div>
    </div>
</div>

<?php if(isset($students) && !empty($students)): ?>
<table id="data-table" class="table table-bordered table-responsive ">
    <thead>

    <tr>
        <th><?= __('Admission No.') ?></th>
        <th><?= __('Full Name') ?></th>
        <th><?= __('Class') ?></th>
        <th><?= __('Status') ?></th>
        <th class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($students as $student): ?>
        <tr>
            <td><?= h($student['id']) ?></td>
            <td><?= h($student['first_name']) .' '. h($student['last_name']) ?></td>
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
<?php endif; ?>