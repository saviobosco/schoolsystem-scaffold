<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $paymentTypes
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= __('Payment Types') ?> </h4>
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-bordered">
                    <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($paymentTypes as $paymentType): ?>
                        <tr>
                            <td><?= $this->Number->format($paymentType->id) ?></td>
                            <td><?= h($paymentType->type) ?></td>
                            <td><?= h($paymentType->created) ?></td>
                            <td><?= h($paymentType->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $paymentType->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $paymentType->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $paymentType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $paymentType->id)]) ?>
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