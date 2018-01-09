<?php
/**
 * @var \App\View\AppView $this
 */

$formTemplates = [
    'submitContainer' => '{{content}}'
];
$this->Form->setTemplates($formTemplates);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Students with Complete Fees</h4>
            </div>
            <div class="panel-body">

                <div class="m-b-15">
                    <?= $this->Form->create('',['class'=>'form-inline','type'=>'GET']) ?>
                    <div class="form-group">
                        <?= $this->Form->control('session_id',['empty'=>'All', 'options' => $sessions,'class'=>'form-control','data-select-id'=>'school','label'=>['text'=>' Change Session '],'value'=>($this->request->getQuery('session_id')) ? $this->request->getQuery('session_id') : '']); ?>
                        <?= $this->Form->control('class_id',['empty'=>'All','options' => $classes,'class'=>'form-control','data-select-id'=>'level','label'=>['text'=>'Change Class'],'value'=>($this->request->getQuery('class_id')) ? $this->request->getQuery('class_id') : '' ]); ?>
                        <?= $this->Form->control('term_id',['empty' => 'All','options' => $terms,'class'=>'form-control','data-select-id'=>'level','label'=>['text'=>'Change Term'],'value'=>($this->request->getQuery('term_id') ? $this->request->getQuery('term_id') : '') ]); ?>
                        <?= $this->Form->submit(__('change'),[
                            'class'=>'btn btn-primary']) ?>
                    </div>
                    <?= $this->Form->end() ?>
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
            </div>
        </div>
    </div>
</div>