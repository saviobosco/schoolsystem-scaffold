<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $accountHolder
 */
$this->extend('/Common/view');
$this->assign('title','View Account');
?>
<h3><?= h($accountHolder->id) ?></h3>
<table class="table table-responsive table-bordered">
    <tr>
        <th scope="row"><?= __('Full Name') ?></th>
        <td><?= h($accountHolder->full_name) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Account Type') ?></th>
        <td><?= $accountHolder->account_type ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Status') ?></th>
        <td><?= ($accountHolder->status) ? '<label class="label label-success">active </label>':'<label class="label label-danger"> un-active</label>' ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Created') ?></th>
        <td><?= h($accountHolder->created) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Modified') ?></th>
        <td><?= h($accountHolder->modified) ?></td>
    </tr>
</table>