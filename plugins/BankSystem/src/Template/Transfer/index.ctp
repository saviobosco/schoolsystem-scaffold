<?php
/**
 * @var \App\View\AppView $this
 */
$this->extend('/Common/view');
$this->assign('title','Transfer Funds');
?>
<?= $this->Form->create() ?>
    <fieldset>
        <div class="row row-space-10" style="margin-bottom: 20px;">

            <div class="col-xs-12 col-sm-6 col-lg-6 col-md-6 m-b-15">
                <?= $this->Form->control('sender_holder_id',[
                    'id' => 'account-number',
                    'options' => $accounts,
                    'label' => 'Sender Account',
                    'empty' => 'Select Account'
                ]) ?>
            </div>
            <div class="col-xs-12 col-sm-6 col-lg-6 col-md-6 m-b-15">
                <?= $this->Form->control('receiver_holder_id',[
                    'id' => 'account-number',
                    'options' => $accounts,
                    'label' => 'Receiver Account',
                    'empty' => 'Select Account'
                ]) ?>
            </div>
        </div>
        <?= $this->Form->control('amount',[
            'placeholder' => 'Amount',
            'required' => true,
            'templates' => [
                'label' => '',
                'inputContainer' => '<div class="input-group {{type}}{{required}}"> <span class="input-group-addon"> &#8358;  </span>  {{content}} <span class="input-group-addon">.00</span></div>',
            ]
        ]) ?>
        <?= $this->Form->control('purpose',['type'=>'textarea','reqiured'=>true,'class'=>'form-control']) ?>
    </fieldset>
<?= $this->Form->button(__('Transfer Funds'),['class'=>'btn btn-primary']) ?>
<?= $this->Form->end() ?>