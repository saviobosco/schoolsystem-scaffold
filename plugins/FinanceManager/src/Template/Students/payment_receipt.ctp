<?php
$this->layout = 'receipt';
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Payment Receipt   </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-sm-6">
                        <p style="color: black"> Student Copy</p>
                        <div id="student-copy">
                            <table class="">
                               <thead>
                               <tr>
                                   <td colspan="6">
                                       <?= $this->Html->image('image-banner.png',['class'=>'img-responsive']) ?>
                                   </td>
                               </tr>
                               <tr>
                                   <td colspan="6" class="text-center"> Receipt </td>
                               </tr>
                               </thead>
                                <tr>
                                    <th><?= __('Name') ?></th>
                                    <td colspan="2"><?= h($student->first_name.' '.$student->last_name) ?></td>
                                    <th> Guardian</th>
                                    <td colspan="2"> <?= $student->guardian ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Admission No.') ?></th>
                                    <td colspan="2"><?= h($student->id) ?></td>
                                    <th><?= __('Class') ?></th>
                                    <td colspan="2"><?= h($student->class->class) ?></td>
                                </tr>
                                <tr>

                                    <th> Receipt #</th>
                                    <td><?= h($receiptDetails->id) ?> </td>
                                    <th colspan="2"> Issued Date </th>
                                    <td colspan="2"> <?= $receiptDetails->created ?> </td>
                                </tr>
                                <?php foreach ($receiptDetails->student_fee_payments as $studentFeePayment): ?>
                                    <tr>
                                        <td colspan="5"><?= h($studentFeePayment->student_fee->fee->fee_category->type.' ('.$classes[$studentFeePayment->student_fee->fee->class_id].'/'.$sessions[$studentFeePayment->student_fee->fee->session_id].'/'.$terms[$studentFeePayment->student_fee->fee->term_id].')' ) ?></td>
                                        <td><?= $this->Currency->displayCurrency($studentFeePayment->amount_paid) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr >
                                    <td class="text-right" colspan="5"> <b>Total </b> </td>
                                    <td> <?= $this->Currency->displayCurrency($this->Payment->calculateTotal($receiptDetails->student_fee_payments,'amount_paid')) ?></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="5"> <b> Balance</b></td>
                                    <td> <?= $this->Currency->displayCurrency($this->Payment->calculateFeesBalance($receiptDetails->student_fee_payments)) ?></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="5"> <b>Arrears </b> </td>
                                    <td> <?= $this->Currency->displayCurrency($this->Payment->calculateArrearsTotal($arrears)) ?></td>
                                </tr>
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
            </div>
        </div>

    </div>
</div>