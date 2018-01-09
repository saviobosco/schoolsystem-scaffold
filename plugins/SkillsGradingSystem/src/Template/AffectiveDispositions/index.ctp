<div class="row">
    <div class="col-sm-12">
        <h3><?= __('Affective Dispositions') ?></h3>
        <table class="table table-bordered ">
            <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($affectiveDispositions as $affectiveDisposition): ?>
                <tr>
                    <td><?= $this->Number->format($affectiveDisposition->id) ?></td>
                    <td><?= h($affectiveDisposition->name) ?></td>
                    <td><?= h($affectiveDisposition->created) ?></td>
                    <td><?= h($affectiveDisposition->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $affectiveDisposition->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $affectiveDisposition->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $affectiveDisposition->id], ['confirm' => __('Are you sure you want to delete # {0}?', $affectiveDisposition->id)]) ?>
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
    </div>
</div>