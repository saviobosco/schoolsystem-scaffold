<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $classDemarcations
 */
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= __('Class Demarcations') ?> </h4>
            </div>
            <div class="panel-body">

                <table class=" table table-responsive table-bordered">
                    <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th><?= $this->Paginator->sort('name') ?></th>
                        <th><?= $this->Paginator->sort('class_id') ?></th>
                        <th><?= h('Capacity Intake') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($classDemarcations as $classDemarcation): ?>
                        <tr>
                            <td><?= $this->Number->format($classDemarcation->id) ?></td>
                            <td><?= h($classDemarcation->name) ?></td>
                            <td><?= $classDemarcation->class->class ?></td>
                            <td><?= $this->Number->format($classDemarcation->capacity) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $classDemarcation->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $classDemarcation->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $classDemarcation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $classDemarcation->id)]) ?>
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

    </div>
</div>
