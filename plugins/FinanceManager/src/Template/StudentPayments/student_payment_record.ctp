<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Student $student
 */
use Cake\I18n\Time;
$this->extend('/Common/view');
$this->assign('title','Payment Record');
?>
<div>
    <?= $this->Html->link('Pay Student Fees <i class="fa fa-money"></i>',[
        'controller'=>'StudentFees',
        'action'=>'getStudentFees',
        $student['id'],
    ], [
            'escape' => false,
            'class'=>'btn btn-sm btn-primary m-r-5'
        ]
    ) ?>

    <?= $this->Html->link('Get Student Bill <i class="fa fa-bars"></i>',[
        'controller'=>'StudentFees',
        'action'=>'getStudentBill',
        $student['id'],
    ], [
            'escape' => false,
            'class'=>'btn btn-sm btn-primary m-r-5'
        ]
    ) ?>

    <?= $this->Html->link('View Student Payment Record <i class="fa fa-database"></i>',[
        'controller'=>'StudentPayments',
        'action'=>'studentPaymentRecord',
        $student['id'],
    ], [
            'escape' => false,
            'class'=>'btn btn-sm btn-success m-r-5'
        ]
    ) ?>
</div>
<div class="profile-container">

    <!-- begin profile-section -->
    <div class="profile-section">
        <!-- begin profile-left -->
        <div class="profile-left">
            <!-- begin profile-image -->
            <div class="profile-image">
                <?= $this->Html->image('student-pictures/students/photo/'.$student['photo_dir'].'/'.$student['photo'],[
                    'alt' => $student['first_name']
                ]) ?>
                <i class="fa fa-user hide"></i>
            </div>
        </div>
        <!-- end profile-left -->
        <!-- begin profile-right -->
        <div class="profile-right">
            <!-- begin profile-info -->
            <div class="profile-info">
                <!-- begin table -->
                <div class="table-responsive">
                    <table class="table table-user-information">
                        <tr>
                            <th><?= __('Admission No.') ?></th>
                            <td><?= h($student['id']) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('First Name') ?></th>
                            <td><?= h($student['first_name']) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Last Name') ?></th>
                            <td><?= h($student['last_name']) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Class') ?></th>
                            <td><?= $student['class']['class'] ?></td>
                        </tr>
                    </table>

                </div>
                <!-- end table -->
            </div>
            <!-- end profile-info -->
        </div>
        <!-- end profile-right -->
    </div>
</div>

<div class="related">
    <h4><?= __(' Payment Records ') ?></h4>
    <?php if (!empty($studentFeePayments)): ?>
        <table class="table table-bordered table-responsive " >
            <tr>
                <th scope="col"><?= __('Fees') ?></th>
                <th scope="col"><?= __('Amount Paid') ?></th>
                <th scope="col"><?= __('Amount Remaining') ?></th>
                <th scope="col"><?= __('Class') ?></th>
                <th scope="col"><?= __('Session') ?></th>
                <th scope="col"><?= __('Receipt Id') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
            </tr>

            <?php foreach($studentFeePayments as $studentFeePayment) : /* looping through the studentFeePayment */ ?>
                <tr>
                    <td><?php
                        if ( !empty($studentFeePayment['student_fee']['fee_id'])) {
                            echo $studentFeePayment['student_fee']['fee']['fee_category']['type'];
                        } else {
                            echo $studentFeePayment['student_fee']['Purpose'];
                        }
                        ?></td>
                    <td><?= $this->Currency->displayCurrency($studentFeePayment['amount_paid']) ?></td>
                    <td><?= $this->Currency->displayCurrency($studentFeePayment['amount_remaining']) ?></td>
                    <td><?= h(@$classes[$studentFeePayment['student_fee']['fee']['class_id']]) ?></td>
                    <td><?= h(@$sessions[$studentFeePayment['student_fee']['fee']['session_id']] ).'--'.h('('.(@$studentFeePayment['student_fee']['fee']['term_id'])? @$terms[$studentFeePayment['student_fee']['fee']['term_id']] : '' .')' ) ?></td>
                    <td><?= h($studentFeePayment['receipt_id']) ?></td>
                    <td><?= (new Time($studentFeePayment['created']))->format('Y-m-d H:i:s A') ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>

<div>
    <?= $this->Html->link('Pay Student Fees <i class="fa fa-money"></i>',[
        'controller'=>'StudentFees',
        'action'=>'getStudentFees',
        $student['id'],
    ], [
            'escape' => false,
            'class'=>'btn btn-sm btn-primary m-r-5'
        ]
    ) ?>

    <?= $this->Html->link('Get Student Bill <i class="fa fa-bars"></i>',[
        'controller'=>'StudentFees',
        'action'=>'getStudentBill',
        $student['id'],
    ], [
            'escape' => false,
            'class'=>'btn btn-sm btn-primary m-r-5'
        ]
    ) ?>

    <?= $this->Html->link('View Student Payment Record <i class="fa fa-database"></i>',[
        'controller'=>'StudentPayments',
        'action'=>'studentPaymentRecord',
        $student['id'],
    ], [
            'escape' => false,
            'class'=>'btn btn-sm btn-success m-r-5'
        ]
    ) ?>
</div>