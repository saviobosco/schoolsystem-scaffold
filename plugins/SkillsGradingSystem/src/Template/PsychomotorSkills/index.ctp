<?php
$this->extend('/Common/view');
$this->assign('title','Psychomotor Skills');
?>
<div class="row">
    <div class="col-sm-12">
        <h3><?= __('Psychomotor Skills') ?></h3>
        <table class="table table-bordered ">
            <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= __('name') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($psychomotorSkills as $psychomotorSkill): ?>
                <tr>
                    <td><?= $this->Number->format($psychomotorSkill->id) ?></td>
                    <td><?= h($psychomotorSkill->name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $psychomotorSkill->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $psychomotorSkill->id], ['confirm' => __('Are you sure you want to delete # {0}?', $psychomotorSkill->id)]) ?>
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

<div class="row">
    <div class="col-sm-12">
        <?= $this->Form->create(null, ['url' => ['action' => 'add']]) ?>
        <fieldset>
            <?php
            echo $this->Form->input('name');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>