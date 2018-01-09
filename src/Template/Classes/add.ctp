<div class="row">
    <div class="col-sm-12">
        <?= $this->Form->create($class) ?>
        <fieldset>
            <legend><?= __('Add Class') ?></legend>
            <?php
            echo $this->Form->input('class');
            echo $this->Form->input('block_id');
            echo $this->Form->input('no_of_subjects',['label'=>['text'=>'No of Subjects Offered']]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>