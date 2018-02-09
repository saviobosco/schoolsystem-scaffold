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
        <?= $this->element('searchParametersSessionClassTerm'); ?>
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

<?php if ( $fees ) : ?>
    <table class="table table-bordered table-responsive">
        <thead>
        <tr>
            <th> Fee Category </th>
            <th> Expected Income </th>
            <th> Amount Received </th>
            <th> Amount Remaining </th>
            <th> Percentage Received </th>
            <th> Percentage Remaining </th>
            <th> Total Number of Students </th>
            <th> Total Number of Students Remaining </th>
            <th> Total Number of Students Paid </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($fees as $feeCategory => $details ) : ?>
            <?php $collection = new \Cake\Collection\Collection($details); ?>
            <tr>
                <td>
                    <?= $feeCategories[$feeCategory] ?>
                </td>
                <td>
                    <?php
                    $expectedIncome = $collection->sumOf(function ($data) {
                        return $data['income_amount_expected'];
                    });
                    echo $this->Currency->displayCurrency($expectedIncome);
                    ?>
                </td>
                <td>
                    <?php
                    $amountReceived = $collection->sumOf(function ($data) {
                        return $data['amount_earned'];
                    });
                    echo $this->Currency->displayCurrency($amountReceived);
                    ?>
                </td>
                <td>
                    <?php
                    $amountRemaining = $expectedIncome - $amountReceived ;
                    echo $this->Currency->displayCurrency($amountRemaining);
                    ?>
                </td>
                <td>
                    <?php
                    $percentagePaid = $amountReceived / $expectedIncome * 100 ;
                    echo \Cake\I18n\Number::precision($percentagePaid,2).'%';
                    ?>
                </td>
                <td>
                    <?php
                    $percentageRemaining = $amountRemaining / $expectedIncome * 100 ;
                    echo \Cake\I18n\Number::precision($percentageRemaining,2).'%';
                    ?>
                </td>
                <td>
                    <?php
                    $number_of_students = $collection->sumOf(function ($data) {
                        return $data['number_of_students'];
                    });
                    echo $number_of_students;
                    ?>
                </td>
                <td>
                    <?php
                    $number_of_students_remaining = $collection->sumOf(function ($data) {
                        return count($data['student_fees']);
                    });
                    echo $number_of_students_remaining.' ('.\Cake\I18n\Number::precision($number_of_students_remaining / $number_of_students * 100,2) .'%)';
                    ?>
                </td>
                <td>
                    <?php
                    $number_of_students_paid = $number_of_students - $number_of_students_remaining;
                    echo $number_of_students_paid.' ('.\Cake\I18n\Number::precision($number_of_students_paid / $number_of_students * 100,2) .'%)';
                    ?>
                </td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>