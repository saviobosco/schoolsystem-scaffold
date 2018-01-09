<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $affectiveDisposition->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $affectiveDisposition->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Affective Dispositions'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="affectiveDispositions form large-9 medium-8 columns content">
    <?= $this->Form->create($affectiveDisposition) ?>
    <fieldset>
        <legend><?= __('Edit Affective Disposition') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
