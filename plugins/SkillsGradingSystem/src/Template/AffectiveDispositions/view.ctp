<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Affective Disposition'), ['action' => 'edit', $affectiveDisposition->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Affective Disposition'), ['action' => 'delete', $affectiveDisposition->id], ['confirm' => __('Are you sure you want to delete # {0}?', $affectiveDisposition->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Affective Dispositions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Affective Disposition'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="affectiveDispositions view large-9 medium-8 columns content">
    <h3><?= h($affectiveDisposition->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($affectiveDisposition->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($affectiveDisposition->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($affectiveDisposition->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($affectiveDisposition->modified) ?></td>
        </tr>
    </table>
</div>
