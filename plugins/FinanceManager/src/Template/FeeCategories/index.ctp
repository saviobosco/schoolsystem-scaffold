<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\FeeCategory[]|\Cake\Collection\CollectionInterface $feeCategories
  */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Fee Categories  </h4>
            </div>
            <div class="panel-body">

                <h3><?= __('Fee Categories') ?></h3>
                <?= $this->Html->link('Add New Category',['plugin'=>'FinanceManager','Controller'=>'FeeCategories','action'=>'add'],['class'=>'pull-right']) ?>
                <table class="table table-responsive table-bordered">
                    <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= __('type') ?></th>
                        <th scope="col"><?= __('Description') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($feeCategories as $feeCategory): ?>
                        <tr>
                            <td><?= $this->Number->format($feeCategory->id) ?></td>
                            <td><?= h($feeCategory->type) ?></td>
                            <td><?= h($feeCategory->description) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $feeCategory->id],['escape'=>false,'class'=>'btn btn-primary btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $feeCategory->id],['escape'=>false,'class'=>'btn btn-info btn-sm']) ?>
                                <?= $this->Form->postLink('<i class="fa fa-trash"> </i>', ['action' => 'delete', $feeCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $feeCategory->id),'escape'=>false,'class'=>'btn btn-danger btn-sm']) ?>
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
