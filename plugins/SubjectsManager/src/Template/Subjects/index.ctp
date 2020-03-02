<?php
/**
 * @var \App\View\AppView $this
 */

$this->extend('/Common/view');
$this->assign('title', 'Subjects');
?>

<table id="data-table" class="table table-bordered ">
    <thead>
    <tr>
        <th><?= $this->Paginator->sort('id') ?></th>
        <th><?= $this->Paginator->sort('name') ?></th>
        <th><?= $this->Paginator->sort('block_id') ?></th>
        <th class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($subjects as $subject): ?>
        <tr>
            <td><?= $this->Number->format($subject->id) ?></td>
            <td><?= h($subject->name) ?></td>
            <td><?= $subject->has('block') ? $this->Html->link($subject->block->name, ['controller' => 'Blocks', 'action' => 'view', $subject->block->id]) : '' ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $subject->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $subject->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $subject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subject->id)]) ?>
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
