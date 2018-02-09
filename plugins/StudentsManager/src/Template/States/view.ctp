<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $state
 */
$this->extend('/Common/view');
$this->assign('title','View State');
?>
<h3><?= h($state->state) ?></h3>
<table class="table table-responsive table-bordered">
    <tr>
        <th scope="row"><?= __('State') ?></th>
        <td><?= h($state->state) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Id') ?></th>
        <td><?= $this->Number->format($state->id) ?></td>
    </tr>
</table>
