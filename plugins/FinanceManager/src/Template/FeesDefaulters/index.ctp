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
        <?= $this->Form->create('',['class'=>'form-inline','type'=>'GET']) ?>
        <div class="form-group">
            <?= $this->Form->control('session_id',['empty' => 'All','options' => $sessions,'class'=>'form-control','data-select-id'=>'school','label'=>['text'=>' Change Session '],'value'=>($this->request->getQuery('session_id')) ? $this->request->getQuery('session_id') : '']); ?>
            <?= $this->Form->control('class_id',['empty' => 'All','options' => $classes,'class'=>'form-control','data-select-id'=>'level','label'=>['text'=>'Change Class'],'value'=>($this->request->getQuery('class_id') ? $this->request->getQuery('class_id') : '')]); ?>
            <?= $this->Form->control('term_id',['empty' => 'All','options' => $terms,'class'=>'form-control','data-select-id'=>'level','label'=>['text'=>'Change Term'],'value'=>($this->request->getQuery('term_id') ? $this->request->getQuery('term_id') : '' ) ]); ?>
            <?= $this->Form->control('percentage',['options' => [''=>'Empty',25=>'25%',50=>'50%',75=>'75%'],'class'=>'form-control','label'=>['text'=>'Owing Percentage'],'value'=>($this->request->getQuery('percentage')) ? $this->request->getQuery('percentage') :'' ]); ?>
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
            <th> Owing Percentage </th>
            <td> <?= ($this->request->getQuery('percentage')) ? $this->request->getQuery('percentage').'%' : 'None' ?> </td>
        </tr>
    </table>
<?php
$getQuery = $this->request->getQuery();
if ( $compulsoryFees ) {
    $feeCollection = new \Cake\Collection\Collection($compulsoryFees);
    $feesTotal = $feeCollection->sumOf(function ($data) {
        // if $data->amount_remaining is set return it else return $data->fee->amount
        return  $data['amount'];
    });
}
?>
<?php if ( $feeDefaulters ) : ?>
    <table id="data-table" class="table table-bordered table-responsive">
        <thead>
        <tr>
            <th> Admission Number</th>
            <th> Name </th>
            <th> Total </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($feeDefaulters as $defaulter => $details ) : ?>
            <?php
            $collection = new \Cake\Collection\Collection($details);
            $total = $collection->sumOf(function ($data) {
                // if $data->amount_remaining is set return it else return $data->fee->amount
                return ($data['amount_remaining']) ? $data['amount_remaining']  : $data['fee']['amount'];
            });
            if (!empty($getQuery['percentage'])) {
                // make some calculations
                // output the required result

                $studentOwingPercentage = round($total / $feesTotal * 100 );
                //debug('total '.$total);
                //debug('total Fees to Pay '.$feesTotal);
                //debug($studentOwingPercentage);
                ?>
                <? if ( $studentOwingPercentage >= $getQuery['percentage'] ) : ?>
                    <tr>
                        <td>
                            <?= $defaulter ?>
                        </td>
                        <td>
                            <?= $students[$defaulter] ?>
                        </td>
                        <td>
                            <?php
                            echo $this->Currency->displayCurrency($total);
                            ?>
                        </td>
                    </tr>
                <?php endif; ?>

            <?php } else {  ?>
                <tr>
                    <td>
                        <?= $defaulter ?>
                    </td>
                    <td>
                        <?= $students[$defaulter] ?>
                    </td>
                    <td>
                        <?php
                        echo $this->Currency->displayCurrency($total);
                        ?>
                    </td>
                </tr>
            <?php } ?>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>