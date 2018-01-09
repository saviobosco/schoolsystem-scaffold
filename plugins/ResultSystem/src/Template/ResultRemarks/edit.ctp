<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Add Result Remarks </h4>
            </div>
            <div class="panel-body">
                <?= $this->Form->create($resultRemark) ?>
                <fieldset>
                    <legend><?= __('Add Result Remark') ?></legend>
                    <?php
                    echo $this->Form->control('result_remark_input_main_value',['options'=>$remarkInputs,'label'=>'Result Remark']);
                    echo $this->Form->control('full_name');
                    echo $this->Form->control('class_id', ['options' => $classes]);
                    echo $this->Form->control('session_id', ['options' => $sessions]);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>