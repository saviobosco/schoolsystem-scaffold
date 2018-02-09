<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Fee $fee
  */
$this->extend('/Common/view');
$this->assign('title','View Fee');
?>
<div class="m-b-15">
    <?= $this->Html->link('Get Fee Defaulters',['controller'=>'FeesDefaulters','action'=>'view',$fee->id],['class'=>'btn btn-danger m-r-15']) ?>
    <?= $this->Html->link('Get Fees Complete Students',['controller'=>'FeesComplete','action'=>'index',$fee->id],['class'=>'btn btn-success m-r-15']) ?>
</div>
<table class="table table-responsive">
    <tr>
        <th scope="row"><?= __('Fee Category') ?></th>
        <td><?= $fee->has('fee_category') ? $this->Html->link($fee->fee_category->type, ['controller' => 'FeeCategories', 'action' => 'view', $fee->fee_category->id]) : '' ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Term') ?></th>
        <td><?= $fee->term->term ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Class') ?></th>
        <td><?= $fee->class->class ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Session') ?></th>
        <td><?= $fee->session->session ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Created By') ?></th>
        <td><?= h($fee->created_by_user->first_name.' '.$fee->created_by_user->last_name) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Modified By') ?></th>
        <td><?= h($fee->modified_by_user->first_name.' '.$fee->modified_by_user->last_name) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Id') ?></th>
        <td><?= __($fee->id) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Amount') ?></th>
        <td><?= $this->Currency->displayCurrency($fee->amount) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Created') ?></th>
        <td><?= h($fee->created) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Modified') ?></th>
        <td><?= h($fee->modified) ?></td>
    </tr>
</table>
<div class="related">
    <h4><?= __(' Student Fees') ?></h4>
    <?php if (!empty($fee->student_fees)): ?>
        <table id="data-table" class="table table-responsive table-bordered" >
            <thead>
            <tr>
                <th scope="col"><?= __('Admission Number') ?></th>
                <th scope="col"><?= __('Full Name') ?></th>
                <th scope="col"><?= __('Paid') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($fee->student_fees as $studentFees): ?>
                <tr>
                    <td><?= h($studentFees->student_id) ?></td>
                    <td><?= h($studentFees->student->first_name.' '.$studentFees->student->last_name) ?></td>
                    <td><?= ($studentFees->paid) ? '<span class="label label-success">Yes  </span>' : '<span class="label label-danger"> No </span>' ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>