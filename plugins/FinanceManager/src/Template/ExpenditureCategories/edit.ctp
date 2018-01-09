<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= __('Edit Expenditure Category') ?> </h4>
            </div>
            <div class="panel-body">
                <?= $this->element('category_links',['id'=>$expenditureCategory->id]) ?>

                <?= $this->Form->create($expenditureCategory) ?>
                <fieldset>
                    <?php
                    echo $this->Form->control('type');
                    echo $this->Form->control('description');
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
