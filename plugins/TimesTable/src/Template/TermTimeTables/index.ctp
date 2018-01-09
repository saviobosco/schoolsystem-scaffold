<?php
use Cake\I18n\Time;
?>
<div class="row">
    <div class="col-sm-12">
        <h3><?= __('Term Time Tables') ?></h3>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= h('term') ?></th>
                <th><?= $this->Paginator->sort('start_date') ?></th>
                <th><?= $this->Paginator->sort('end_date') ?></th>
                <th><?= h('session') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($termTimeTables as $termTimeTable): ?>
                <tr>
                    <td><?= $this->Number->format($termTimeTable->id) ?></td>
                    <td><?= $termTimeTable->term->name ?></td>
                    <td><?= (new Time($termTimeTable->start_date))->format('l jS \\of F, Y')  ?></td>
                    <td><?= (new Time($termTimeTable->end_date))->format('l jS \\of F, Y') ?></td>
                    <td><?= $termTimeTable->session->session ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $termTimeTable->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $termTimeTable->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $termTimeTable->id], ['confirm' => __('Are you sure you want to delete # {0}?', $termTimeTable->id)]) ?>
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
