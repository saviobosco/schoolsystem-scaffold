<?php
$this->extend('/Common/view');
$this->assign('title','News Updates');
?>
<?= $this->Html->link('New News Update', [
    'controller' => 'NewsUpdates',
    'action' => 'add'],[
    'class' => 'btn btn-primary btn-sm']) ?>

<table id="data-table" class="table table-responsive ">
    <thead>
    <tr>
        <th><?= __('Title') ?></th>
        <th><?= __('Post') ?></th>
        <th> Default </th>
        <th> Created At</th>
        <th> Updated At</th>
        <th class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($newsUpdates as $newsUpdate): ?>
        <tr>
            <td><?= $newsUpdate->title ?></td>
            <td><?= $newsUpdate->post ?></td>
            <td>
                <?php if ($newsUpdate->default_post) : ?>
                    <i class="text-success text-center fa fa-check"></i>
                <?php else: ?>
                    <i class="text-danger text-center fa fa-times"></i>
                <?php endif; ?>
            </td>
            <td> <?= $newsUpdate->created ?> </td>
            <td> <?= $newsUpdate->modified ?> </td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $newsUpdate->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $newsUpdate->id], [ 'class' => 'text-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $newsUpdate->title)]) ?>
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


