<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= __('Edit Expenditure') ?> </h4>
            </div>
            <div class="panel-body">
                <?= $this->Form->create($expenditure) ?>
                <fieldset>
                    <?php
                    echo $this->Form->control('expenditure_categories_id', ['options' => $expenditureCategories]);
                    //echo $this->Form->control('date');
                    echo $this->Form->control('amount',[
                        'id' => 'amount',
                        'type' => 'text',
                        'templates' => [
                            'label' => '',
                            'inputContainer' => '<div class=" col-12-6 m-b-15 input-group {{type}}{{required}}"> <span class="input-group-addon"> &#8358;  </span>  {{content}} <span class="input-group-addon">.00</span></div>',
                        ]
                    ]);
                    echo $this->Form->control('purpose');
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Update'),['class'=>'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
