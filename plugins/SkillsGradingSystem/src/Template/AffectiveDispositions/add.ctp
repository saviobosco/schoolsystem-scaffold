<div class="row">
    <div class="col-sm-12">
        <?= $this->Form->create($affectiveDisposition) ?>
        <fieldset>
            <legend><?= __('Add New Affective Disposition') ?></legend>
            <?php
            echo $this->Form->input('name');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>