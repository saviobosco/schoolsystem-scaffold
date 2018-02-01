<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $class
 */
$this->extend('/Common/view');
$this->assign('title','View Class');
?>
<table class="table table-bordered">
    <tr>
        <th><?= __('Class') ?></th>
        <td><?= h($class->class) ?></td>
    </tr>
    <tr>
        <th><?= __('Id') ?></th>
        <td><?= $this->Number->format($class->id) ?></td>
    </tr>
    <tr>
        <th><?= __('Block') ?></th>
        <td><?= $class->block->name ?></td>
    </tr>
    <tr>
        <th><?= __('Created') ?></th>
        <td><?= h($class->created) ?></td>
    </tr>
    <tr>
        <th><?= __('Modified') ?></th>
        <td><?= h($class->modified) ?></td>
    </tr>
</table>

<div class="related">
    <h4><?= __('Related Class Demarcations') ?></h4>
    <?php if (!empty($class->class_demarcations)): ?>
        <table class="table table-responsive table-bordered">
            <tr>
                <th><?= __('Name') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($class->class_demarcations as $classDemarcations): ?>
                <tr>
                    <td><?= h($classDemarcations->name) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>