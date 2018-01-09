<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $resultRemark
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Result Remark'), ['action' => 'edit', $resultRemark->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Result Remark'), ['action' => 'delete', $resultRemark->id], ['confirm' => __('Are you sure you want to delete # {0}?', $resultRemark->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Result Remarks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Result Remark'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Terms'), ['controller' => 'Terms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Term'), ['controller' => 'Terms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Classes'), ['controller' => 'Classes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Class'), ['controller' => 'Classes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sessions'), ['controller' => 'Sessions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session'), ['controller' => 'Sessions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="resultRemarks view large-9 medium-8 columns content">
    <h3><?= h($resultRemark->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Result Remark Input Main Value') ?></th>
            <td><?= h($resultRemark->result_remark_input_main_value) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Full Name') ?></th>
            <td><?= h($resultRemark->full_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Class') ?></th>
            <td><?= $resultRemark->has('class') ? $this->Html->link($resultRemark->class->id, ['controller' => 'Classes', 'action' => 'view', $resultRemark->class->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Session') ?></th>
            <td><?= $resultRemark->has('session') ? $this->Html->link($resultRemark->session->id, ['controller' => 'Sessions', 'action' => 'view', $resultRemark->session->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($resultRemark->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($resultRemark->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($resultRemark->modified) ?></td>
        </tr>
    </table>
</div>
