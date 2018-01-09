<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Receipt $receipt
  */
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= h($receipt->id) ?>   </h4>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-responsive">
                    <tr>
                        <th scope="row"><?= __('Ref Number') ?></th>
                        <td><?= $this->Number->format($receipt->id) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Student') ?></th>
                        <td><?= $receipt->student->id ?> </td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Created on') ?></th>
                        <td><?= h($receipt->created) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Last Modified on') ?></th>
                        <td><?= h($receipt->modified) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Created By') ?></th>
                        <td><?= h($receipt->created_by_user->first_name.' '.$receipt->created_by_user->last_name) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Last Modified By') ?></th>
                        <td><?= h($receipt->modified_by_user->first_name.' '.$receipt->modified_by_user->last_name) ?></td>
                    </tr>
                    <tr>
                        <td> <?= __('Payment Made by') ?> </td>
                        <td> <?= $receipt->payment->payment_made_by ?> </td>
                    </tr>
                    <tr>
                        <td> <?= __('Payment Type ') ?> </td>
                        <td> <?= $receipt->payment->payment_type->type ?> </td>
                    </tr>
                </table>
                <div class="related">
                    <h4><?= __('Related Student Fee Payments') ?></h4>
                    <?php if (!empty($receipt->student_fee_payments)): ?>
                        <table class="table table-bordered">
                            <?php foreach ($receipt->student_fee_payments as $studentFeePayments): ?>
                                <tr>
                                    <td><?= h($studentFeePayments->student_fee->fee->fee_category->type) ?></td>
                                    <td><?= $this->Currency->displayCurrency($studentFeePayments->amount_paid) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr >
                                <td class="text-right"> <b>Total </b> </td>
                                <td> <?= $this->Currency->displayCurrency($receipt->total_amount_paid) ?></td>
                            </tr>
                            <tr>
                                <td class="text-right"> <b> Balance</b></td>
                                <td> <?= $this->Currency->displayCurrency($this->Payment->calculateFeesBalance($receipt->student_fee_payments)) ?></td>
                            </tr>
                        </table>
                    <?php endif; ?>
                </div>

                <?= $this->Html->link('Print Receipt',['action'=>'printReceipt',$receipt->id],['class'=>'btn btn-primary']) ?>
            </div>
        </div>
    </div>
</div>

