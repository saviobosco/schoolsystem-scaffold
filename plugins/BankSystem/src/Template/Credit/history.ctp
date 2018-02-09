<?php
/**
 * @var \App\View\AppView $this
 */
$this->extend('/Common/view');
$this->assign('title','Credit History');
?>
<?= $this->Form->create() ?>
    <fieldset>
        <div class="row" id="income-date-range">
            <div class="col-sm-6">
                <?= $this->Site->datePickerInput('start_date'); ?>

            </div>
            <div class="col-sm-6">
                <?= $this->Site->datePickerInput('end_date'); ?>
            </div>
        </div>
    </fieldset>
<?= $this->Form->button(__('Get Credit Transactions'),['class'=>'btn btn-primary']) ?>
<?= $this->Form->end() ?>
<div class="row m-t-20">
    <div class="col-sm-12">
        <?php if ( isset($histories)) : ?>
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <th>id </th>
                        <th> Amount </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($histories as $history) : ?>
                        <tr>
                            <td> <?= $history->id ?></td>
                            <td> <?= $history->amount ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td> Total</td>
                        <td><?php
                            $collection =  collection($histories);
                            $sum = $collection->sumOf(function($record){
                               return $record->amount;
                            });
                            echo $sum;
                            ?></td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
