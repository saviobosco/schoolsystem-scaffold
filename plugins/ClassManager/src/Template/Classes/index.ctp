<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $classes
 */
$this->extend('/Common/view');
$this->assign('title','Classes');
?>
<table id="data-table" class="table table-responsive ">
    <thead>
    <tr>
        <th><?= $this->Paginator->sort('class') ?></th>
        <th><?= $this->Paginator->sort('block_id') ?></th>
        <th><?= $this->Paginator->sort('Nof of Subjects Offered') ?></th>
        <th class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($classes as $class): ?>
        <tr>
            <td><?= h($class->class) ?></td>
            <td><?= h($class->block->name) ?></td>
            <td><?= h($class->no_of_subjects) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $class->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $class->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $class->id], ['confirm' => __('Are you sure you want to delete # {0}?', $class->id)]) ?>
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