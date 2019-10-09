<?php
$this->extend('/Common/view');
$this->assign('title','Medical Issues');
?>
<table id="data-table" class="table table-responsive ">
    <thead>
    <tr>
        <th><?= __('medical issue') ?></th>
        <th class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($medicalIssues as $medical): ?>
        <tr>
            <td><?= h($medical->issue) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $medical->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $medical->id], [ 'confirm' => __('Are you sure you want to delete # {0}?', $medical->issue)]) ?>
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
    <?= $this->Form->create(null,['_name' => 'medical_issues:store']) ?>
    <fieldset>
        <legend><?= __('Add Medical issue') ?></legend>
        <?php
        echo $this->Form->input('issue',['type'=>'text']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success m-t-20']) ?>
    <?= $this->Form->end() ?>
</div>


