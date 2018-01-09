<div class="row">
    <div class="col-sm-12">
        <?= $this->Form->create($resultGradingSystem) ?>
        <fieldset>
            <legend><?= __('Add Result Grading System') ?></legend>
            <?php
            echo $this->Form->input('score');
            echo $this->Form->input('grade');
            echo $this->Form->input('remark');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary']) ?>
        <?= $this->Form->end() ?>
    </div>

</div>