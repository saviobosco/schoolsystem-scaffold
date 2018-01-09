<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Edit Subject </h4>
            </div>
            <div class="panel-body">
                <?= $this->Form->create($subject) ?>
                <fieldset>
                    <legend><?= __('Edit Subject') ?></legend>
                    <?php
                    echo $this->Form->input('name');
                    echo $this->Form->input('block_id', ['options' => $blocks]);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>