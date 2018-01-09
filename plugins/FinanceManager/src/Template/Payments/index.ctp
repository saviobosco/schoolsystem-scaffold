<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $payments
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Payment'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Receipts'), ['controller' => 'Receipts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Receipt'), ['controller' => 'Receipts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Payment Types'), ['controller' => 'PaymentTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Payment Type'), ['controller' => 'PaymentTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="payments index large-9 medium-8 columns content">
    <h3><?= __('Payments') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('receipt_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_made_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_type_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_received_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_approved_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('payment_approved_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($payments as $payment): ?>
            <tr>
                <td><?= $this->Number->format($payment->id) ?></td>
                <td><?= $payment->has('receipt') ? $this->Html->link($payment->receipt->id, ['controller' => 'Receipts', 'action' => 'view', $payment->receipt->id]) : '' ?></td>
                <td><?= h($payment->payment_made_by) ?></td>
                <td><?= $payment->has('payment_type') ? $this->Html->link($payment->payment_type->id, ['controller' => 'PaymentTypes', 'action' => 'view', $payment->payment_type->id]) : '' ?></td>
                <td><?= h($payment->payment_received_by) ?></td>
                <td><?= $this->Number->format($payment->payment_status) ?></td>
                <td><?= h($payment->payment_approved_by) ?></td>
                <td><?= h($payment->payment_approved_on) ?></td>
                <td><?= h($payment->created) ?></td>
                <td><?= h($payment->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $payment->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $payment->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $payment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $payment->id)]) ?>
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
