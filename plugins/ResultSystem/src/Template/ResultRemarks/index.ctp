<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $resultRemarks
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= __('Result Remarks') ?> </h4>
            </div>
            <div class="panel-body">
                <table class="table table-responsive table-bordered" >
                    <thead>
                    <tr>
                        <th scope="col"><?= h('Result Remark') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('full_name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('class_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('session_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($resultRemarks as $resultRemark): ?>
                        <tr>
                            <td><?= h($resultRemark->result_remark_input->replacement) ?></td>
                            <td><?= h($resultRemark->full_name) ?></td>
                            <td><?= $resultRemark->class->class ?></td>
                            <td><?= $resultRemark->session->session ?></td>
                            <td><?= h($resultRemark->created) ?></td>
                            <td><?= h($resultRemark->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $resultRemark->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $resultRemark->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $resultRemark->id], ['confirm' => __('Are you sure you want to delete # {0}?', $resultRemark->id)]) ?>
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
