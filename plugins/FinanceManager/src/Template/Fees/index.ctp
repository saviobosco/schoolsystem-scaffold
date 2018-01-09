<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Fee[]|\Cake\Collection\CollectionInterface $fees
  */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Fees </h4>
            </div>
            <div class="panel-body">
                <div class="m-b-20">
                    <?= $this->Html->link('Create New Fee',['controller'=>'Fees','action'=>'add'],['class'=>'btn btn-primary m-r-15']) ?>
                    <?= $this->Html->link('Fees Statistics',['controller'=>'Fees','action'=>'feeStatistics'],['class'=>'btn btn-primary m-r-15']) ?>
                    <?= $this->Html->link('Fees Defaulters',['controller'=>'Fees','action'=>'feeDefaulters'],['class'=>'btn btn-danger m-r-15']) ?>
                    <?= $this->Html->link('Fees Query',['controller'=>'Fees','action'=>'feesQuery'],['class'=>'btn btn-info m-r-15']) ?>
                </div>




                <table id="data-table" class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('fee_category_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('term_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('class_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('session_id') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($fees as $fee): ?>
                        <tr>
                            <td><?= $this->Number->format($fee->id) ?></td>
                            <td><?= $fee->fee_category->type ?></td>
                            <td><?= $this->Currency->displayCurrency($fee->amount) ?></td>
                            <td><?= @$fee->term->name ?></td>
                            <td><?= @$fee->class->class ?></td>
                            <td><?= @$fee->session->session ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $fee->id],['class'=>'btn btn-primary btn-sm','escape'=>false]) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $fee->id],['class'=>'btn btn-info btn-sm','escape'=>false]) ?>
                                <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', ['action' => 'delete', $fee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fee->id),'escape'=>false,'class'=>'btn btn-sm btn-danger m-l-5']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="paginator">
                    <ul class="pagination">
                        <?= $this->Paginator->first('<< ' . __('first')) ?>
                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('next') . ' >') ?>
                        <?= $this->Paginator->last(__('last') . ' >>') ?>
                    </ul>
                    <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
                </div>

            </div>
        </div>
    </div>
</div>
