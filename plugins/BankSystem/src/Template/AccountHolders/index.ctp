<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $accountHolders
 */
$this->extend('/Common/view');
$this->assign('title','Account Holders');
?>
<table id="data-table" class="table table-responsive table-bordered">
    <thead>
    <tr>
        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
        <th scope="col"><?= h('Full Name') ?></th>
        <th scope="col"><?= $this->Paginator->sort('account_type_id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('created') ?></th>
        <th scope="col"><?= h('Balance') ?></th>
        <th scope="col"><?= $this->Paginator->sort('status') ?></th>
        <th scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($accountHolders as $accountHolder): ?>
        <tr>
            <td><?= $this->Number->format($accountHolder->id) ?></td>
            <td><?= h($accountHolder->full_name) ?></td>
            <td><?= $accountHolder->account_type['type'] ?></td>
            <td><?= h($accountHolder->created) ?></td>
            <td><?= (is_null($accountHolder->e_wallet)) ? '0': h($accountHolder->e_wallet['amount']) ?></td>
            <td><?= ($accountHolder->status) ? '<label class="label label-success">active </label>':'<label class="label label-danger"> un-active</label>' ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $accountHolder->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $accountHolder->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $accountHolder->id], ['confirm' => __('Are you sure you want to delete # {0}?', $accountHolder->id)]) ?>
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