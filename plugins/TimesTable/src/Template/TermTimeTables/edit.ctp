<div class="row">
    <div class="col-sm-12">
        <?= $this->Form->create($termTimeTable) ?>
        <fieldset>
            <legend><?= __('Edit Term Time Table') ?></legend>
            <?php
            echo $this->Form->input('start_date');
            echo $this->Form->input('end_date');
            echo $this->Form->input('term_id', ['options' => $terms]);
            echo $this->Form->input('session_id', ['options' => $sessions]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>