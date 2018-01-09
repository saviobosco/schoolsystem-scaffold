<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= __('Subjects') ?> </h4>
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-bordered table-responsive">
                    <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('name') ?></th>
                        <th><?= $this->Paginator->sort('block_id') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($subjects as $subject): ?>
                        <tr>
                            <td><?= h($subject->name) ?></td>
                            <td><?= $subject->block->name ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('<i class="fa fa-folder-o"> </i> View Results'), ['action' => 'view', $subject->id],['escape'=>false,'class'=>'btn btn-primary btn-sm']) ?>
                                <?= $this->Html->link(__('<i class="fa fa-edit"></i> Edit Results'), ['action' => 'edit_result', $subject->id],['escape'=>false,'class'=>'btn btn-info btn-sm']) ?>
                                <?= $this->Html->link(__('<i class="fa fa-plus"></i> Add Result'), ['action' => 'addResult', $subject->id],['escape'=>false,'class'=>'btn btn-success btn-sm']) ?>

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