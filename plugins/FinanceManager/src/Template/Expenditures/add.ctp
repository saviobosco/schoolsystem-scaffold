<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Add new Expenditure </h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-8">
                        <?= $this->Form->create($expenditure) ?>
                        <fieldset>
                            <?php
                            echo $this->Form->control('expenditure_category_id', ['options' => $expenditureCategories,'required'=>true]);
                            echo $this->Form->label('Amount');
                            echo $this->Form->control('amount',[
                                'id' => 'amount',
                                'type' => 'text',
                                'templates' => [
                                    'label' => '',
                                    'inputContainer' => '<div class=" col-12-6 m-b-15 input-group {{type}}{{required}}"> <span class="input-group-addon"> &#8358;  </span>  {{content}} <span class="input-group-addon">.00</span></div>',
                                ]
                            ]);
                            echo $this->Form->control('purpose');
                            echo $this->Site->datePickerInput('date');
                            ?>
                        </fieldset>
                        <?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary']) ?>
                        <?= $this->Form->end() ?>
                    </div>
                    <div class="col-sm-4">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
