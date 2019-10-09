<?php
$this->extend('/Common/view');
$this->assign('title','Nationalities');
?>
<table id="data-table" class="table table-responsive ">
    <thead>
    <tr>
        <th><?= __('Religion') ?></th>
        <th> Default Selection</th>
        <th class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($nationalities as $nationality): ?>
        <tr>
            <td><?= h($nationality->nationality) ?></td>
            <td>
                <?php if ($nationality->default_selection) : ?>
                    <i class="text-success text-center fa fa-check"></i>
                <?php else: ?>
                    <i class="text-danger text-center fa fa-times"></i>
                <?php endif; ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $nationality->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $nationality->id], [ 'confirm' => __('Are you sure you want to delete {0}?', $nationality->nationality)]) ?>
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
    <?= $this->Form->create(null,['_name' => 'nationalities:store']) ?>
    <fieldset>
        <legend><?= __('Add Nationality') ?></legend>
        <?php
        echo $this->Form->input('nationality',['type'=>'text']);
        echo $this->Form->input('default_selection',['type'=>'checkbox', 'label' => 'Default (Selected By Default)']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-success m-t-20']) ?>
    <?= $this->Form->end() ?>
</div>


