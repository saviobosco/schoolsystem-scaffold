<?php
/**
 * @var \App\View\AppView $this
 */

$formTemplates = [
    'submitContainer' => '{{content}}'
];
$this->Form->setTemplates($formTemplates);
$this->extend('/Common/view');
$this->assign('title','Fees Defaulters');
?>
    <div class="m-b-15">
        <?= $this->Form->create('',['class'=>'form-inline','type'=>'GET', 'id' => 'search-form']) ?>
        <div class="form-group">
            <?= $this->Form->control('session_id',['empty' => 'All','options' => $sessions,'class'=>'form-control','data-select-id'=>'school','label'=>['text'=>' Change Session '],'value'=>($this->request->getQuery('session_id')) ? $this->request->getQuery('session_id') : '']); ?>
            <?= $this->Form->control('class_id',['empty' => 'All','options' => $classes,'class'=>'form-control','data-select-id'=>'level','label'=>['text'=>'Change Class'],'value'=>($this->request->getQuery('class_id') ? $this->request->getQuery('class_id') : '')]); ?>
            <?= $this->Form->control('term_id',['empty' => 'All','options' => $terms,'class'=>'form-control','data-select-id'=>'level','label'=>['text'=>'Change Term'],'value'=>($this->request->getQuery('term_id') ? $this->request->getQuery('term_id') : '' ) ]); ?>
            <?= $this->Form->control('percentage',['options' => [''=>'Empty',25=>'25%',50=>'50%',75=>'75%'],'class'=>'form-control','label'=>['text'=>'Percentage Owing'],'value'=>($this->request->getQuery('percentage')) ? $this->request->getQuery('percentage') :'' ]); ?>
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
            <th> Percentage Owing </th>
            <td> <?= ($this->request->getQuery('percentage')) ? $this->request->getQuery('percentage').'%' : 'None' ?> </td>
        </tr>
        <tr>
            <td> Total Amount </td>
            <td colspan="3"> <?= $compulsoryFees ?> </td>
        </tr>
    </table>
<?php
$getQuery = $this->request->getQuery();
?>
<?php if ( $feeDefaulters ) : ?>
    <table id="data-table" class="table table-bordered table-responsive">
        <thead>
        <tr>
            <th> Admission Number</th>
            <th> Name </th>
            <th> Class</th>
            <th> Total </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($feeDefaulters as $defaulter ) : ?>
            <tr>
                <td>
                    <?= $defaulter['student_id'] ?>
                </td>
                <td>
                    <?= $students[$defaulter['student_id']] ?>
                </td>
                <td>
                    <?= $classes[$defaulter['class_id']] ?>
                </td>
                <td>
                    <?= $this->Currency->displayCurrency($defaulter['total']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<script>
    $('select').change(function(event) {
        loadData();
    });

    function loadData() {
        $('#search-form').submit();
    }
</script>
