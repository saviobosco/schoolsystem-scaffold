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
<div class="m-b-20">
    <?= $this->element('searchParametersSessionClassTerm'); ?>
</div>

<?php
if ( $compulsoryFees ) {
    $feeCollection = new \Cake\Collection\Collection($compulsoryFees);
    $feesTotal = $feeCollection->sumOf(function ($data) {
        // if $data->amount_remaining is set return it else return $data->fee->amount
        return  $data['amount'];
    });
}
?>
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
                <?= @$this->Currency->displayCurrency($feesTotal) ?>
            </td>
        </tr>
    </table>

<?php if ( $feeCompleteStudents ) : ?>
    <table id="data-table" class="table table-bordered table-responsive">
        <thead>
        <tr>
            <th> Admission Number</th>
            <th> Name </th>
            <th> Total </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($feeCompleteStudents as $feeCompleteStudent => $details ) : ?>
            <?php
            $collection = new \Cake\Collection\Collection($details);
            ?>
            <?php
            $studentTotal = $collection->sumOf(function ($data) {
                // if $data->amount_remaining is set return it else return $data->fee->amount
                return  $data['fee']['amount'];
            });
            if ( $studentTotal >= $feesTotal ) :
                ?>
                <tr>
                    <td>
                        <?= $feeCompleteStudent ?>
                    </td>
                    <td>
                        <?= $students[$feeCompleteStudent] ?>
                    </td>
                    <td>
                        <?php
                        echo $this->Currency->displayCurrency($studentTotal);
                        ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>