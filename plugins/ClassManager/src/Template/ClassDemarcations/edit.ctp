<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Edit Class Division </h4>
            </div>
            <div class="panel-body">

                <?= $this->Form->create($classDemarcation) ?>
                <fieldset>
                    <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('class_id', ['options' => $classes]);
                    echo $this->Form->control('capacity',['label' => ['text' => 'Class In-take Capacity']]);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>

    </div>
</div>

