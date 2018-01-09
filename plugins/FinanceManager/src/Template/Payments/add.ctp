<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Payments'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Receipts'), ['controller' => 'Receipts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Receipt'), ['controller' => 'Receipts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Payment Types'), ['controller' => 'PaymentTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Payment Type'), ['controller' => 'PaymentTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="payments form large-9 medium-8 columns content">
    <?= $this->Form->create($payment) ?>
    <fieldset>
        <legend><?= __('Add Payment') ?></legend>
        <?php
            echo $this->Form->control('receipt_id', ['options' => $receipts]);
            echo $this->Form->control('payment_made_by');
            echo $this->Form->control('payment_type_id', ['options' => $paymentTypes]);
            echo $this->Form->control('payment_received_by');
            echo $this->Form->control('payment_status');
            echo $this->Form->control('payment_approved_by');
            echo $this->Form->control('payment_approved_on', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
