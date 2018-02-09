<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Psychomotor Skill'), ['action' => 'edit', $psychomotorSkill->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Psychomotor Skill'), ['action' => 'delete', $psychomotorSkill->id], ['confirm' => __('Are you sure you want to delete # {0}?', $psychomotorSkill->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Psychomotor Skills'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Psychomotor Skill'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="psychomotorSkills view large-9 medium-8 columns content">
    <h3><?= h($psychomotorSkill->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($psychomotorSkill->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($psychomotorSkill->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($psychomotorSkill->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($psychomotorSkill->modified) ?></td>
        </tr>
    </table>
</div>
