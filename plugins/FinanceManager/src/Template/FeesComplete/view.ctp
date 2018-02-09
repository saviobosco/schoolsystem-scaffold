<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fee $fee
 */
$this->extend('/Common/view');
$this->assign('title','Fee Complete');
?>
<table class="table table-responsive">
    <tr>
        <th scope="row"><?= __('Fee Category') ?></th>
        <td><?= $fee->fee_category->type ?></td>
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
        <th scope="row"><?= __('Amount') ?></th>
        <td><?= $this->Currency->displayCurrency($fee->amount) ?></td>
    </tr>
</table>
<div class="related">
    <h4><?= __(' Student Fees') ?></h4>
    <?php if (!empty($fee->student_fees)): ?>
        <table id="data-table" class="table table-responsive table-bordered" >
            <thead>
            <tr>
                <th scope="col"><?= __('Admission Number') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($fee->student_fees as $studentFees): ?>
                <tr>
                    <td><?= h($studentFees->student_id) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>