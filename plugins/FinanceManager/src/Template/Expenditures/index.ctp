<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Expenditure[]|\Cake\Collection\CollectionInterface $expenditures
  */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= __('Expenditures') ?> </h4>
            </div>
            <div class="panel-body">

                <h3><?= __('Expenditures') ?></h3>
                <?= $this->Html->link('Add New Expenditure',['plugin'=>null,'controller'=>'Expenditures','action'=>'add'],['class'=>'pull-right']) ?>
                <table class="table table-bordered table-responsive" >
                    <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('expenditure_category_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('purpose') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($expenditures as $expenditure): ?>
                        <tr>
                            <td><?= $this->Number->format($expenditure->id) ?></td>
                            <td><?= $expenditure->expenditure_category->type ?></td>
                            <td><?= h($expenditure->purpose) ?></td>
                            <td><?= h($expenditure->date) ?></td>
                            <td><?= h($expenditure->created) ?></td>
                            <td><?= $this->Currency->displayCurrency($expenditure->amount) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $expenditure->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $expenditure->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $expenditure->id], ['confirm' => __('Are you sure you want to delete # {0}?', $expenditure->id)]) ?>
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
