<div class="row">
    <div class="col-sm-12">
        <?= $this->Form->create($psychomotorSkill) ?>
        <fieldset>
            <legend><?= __('Add New Psychomotor Skill') ?></legend>
            <?php
            echo $this->Form->input('name');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>