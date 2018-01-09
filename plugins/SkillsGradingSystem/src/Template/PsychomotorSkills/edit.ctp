<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $psychomotorSkill->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $psychomotorSkill->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Psychomotor Skills'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="psychomotorSkills form large-9 medium-8 columns content">
    <?= $this->Form->create($psychomotorSkill) ?>
    <fieldset>
        <legend><?= __('Edit Psychomotor Skill') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
