<?php
/**
 * @var \App\View\AppView $this
 */

$this->extend('/Common/view');
$this->assign('title', $subject->name);
?>
<table class="table table-bordered table-responsive ">
    <tr>
        <th><?= __('Name') ?></th>
        <td><?= h($subject->name) ?></td>
    </tr>
    <tr>
        <th><?= __('Category ') ?></th>
        <td><?= h($subject->block->name)  ?></td>
    </tr>
    <tr>
        <th><?= __('Id') ?></th>
        <td><?= $this->Number->format($subject->id) ?></td>
    </tr>
</table>
