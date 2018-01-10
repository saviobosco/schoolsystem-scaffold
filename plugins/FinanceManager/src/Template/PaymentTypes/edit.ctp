<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Edit Payment Type </h4>
            </div>
            <div class="panel-body">
                <?= $this->Form->create($paymentType) ?>
                <fieldset>
                    <legend><?= __('Edit Payment Type') ?></legend>
                    <?php
                    echo $this->Form->control('type');
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>