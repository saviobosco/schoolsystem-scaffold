<?php
use Cake\Utility\Inflector ;
// including the search parameter element
$this->append('sidebar',$this->element('Links/sidebar'));
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Students  </h4>
            </div>
            <div class="panel-body">
                <div class="m-b-20">
                    <div class="row">
                        <div class="col-sm-4">
                            <?= $this->element('searchParametersClass'); ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $this->element('searchStudentWithName') ?>
                        </div>
                    </div>

                </div>

                <?= $this->element('Links/mainLinks') ?>

                <table id="data-table" class="table table-responsive table-bordered ">
                    <thead>
                    <tr>
                        <th><?= h('Admission No.') ?></th>
                        <th><?= Inflector::humanize('full_name') ?></th>
                        <th><?= Inflector::humanize('gender') ?></th>
                        <th><?= Inflector::humanize('class') ?></th>
                        <th><?= Inflector::humanize('status') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?= h($student->id) ?></td>
                            <td><?= h($student->full_name) ?></td>
                            <td><?= h($student->gender) ?></td>
                            <td><?= $student->class->class ?></td>
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
                                ?> </td>
                            <td class="actions-link">
                                <?= $this->Html->link('<i class="fa fa-eye"></i>'.__('View profile'), ['action' => 'view', $student->id],['class'=>'text-primary','escape'=>false]) ?>
                                <?= $this->Html->link('<i class="fa fa-edit"></i>'.__('Edit profile'), ['action' => 'edit', $student->id],['class'=>'text-primary','escape'=>false]) ?>
                                <?= $this->Html->link(''.__('Deactivate'), ['action' => 'deactivate', $student->id],['class'=>'text-primary','escape'=>false]) ?>
                                <?= $this->Form->postLink('<i class="fa fa-close"></i>'.__('Delete'), ['action' => 'delete', $student->id], ['confirm' => __('Are you sure you want to delete # {0}? . This action can not be reversed', $student->id),'class'=>'text-danger','escape' => false]) ?>
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