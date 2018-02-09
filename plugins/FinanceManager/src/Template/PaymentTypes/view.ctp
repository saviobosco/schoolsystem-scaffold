<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $paymentType
 */
$this->extend('/Common/view');
$this->assign('title','View Payment Type');
?>
<table class="table table-responsive table-bordered">
    <tr>
        <th scope="row"><?= __('Type') ?></th>
        <td><?= h($paymentType->type) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Created') ?></th>
        <td><?= h($paymentType->created) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Modified') ?></th>
        <td><?= h($paymentType->modified) ?></td>
    </tr>
</table>
