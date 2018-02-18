<?php
/**
 * @var \App\View\AppView $this
 */

$formTemplates = [
    'submitContainer' => '{{content}}'
];
$this->Form->setTemplates($formTemplates);
$this->extend('/Common/view');
$this->assign('title','Fees Query');
?>
    <div class="m-b-15">
        <?= $this->Form->create('',['class'=>'form-inline','type'=>'GET']) ?>
        <div class="form-group">
            <?= $this->Form->control('session_id',['empty' => 'All','options' => $sessions,'class'=>'form-control','data-select-id'=>'school','label'=>['text'=>' Change Session '],'value'=>($this->request->getQuery('session_id')) ? $this->request->getQuery('session_id') : '']); ?>
            <?= $this->Form->control('class_id',['empty' => 'All','options' => $classes,'class'=>'form-control','data-select-id'=>'level','label'=>['text'=>'Change Class'],'value'=>($this->request->getQuery('class_id') ? $this->request->getQuery('class_id') : '')]); ?>
            <?= $this->Form->control('term_id',['empty' => 'All','options' => $terms,'class'=>'form-control','data-select-id'=>'level','label'=>['text'=>'Change Term'],'value'=>($this->request->getQuery('term_id') ? $this->request->getQuery('term_id') : '' ) ]); ?>
            <?= $this->Form->submit(__('change'),[
                'class'=>'btn btn-primary']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>Session</th>
            <td> <?= ($this->request->getQuery('session_id')) ? @$sessions[$this->request->getQuery('session_id')] : 'All' ?> </td>
            <th> Class </th>
            <td> <?= ($this->request->getQuery('class_id')) ? @$classes[$this->request->getQuery('class_id')] : 'All' ?> </td>
            <th> Term </th>
            <td> <?= ($this->request->getQuery('term_id')) ? @$terms[$this->request->getQuery('term_id')] : 'All' ?> </td>
        </tr>
    </table>

<table class="table table-bordered table-responsive">
    <thead>
    <tr>
        <th> Fee Category </th>
        <th> Amount</th>
        <th> Expected Income </th>
        <th> Amount Received </th>
        <th> Amount Remaining </th>
        <th> Percentage Received </th>
        <th> Percentage Remaining </th>
        <th> Total Number of Students </th>
        <th> Total Number of Students Paid </th>
        <th> Total Number of Students Remaining </th>
    </tr>
    </thead>
    <tbody>
    <?php if ( isset($fees) && !empty($fees) ) : ?>

        <?php foreach($fees as $fee_category_id => $details ) : ?>
            <tr>
                <td>
                    <?= $feeCategories[$fee_category_id] ?>
                </td>
                <td>
                    <?= $this->Currency->displayCurrency($details['amount']) ?>
                </td>
                <td>
                    <?= $this->Currency->displayCurrency($details['expectedIncome']) ?>
                </td>
                <td>
                    <?= $this->Currency->displayCurrency($details['amountReceived']); ?>
                </td>
                <td>
                    <?= $this->Currency->displayCurrency($details['amountRemaining']); ?>
                </td>
                <td>
                    <?= $details['percentageReceived'].'%'; ?>
                </td>
                <td>
                    <?= $details['percentageRemaining'].'%'; ?>
                </td>
                <td>
                    <?= $details['numberOfStudents']; ?>
                </td>
                <td>
                    <?= $details['numberOfStudentsPaid'] ?>
                </td>
                <td>
                    <?= $details['numberOfStudentsRemaining'] ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
<?= $this->element('selectParameters') ?>
