<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= __('Result Grading Systems') ?> </h4>
            </div>
            <div class="panel-body">
                <?= $this->Form->create($resultGradingSystem) ?>
                <fieldset>
                    <legend><?= __('Add Result Grading System') ?></legend>
                    <?php
                    echo $this->Form->input('score');
                    echo $this->Form->input('grade');
                    echo $this->Form->input('remark');
                    echo $this->Form->input('cal_order',['type'=>'number']);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'),['class' => 'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>

</div>