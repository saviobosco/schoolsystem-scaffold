<?php
$formTemplates = [
    'submitContainer' => '{{content}}'
];
$this->Form->templates($formTemplates);

$this->extend('/Common/view');
$this->assign('title','Pay Fees');
$queryData = $this->request->getQuery();
?>
<div class="profile-container">
    <!-- begin profile-section -->
    <div class="profile-section">
        <!-- begin profile-left -->
        <h2 class=""> Student Information </h2>
        <div class="profile-left">
            <!-- begin profile-image -->
            <div class="profile-image">
                <?= $this->Html->image('student-pictures/students/photo/'.$student->photo_dir.'/'.$student->photo,[
                    'alt' => $student->full_name
                ]) ?>
                <i class="fa fa-user hide"></i>
            </div>
        </div>
        <!-- end profile-left -->
        <!-- begin profile-right -->
        <div class="profile-right">
            <!-- begin profile-info -->
            <div class="profile-info">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- begin table -->
                        <div class="table-responsive table-bordered">
                            <table class="table table-user-information">
                                <tr>
                                    <th><?= __('Admission No.') ?></th>
                                    <td><?= h($student->id) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('First Name') ?></th>
                                    <td><?= h($student->first_name) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Last Name') ?></th>
                                    <td><?= h($student->last_name) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Gender') ?></th>
                                    <td><?= h($student->gender) ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('Class') ?></th>
                                    <td><?= $student->class->class ?></td>
                                </tr>
                            </table>

                        </div>
                        <!-- end table -->
                    </div>
                </div>
            </div>
            <!-- end profile-info -->
        </div>
        <!-- end profile-right -->
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <?= $this->Form->create('',['class'=>'form-inline','type'=>'GET', 'id' => 'search-form']) ?>
        <div class="form-group">
            <?= $this->Form->input('session_id',['options' => $sessions,'class'=>'form-control',
                'empty' => '--select session--',
                'label'=>'Session','value'=>(isset($queryData['session_id'])
                    && !empty($queryData['session_id'])) ? $queryData['session_id'] : '']); ?>

            <?= $this->Form->input('class_id',['options' => $classes,'class'=>'form-control',
                'label'=>'Class',
                'empty' => '--select class--',
                'value'=>(isset($queryData['class_id']) && !empty($queryData['class_id']))
                    ? $queryData['class_id'] : '']);
            ?>
            <?= $this->Form->input('term_id',['options' => $terms,'class'=>'form-control',
                'empty' => '--select term--',
                'label'=> 'Term','value'=>(isset($queryData['term_id']) && !empty($queryData['term_id']))
                    ? $queryData['term_id'] : '']); ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<h2 class=""> Student Fees </h2>
<?php if ( $studentFees ) : ?>
    <?= $this->Form->create(null) ?>
    <table class="table table-responsive table-bordered" >
        <tr>
            <th scope="col"><?= __('Fees') ?></th>
            <th scope="col"><?= __('Amount') ?></th>
            <th scope="col"><?= __('Amount Paid') ?></th>
            <th scope="col"><?= __('Class') ?></th>
            <th scope="col"><?= __('Session') ?></th>
            <th scope="col"> <?= __('Term') ?> </th>
        </tr>
        <?= $this->Form->hidden('student_id',['value' => $student->id]) ?>
        <?php $count = count($studentFees); ?>
        <?php for ($num = 0; $num < $count; $num++ ): ?>
            <tr>
                <td>
                    <?php
                    if( !is_null($studentFees[$num]['purpose'])) {
                        echo h($studentFees[$num]['purpose']);
                        $feeCategory = $studentFees[$num]['fee_category_id'];
                    } else {
                        echo h($studentFees[$num]['fee']['fee_category']['type']);
                        $feeCategory = $studentFees[$num]['fee']['fee_category']['id'];
                    }
                    ?>
                </td>
                <td>
                    <?php
                        if( $studentFees[$num]['amount_remaining'] ) {
                            echo $this->Currency->displayCurrency(($studentFees[$num]['amount_remaining']));
                        }elseif ( $studentFees[$num]['amount'] ) {
                            echo $this->Currency->displayCurrency(($studentFees[$num]['amount']));
                        } else {
                            echo $this->Currency->displayCurrency(($studentFees[$num]['fee']['amount']));
                        }
                    ?>
                </td>
                <?php
                if( $studentFees[$num]['amount_remaining'] ) {
                    $amountValue = $studentFees[$num]['amount_remaining'];
                }elseif ( $studentFees[$num]['amount'] ) {
                    $amountValue = $studentFees[$num]['amount'];
                } else {
                    $amountValue = $studentFees[$num]['fee']['amount'];
                }
                ?>
                <td style="display: none"><?= $this->Form->hidden('student_fees.'.$num.'.amount_to_pay',['value'=>$amountValue]) ?></td>
                <td style="display: none"><?= $this->Form->hidden('student_fees.'.$num.'.fee_id',['value'=>@$studentFees[$num]['fee']['id']]) ?></td>
                <td style="display: none"><?= $this->Form->hidden('student_fees.'.$num.'.fee_category_id',['value'=>@$feeCategory]) ?></td>
                <td><?= $this->Form->control('student_fees.'.$num.'.amount_paid',[
                        'id' => 'amount-paid',
                        'data-amount-to-pay' =>$amountValue,
                        'templates' => [
                            'label' => '',
                            'inputContainer' => '<div class=" col-12-6 m-b-15 input-group {{type}}{{required}}"> <span class="input-group-addon"> &#8358;  </span>  {{content}} <span class="input-group-addon">.00</span>  </div>',
                        ]
                    ]) ?></td>
                <td style="display: none"><?= $this->Form->hidden('student_fees.'.$num.'.student_fee_id',['value'=>$studentFees[$num]['id']]) ?></td>
                <td><?= h(@$classes[$studentFees[$num]['fee']['class_id']]) ?></td>
                <td><?= h(@$sessions[$studentFees[$num]['fee']['session_id']] ) ?></td>
                <td> <?= ' - ('. ( @$studentFees[$num]['fee']['term_id'] ) ? @$terms[$studentFees[$num]['fee']['term_id']] : 'All Terms' .')' ?> </td>
            </tr>
        <?php endfor; ?>
        <tr>
            <td>
                Total
            </td>
            <td>

            </td>
        </tr>
    </table>
    <div class="row m-b-15">
        <div class="col-sm-12">
            <div class="pull-right">
                <button id="pay-all" class="btn btn-primary"> Pay All </button>
                <button id="clear-all" class="btn btn-danger"> Clear All </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <?= $this->Form->control('payment.payment_made_by',['label' => 'Payment Made By', 'required'=>true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $this->Form->control('payment.payment_received_by',['label' => 'Payment Received By', 'value'=>$this->request->session()->read('Auth.User.first_name') . ' '.$this->request->session()->read('Auth.User.last_name'),'disabled'=>true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $this->Form->control('payment.payment_type_id',['label' => 'Payment Type','options'=>$paymentTypes,'required'=>true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php
            $formTemplates = [
                'label' => '<label{{attrs}}>{{text}}</label>',
            ];
            $this->Form->templates($formTemplates);
            $options = ['one'=>'Single Copy','two'=>'Two Copies'];
            echo $this->Form->control('generate_receipt',['options'=>$options,'type'=>'radio','default'=>'two']) ?>
        </div>
    </div>

    <?= $this->Form->submit(__('Pay Fees'),['class'=>'btn btn-primary']) ?>

    <?= $this->Form->end() ?>
<?php else : ?>
    <div class="alert alert-danger">
        No Fees available for this student
    </div>
<?php endif; ?>

<script>
    $(document).ready(function() {
        $('#search-form select').change(function(event) {
            loadData();
        });
        function loadData() {
            $('#search-form').submit();
        }


        $('input[data-amount-to-pay]').each(function(index){
            var input = $(this);
            input.change(function(){
                inputValue = Number(input.val());
                amountToPay = Number(input.attr('data-amount-to-pay'));
                console.log(inputValue);
                if ( inputValue > amountToPay ) {
                    input.closest('div.input-group').addClass('has-error has-feedback');
                }else if(input.closest('div.input-group').hasClass('has-error has-feedback')){
                    input.closest('div.input-group').removeClass('has-error has-feedback');
                }
            })

        });

        $('#pay-all').click(function(event){
            event.preventDefault();
            // select all inputs with data-amount-to-pay attribute
            $('input[data-amount-to-pay]').each(function (index){
                var input = $(this);
                input.val(input.attr('data-amount-to-pay'))
            })
        })
        $('#clear-all').click(function(event){
            event.preventDefault();
            $('input[data-amount-to-pay]').each(function (index){
                var input = $(this);
                input.val('')
            })
        })
    });
</script>

