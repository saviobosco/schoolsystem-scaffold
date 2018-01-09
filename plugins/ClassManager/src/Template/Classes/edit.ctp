<?php
/**
 * @var \App\View\AppView $this
 */
?>

<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Edit Class </h4>
            </div>
            <div class="panel-body">

                <?= $this->Form->create($class) ?>
                <fieldset>
                    <legend><?= __('Edit Class') ?></legend>
                    <?php
                    echo $this->Form->input('class');
                    echo $this->Form->input('block_id');
                    echo $this->Form->input('no_of_subjects',['label'=>['text'=>'No of Subjects Offered']]);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'),['class'=>'btn btn-success btn-sm']) ?>
                <?= $this->Form->end() ?>

            </div>
        </div>

    </div>
</div>