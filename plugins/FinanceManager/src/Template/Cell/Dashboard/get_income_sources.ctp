<?php

$labels = ['label label-warning','label label-success','label label-primary','label label-default','label label-inverse'];
$labelMax = count($labels) - 1;
//debug($labels); exit;
?>
<table class="table table-valign-middle m-b-0">
    <thead>
    <tr>
        <th>Source</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($incomeSources as $incomeSource ) : ?>
    <tr>
        <td>
            <?=  $this->Html->link($incomeSource['type'],['controller'=>'FeeCategories','action'=>'view',$incomeSource['id']],['class'=>$labels[rand(0,$labelMax)] ])  ?>
        </td>
        <td>
            <?= $this->Currency->displayCurrency($incomeSource['income_amount']) ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>