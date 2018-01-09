<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\ExpenditureCategory[]|\Cake\Collection\CollectionInterface $expenditureCategories
  */
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= __('Expenditure Categories') ?> </h4>
            </div>
            <div class="panel-body">

                <h3><?= __('Expenditure Categories') ?></h3>
                <table class="table table-responsive table-bordered">
                    <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                        <th scope="col"><?= __('description') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($expenditureCategories as $expenditureCategory): ?>
                        <tr>
                            <td><?= $this->Number->format($expenditureCategory->id) ?></td>
                            <td><?= h($expenditureCategory->type) ?></td>
                            <td><?= h($expenditureCategory->description) ?></td>
                            <td><?= h($expenditureCategory->created) ?></td>
                            <td><?= h($expenditureCategory->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $expenditureCategory->id],['class'=>'btn btn-primary btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $expenditureCategory->id],['class'=>'btn btn-info btn-sm']) ?>
                                <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', ['action' => 'delete', $expenditureCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $expenditureCategory->id),'escape'=>false,'class'=>'btn btn-danger btn-sm']) ?>
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
            </div>
        </div>
    </div>
</div>
