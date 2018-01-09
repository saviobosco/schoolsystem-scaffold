<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-danger ">
            <p>Please</p>
        </div>
        <?= $this->Html->link(__('New Grade'),['plugin'=>'ResultSystem','controller'=>'ResultGradingSystems','action'=>'add'],['class' => 'pull-right btn btn-primary']) ?>
        <h3><?= __('Result Grading Systems') ?></h3>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th><?= $this->Paginator->sort('grade') ?></th>
                <th><?= $this->Paginator->sort('score') ?></th>
                <th><?= $this->Paginator->sort('remark') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($resultGradingSystems as $resultGradingSystem): ?>
                <tr>
                    <td><?= h($resultGradingSystem->grade) ?></td>
                    <td><?= h($resultGradingSystem->score) ?></td>
                    <td><?= h($resultGradingSystem->remark) ?></td>
                    <td><?= h($resultGradingSystem->created) ?></td>
                    <td><?= h($resultGradingSystem->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $resultGradingSystem->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $resultGradingSystem->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $resultGradingSystem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $resultGradingSystem->id)]) ?>
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