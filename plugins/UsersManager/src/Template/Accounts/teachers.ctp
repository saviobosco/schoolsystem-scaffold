<?php
use Cake\I18n\Time;
?>
<?= $this->assign('title',$title); ?>
<div class="col-sm-12">
    <h3><?= __('Teachers') ?></h3> <?= $this->Html->link(' <i class="fa fa-plus-square-o"></i> '.__('Add New Admin'), ['action' => 'add'],['escape'=>false,'class'=>'btn btn-primary pull-right','title'=>'Add New Teacher']) ?>
    <table class="table table-responsive table-hover">
        <thead>
        <tr>
            <th> <?= __('Username') ?></th>
            <th><?= h('Name') ?></th>
            <th><?= $this->Paginator->sort('role') ?></th>
            <th><?= __('is superuser') ?></th>
            <th><?= __('is active') ?></th>
            <!--<th><?= __('Last seen') ?></th> -->
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr class="user-checkbox">
                <td> <?= h($user->username) ?> </td>
                <td><?= h($user->full_name) ?></td>
                <td><?= h($user->role) ?></td>
                <th><?php if ($user->is_superuser) {echo '<i class="text-success">Yes</i>';}else{ echo '<span class="text-danger">No</span>';} ?></th>
                <th><?php if ($user->active) {echo '<i class="text-success">Yes</i>';}else{ echo '<span class="text-danger">No</span>';} ?></th>
                <!--<td><?php $time = new Time($user->last_seen); echo $time->timeAgoInWords([
                    'accuracy' => ['month' => 'month'],
                    'end' => '1 year'])?></td> -->
                <td class="actions">
                    <?= $this->Html->link('<i class="-eye"></i>'.__('view'), ['action' => 'view' ,$user->id,'?'=>['role'=>$user->role]],['escape'=>false,'class'=>'text-primary']) ?>
                    <?= $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', ['action' => 'edit', $user->id],['escape'=>false,'class'=>'text-info']) ?>
                    <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>'.__('delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id),'escape'=>false,'class'=>'text-danger']) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-sm-12">
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