<?php
/**
 * @var \App\View\AppView $this
 */

$formTemplates = [
    'submitContainer' => '{{content}}'
];
$this->Form->setTemplates($formTemplates);
$this->extend('/Common/view');
$this->assign('title','Fees Complete');
?>
    <div class="m-b-15">
        <?= $this->Form->create('', ['class' => 'form-inline', 'type' => 'GET']) ?>
        <div class="form-group">
            <?= $this->Form->control('session_id', ['empty' => 'All', 'options' => $sessions, 'class' => 'form-control', 'data-select-id' => 'school', 'label' => ['text' => ' Change Session '], 'value' => ($this->request->getQuery('session_id')) ? $this->request->getQuery('session_id') : '']); ?>
            <?= $this->Form->control('class_id', ['empty' => 'All', 'options' => $classes, 'class' => 'form-control', 'data-select-id' => 'level', 'label' => ['text' => 'Change Class'], 'value' => ($this->request->getQuery('class_id') ? $this->request->getQuery('class_id') : '')]); ?>
            <?= $this->Form->control('term_id', ['empty' => 'All', 'options' => $terms, 'class' => 'form-control', 'data-select-id' => 'level', 'label' => ['text' => 'Change Term'], 'value' => ($this->request->getQuery('term_id') ? $this->request->getQuery('term_id') : '')]); ?>
            <?= $this->Form->submit(__('change'), [
                'class' => 'btn btn-primary']) ?>
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
        <tr>
            <th>
                Total Compulsory Fees
            </th>
            <td colspan="5">
                <?= @$this->Currency->displayCurrency($compulsoryFees) ?>
            </td>
        </tr>
    </table>

<?php if ( $feeCompleteStudents ) : ?>
    <table id="data-table" class="table table-bordered table-responsive">
        <thead>
        <tr>
            <th> Admission Number</th>
            <th> Name </th>
            <th> Class </th>
            <th> Total </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($feeCompleteStudents as $feeCompleteStudent ) : ?>
            <tr>
                <td>
                    <?= $feeCompleteStudent['student_id'] ?>
                </td>
                <td>
                    <?= $students[$feeCompleteStudent['student_id']] ?>
                </td>
                <td>
                    <?= $classes[$feeCompleteStudent['class_id']] ?>
                </td>
                <td>
                    <?= $this->Currency->displayCurrency($feeCompleteStudent['total']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>