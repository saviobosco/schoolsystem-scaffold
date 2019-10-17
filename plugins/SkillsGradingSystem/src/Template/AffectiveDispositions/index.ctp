<?php
$this->extend('/Common/view');
$this->assign('title','Affective Dispositions');
?>
<div class="row">
    <div class="col-sm-12">
        <h3><?= __('Affective Dispositions') ?></h3>
        <table class="table table-bordered ">
            <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= __('name') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($affectiveDispositions as $affectiveDisposition): ?>
                <tr>
                    <td><?= $this->Number->format($affectiveDisposition->id) ?></td>
                    <td><?= h($affectiveDisposition->name) ?></td>
                    <td class="actions">
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

<div class="row">
    <div class="col-sm-12">
        <?= $this->Form->create(null, ['url' => ['action' => 'add']]) ?>
        <fieldset>
            <?php
            echo $this->Form->input('name');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>