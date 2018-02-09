<?php
/**
  * @var \App\View\AppView $this
  * @var \FinanceManager\Model\Entity\Student $student
  */
use Cake\I18n\Time;
$this->extend('/Common/view');
$this->assign('title','View student');
?>
<div>
    <?= $this->Html->link('Pay Student Fees <i class="fa fa-money"></i>',[
        'controller'=>'StudentFees',
        'action'=>'getStudentFees',
        $student->id,
    ], [
            'escape' => false,
            'class'=>'btn btn-sm btn-primary m-r-5'
        ]
    ) ?>

    <?= $this->Html->link('Get Student Bill <i class="fa fa-bars"></i>',[
        'controller'=>'StudentFees',
        'action'=>'getStudentBill',
        $student->id,
    ], [
            'escape' => false,
            'class'=>'btn btn-sm btn-primary m-r-5'
        ]
    ) ?>

    <?= $this->Html->link('View Student Payment Record <i class="fa fa-database"></i>',[
        'controller'=>'StudentPayments',
        'action'=>'studentPaymentRecord',
        $student->id,
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
                <?= $this->Html->image('student-pictures/students/photo/'.$student->photo_dir.'/'.$student->photo,[
                    'alt' => $student->first_name
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
                            <td><?= h($student->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Full Name') ?></th>
                            <td><?= h($student->full_name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Gender') ?></th>
                            <td><?= h($student->gender) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Date Of Birth') ?></th>
                            <td><?php echo (new Time($student->date_of_birth))->format('l jS \\of F, Y'); ?></td>
                        </tr>
                        <tr>
                            <th><?= __('State Of Origin') ?></th>
                            <td><?= h($student->state_of_origin) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Home Residence') ?></th>
                            <td><?= h($student->home_residence) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Class') ?></th>
                            <td><?= $student->class->class ?></td>
                        </tr>
                    </table>

                    <div class="m-t-40">
                        <h2> Guardian Information</h2>
                        <table class="table table-user-information">
                            <tr>
                                <th><?= __('Guardian') ?></th>
                                <td><?= h($student->guardian) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Relationship To Guardian') ?></th>
                                <td><?= h($student->relationship_to_guardian) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Occupation Of Guardian') ?></th>
                                <td><?= h($student->occupation_of_guardian) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Guardian Phone Number') ?></th>
                                <td><?= h($student->guardian_phone_number) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- end table -->
            </div>
            <!-- end profile-info -->
        </div>
        <!-- end profile-right -->
    </div>
</div>

<div class="related">
    <h4><?= __('Related Student Fees') ?></h4>
    <?php if (!empty($studentFees)): ?>
        <table class="table table-bordered table-responsive " >
            <tr>
                <th scope="col"><?= __('Fee Purpose') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Paid') ?></th>
                <th scope="col"><?= __('Class') ?></th>
                <th scope="col"><?= __('Session') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($studentFees as $studentFee): ?>
                <tr>
                    <td>
                        <?php
                            if( !is_null($studentFee['purpose'])) {
                                echo $studentFee['purpose'];
                            } else {
                                echo $studentFee['fee']['fee_category']['type'];
                            }
                        ?>
                    </td>
                    <td>
                        <?php if ($studentFee['amount_remaining']) {
                            echo $this->Currency->displayCurrency($studentFee['amount_remaining']);
                        }elseif($studentFee['amount']) {
                            echo $this->Currency->displayCurrency($studentFee['amount']);
                        }else {
                            echo $this->Currency->displayCurrency($studentFee['fee']['amount']);
                        } ?>
                    </td>
                    <td><?= $this->Payment->displayPaidStatus($studentFee['paid']) ?></td>
                    <td><?= h(@$classes[$studentFee['fee']['class_id']]) ?></td>
                    <td><?= h(@$sessions[$studentFee['fee']['session_id']] ).'--'.h('('.(@$studentFee['fee']['term_id'])? @$terms[$studentFee['fee']['term_id']] : '' .')' ) ?></td>
                    <td class="actions">
                        <?= $this->Form->postLink('<i class="fa fa-trash"></i>', ['controller' => 'StudentFees', 'action' => 'delete', $studentFee['id']], ['confirm' => __('Are you sure you want to delete # {0}?', $studentFee['id']),'escape'=>false,'class'=>'btn btn-danger btn-sm']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>

<div>
    <?= $this->Html->link('Pay Student Fees <i class="fa fa-money"></i>',[
        'controller'=>'StudentFees',
        'action'=>'getStudentFees',
        $student->id,
    ], [
            'escape' => false,
            'class'=>'btn btn-sm btn-primary m-r-5'
        ]
    ) ?>

    <?= $this->Html->link('Get Student Bill <i class="fa fa-bars"></i>',[
        'controller'=>'StudentFees',
        'action'=>'getStudentBill',
        $student->id,
    ], [
            'escape' => false,
            'class'=>'btn btn-sm btn-primary m-r-5'
        ]
    ) ?>

    <?= $this->Html->link('View Student Payment Record <i class="fa fa-database"></i>',[
        'controller'=>'StudentPayments',
        'action'=>'studentPaymentRecord',
        $student->id,
    ], [
            'escape' => false,
            'class'=>'btn btn-sm btn-success m-r-5'
        ]
    ) ?>
</div>