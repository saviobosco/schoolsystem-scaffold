
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Add New Academic year </h4>
            </div>
            <div class="panel-body">
                <?= $this->Form->create($session) ?>
                <fieldset>
                    <legend><?= __('Add Session') ?></legend>
                    <?php
                    echo $this->Form->input('session');
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>

    </div>
</div>


