
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title"> Add New Session </h4>
                </div>
            <div class="panel-body">
                <h3><?= __('Sessions') ?></h3>
                <table id="data-table" class="table table-responsive table-bordered">
                    <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id') ?></th>
                        <th><?= $this->Paginator->sort('session') ?></th>
                        <th><?= $this->Paginator->sort('created') ?></th>
                        <th><?= $this->Paginator->sort('modified') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($sessions as $session): ?>
                        <tr>
                            <td><?= $this->Number->format($session->id) ?></td>
                            <td><?= h($session->session) ?></td>
                            <td><?= h($session->created) ?></td>
                            <td><?= h($session->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $session->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $session->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $session->id], ['confirm' => __('Are you sure you want to delete # {0}?', $session->id)]) ?>
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

                <div>
                    <?= $this->Form->create(null,['url'=>['controller'=>'Sessions','action'=>'add']]) ?>
                    <fieldset>
                        <legend><?= __('Add New Session') ?></legend>
                        <?php
                        echo $this->Form->input('session',['type'=>'text']);
                        ?>
                    </fieldset>
                    <?= $this->Form->button(__('Submit')) ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
