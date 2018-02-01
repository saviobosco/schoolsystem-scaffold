<?php $this->assign('title',$title); ?>
<div class="row m-t-20">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"><?= __('Generate Application pins') ?> </h4>
            </div>
            <div class="panel-body">
                <?= $this->Form->create() ?>
                <fieldset>
                    <legend></legend>
                    <?php
                    echo $this->Form->input('number_to_generate',['class'=>'form-control','type'=>'number','label'=>['text'=>'Numbers of pins to Generate']]);
                    echo '<label for="save_to_database"> Save to Database </label>';
                    echo $this->Form->checkbox('save_to_database',['checked'=>true]);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
                <?= $this->Html->link('Print Pins',['plugin'=>'ResultSystem','controller'=>'StudentResultPins','action'=>'print-pin'],['class'=>'pull-right btn btn-success']) ?>
            </div>
        </div>

    </div>
</div>
