<?php
$this->layout = 'receipt';
?>
<div class="row" style="margin-top: 20px">
    <div class="col-sm-6">
        <p style="color: black"> Student Copy</p>
        <div id="student-copy">
            <table class=" table table-bordered">
                <thead>
                <tr>
                    <td colspan="6">
                        <?= $this->Html->image('image-banner.png',['class'=>'img-responsive','height'=>'100px']) ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="text-center">Payment Receipt </td>
                </tr>
                </thead>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td colspan="2"><?= h($receiptDetails['student']['first_name'].' '.$receiptDetails['student']['last_name']) ?></td>
                    <th> Payment Made By</th>
                    <td colspan="2"> <?= $receiptDetails['payment']['payment_made_by'] ?></td>
                </tr>
                <tr>
                    <th><?= __('Admission No.') ?></th>
                    <td colspan="2"><?= h($receiptDetails['student']['id']) ?></td>
                    <th><?= __('Class') ?></th>
                    <td colspan="2"><?= h($receiptDetails['student']['class']['class']) ?></td>
                </tr>
                <tr>
                    <th> Receipt #</th>
                    <td><?= h($receiptDetails['id']) ?> </td>
                    <th colspan="2"> Issued On </th>
                    <td colspan="2"> <?= (new \Cake\I18n\Time($receiptDetails['created']))->format('Y-m-d') ?> </td>
                </tr>
                <?php foreach ($receiptDetails['student_fee_payments'] as $studentFeePayment): ?>
                    <tr>
                        <td colspan="5">
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
                    <td class="text-right" colspan="5"> <b>Total </b> </td>
                    <td> <?= $this->Currency->displayCurrency($receiptDetails['total_amount_paid']) ?></td>
                </tr>
                <tr>
                    <td class="text-right" colspan="5"> <b> Balance</b></td>
                    <td> <?= $this->Currency->displayCurrency($this->Payment->calculateFeesBalance($receiptDetails['student_fee_payments'])) ?></td>
                </tr>
                <!--<tr>
                    <td class="text-right" colspan="5"> <b>Arrears </b> </td>
                    <td> <?php /*$this->Currency->displayCurrency($this->Payment->calculateArrearsTotal($arrears)) */ ?></td>
                </tr> -->
            </table>
        </div>
    </div>
    <div class="col-sm-6">
        <p style="color: black" > School Copy</p>
        <div id="school-copy">
        </div>
    </div>
</div>
<div>
    <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-success"><i class="fa fa-print m-r-5"></i> Print</a>
    <?= $this->Html->link('Close','/',['class'=>'btn btn-sm btn-danger']) ?>
</div>