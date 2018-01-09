<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Add New Fee Category </h4>
            </div>
            <div class="panel-body">
                <?= $this->Form->create($feeCategory) ?>
                <fieldset>
                    <legend><?= __('Add Fee Category') ?></legend>
                    <?php
                    echo $this->Form->control('type',['label'=>'Name']);
                    echo $this->Form->control('description',['type'=>'textarea','label'=>'Description']);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Create'),['class'=>'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
