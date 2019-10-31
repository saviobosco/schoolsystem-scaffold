<?php
$this->extend('/Common/view');
$this->assign('title','Student Types');
?>
<table id="data-table" class="table table-responsive ">
    <thead>
    <tr>
        <th><?= __('Name') ?></th>
        <th> Default Selection</th>
        <th class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($studentTypes as $studentType): ?>
        <tr>
            <td><?= h($studentType->name) ?></td>
            <td>
                <?php if ($studentType->default_selection) : ?>
                    <i class="text-success text-center fa fa-check"></i>
                <?php else: ?>
                    <i class="text-danger text-center fa fa-times"></i>
                <?php endif; ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $studentType->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $studentType->id], [ 'confirm' => __('Are you sure you want to delete {0}?', $studentType->name)]) ?>
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
    <?= $this->Form->create(null,['_name' => 'student_types:store']) ?>
    <fieldset>
        <legend><?= __('Add Student Type') ?></legend>
        <?php
        echo $this->Form->input('name',['type'=>'text']);
        echo $this->Form->input('default_selection',['type'=>'checkbox', 'label' => 'Default (Selected By Default)']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success m-t-20']) ?>
    <?= $this->Form->end() ?>
</div>


