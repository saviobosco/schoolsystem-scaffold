<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Edit Receipt </h4>
            </div>
            <div class="panel-body">
                <?= $this->Form->create($receipt) ?>
                <fieldset>
                    <legend><?= __('Edit Receipt') ?></legend>
                    <?php
                    echo $this->Form->control('student_id',['type'=>'text','readonly']);
                    echo $this->Form->label('Total Amount Paid');
                    echo $this->Form->control('total_amount_paid',[
                        'disabled'=>true,
                        'templates' => [
                            'label' => '',
                            'inputContainer' => '<div class=" col-12-6 m-b-15 input-group {{type}}{{required}}"> <span class="input-group-addon"> &#8358;  </span>  {{content}} <span class="input-group-addon">.00</span>  </div>',
                        ]
                    ]);
                    echo $this->Form->control('payment.payment_made_by');
                    echo $this->Form->control('payment.payment_type_id',['options'=>$paymentTypes]);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

