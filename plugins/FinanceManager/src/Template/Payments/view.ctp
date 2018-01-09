<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $payment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Payment'), ['action' => 'edit', $payment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Payment'), ['action' => 'delete', $payment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $payment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Payments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Payment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Receipts'), ['controller' => 'Receipts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Receipt'), ['controller' => 'Receipts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Payment Types'), ['controller' => 'PaymentTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Payment Type'), ['controller' => 'PaymentTypes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="payments view large-9 medium-8 columns content">
    <h3><?= h($payment->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Receipt') ?></th>
            <td><?= $payment->has('receipt') ? $this->Html->link($payment->receipt->id, ['controller' => 'Receipts', 'action' => 'view', $payment->receipt->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Made By') ?></th>
            <td><?= h($payment->payment_made_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Type') ?></th>
            <td><?= $payment->has('payment_type') ? $this->Html->link($payment->payment_type->id, ['controller' => 'PaymentTypes', 'action' => 'view', $payment->payment_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Received By') ?></th>
            <td><?= h($payment->payment_received_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Approved By') ?></th>
            <td><?= h($payment->payment_approved_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($payment->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Status') ?></th>
            <td><?= $this->Number->format($payment->payment_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Approved On') ?></th>
            <td><?= h($payment->payment_approved_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($payment->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($payment->modified) ?></td>
        </tr>
    </table>
</div>
