<?php
/**
 * @var \App\View\AppView $this
 */

$this->extend('/Common/view');
$this->assign('title', 'Lecture Notes');

$queryData = $this->request->getQuery();
if (isset($queryData['lecture'])) {
    $queryData = $queryData['lecture'];
}
?>

<div class="m-b-15">
    <?= $this->Html->link(__('Add New Lecture Note'), ['action' => 'add'], ['class' => 'btn btn-primary float-right']) ?>

    <div class="m-t-20">
        <?= $this->Form->create('',['class'=>'form-inline','type'=>'GET', 'id' => 'search-form']) ?>
        <div class="form-group">
            <?= $this->Form->input('lecture.class_id',['options' => $classes,'class'=>'form-control','label'=>'Class' ,'value'=>(isset($queryData['class_id']) && !empty($queryData['class_id'])) ? $queryData['class_id'] : '']); ?>
            <?= $this->Form->input('lecture.subject_id',['options' => $subjects,'class'=>'form-control','label'=>'Subject','value'=>(isset($queryData['subject_id']) && !empty($queryData['subject_id'])) ? $queryData['subject_id'] : '']); ?>
            <?= $this->Form->input('lecture.session_id',['options' => $sessions,'class'=>'form-control','data-select-id'=>'school','label'=>['text'=>'Session '],'value'=>(isset($queryData['session_id']) && !empty($queryData['session_id'])) ? $queryData['session_id'] : '']); ?>
            <?= $this->Form->input('lecture.term_id',['options' => $terms,'class'=>'form-control','data-select-id'=>'level','label'=>['text'=>'Term'],'value'=>(isset($queryData['term_id']) && !empty($queryData['term_id'])) ? $queryData['term_id'] : '']); ?>
            <div class="form-group">
                <?= $this->Form->submit(__('change'),['class'=>'btn btn-primary']) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>

</div>

<table id="data-table" class="table table-bordered ">
    <thead>
    <tr>
        <th><?= '#' ?></th>
        <th><?= __('subject') ?></th>
        <th><?= __('topic') ?></th>
        <th><?= __('created at') ?></th>
        <th><?= __('updated at') ?></th>
        <th><?= __('created_by') ?></th>
        <th class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($lectures)) : ?>
    <?php $num = 1; ?>
        <?php foreach ($lectures as $lecture): ?>
            <tr>
                <td><?= $num ?></td>
                <td> <?= ($lecture->subject) ? h($lecture->subject->name) : '' ?> </td>
                <td><?= h($lecture->topic) ?></td>
                <td><?= h($lecture->created_at) ?></td>
                <td><?= h($lecture->updated_at) ?></td>
                <td><?= h($lecture->created_by) ?></td>

                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $lecture->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lecture->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lecture->id], [
                        'confirm' => __('Are you sure you want to delete # {0}?', $lecture->id),
                        'class' => 'text-danger'
                    ]) ?>
                </td>
            </tr>
            <?php $num++; ?>
        <?php endforeach; ?>

    <?php endif; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>
