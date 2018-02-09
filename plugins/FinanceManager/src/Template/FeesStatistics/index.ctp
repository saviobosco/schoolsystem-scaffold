<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Fee[]|\Cake\Collection\CollectionInterface $fees
  */
$this->extend('/Common/view');
$this->assign('title','Fees Statistics');
?>
<table id="data-table" class="table table-bordered table-responsive">
    <thead>
    <tr>
        <th scope="col"><?= __('Fee') ?></th>
        <th scope="col"><?= __('amount') ?></th>
        <th scope="col"><?= __('Number of Students') ?></th>
        <th scope="col"><?= __('Expected Amount') ?></th>
        <th scope="col"><?= __('Earned Amount') ?></th>
        <th scope="col"><?= __('Term') ?></th>
        <th scope="col"><?= __('Class') ?></th>
        <th scope="col"><?= __('Session') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($fees as $fee): ?>
        <tr>
            <td><?= $this->Html->link($fee->fee_category->type,['action'=>'view',$fee->id]) ?></td>
            <td><?= $this->Currency->displayCurrency($fee->amount) ?></td>
            <td><?= __($fee->number_of_students) ?></td>
            <td><?= $this->Currency->displayCurrency($fee->income_amount_expected) ?></td>
            <td><?= $this->Currency->displayCurrency($fee->amount_earned) ?></td>
            <td><?= @$fee->term->name ?></td>
            <td><?= @$fee->class->class ?></td>
            <td><?= @$fee->session->session ?></td>
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