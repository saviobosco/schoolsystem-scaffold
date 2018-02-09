<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Receipt $receipt
  */
$this->extend('/Common/view');
$this->assign('title','View Receipt');
?>
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
    <h4><?= __('Receipt Details') ?></h4>
    <?php if (!empty($receiptDetails)): ?>
        <table class="table table-bordered">
            <?php foreach ($receiptDetails as $studentFeePayment): ?>
                <tr>
                    <td>
                        <?php
                        if ( !empty($studentFeePayment['student_fee']['purpose'])) {
                            echo h($studentFeePayment['student_fee']['purpose']);
                        } else {
                            echo h($studentFeePayment['student_fee']['fee']['fee_category']['type'].' ('.$classes[$studentFeePayment['student_fee']['fee']['class_id']].'/'.$sessions[$studentFeePayment['student_fee']['fee']['session_id']].'/'.$terms[$studentFeePayment['student_fee']['fee']['term_id']].')' );
                        }
                        ?>
                    </td>
                    <td><?= $this->Currency->displayCurrency($studentFeePayment['amount_paid']) ?></td>
                </tr>
            <?php endforeach; ?>
            <tr >
                <td class="text-right"> <b>Total </b> </td>
                <td> <?= $this->Currency->displayCurrency($receipt->total_amount_paid) ?></td>
            </tr>
            <tr>
                <td class="text-right"> <b> Balance</b></td>
                <td> <?= $this->Currency->displayCurrency($this->Payment->calculateFeesBalance($receiptDetails)) ?></td>
            </tr>
        </table>
    <?php endif; ?>
</div>

<?= $this->Html->link('Print Receipt',['action'=>'printReceipt',$receipt->id],['class'=>'btn btn-primary']) ?>
