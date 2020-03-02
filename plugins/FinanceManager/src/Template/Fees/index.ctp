<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Fee[]|\Cake\Collection\CollectionInterface $fees
  */


$this->extend('/Common/view');
$this->assign('title','Fees');

$queryData = $this->request->getQuery();
?>
<div class="m-b-20">
    <?= $this->Html->link('Create New Fee',['controller'=>'Fees','action'=>'add'],['class'=>'btn btn-primary m-r-15']) ?>
    <?= $this->Html->link('Fees Statistics',['controller'=>'FeesStatistics','action'=>'index'],['class'=>'btn btn-primary m-r-15']) ?>
    <?= $this->Html->link('Fees Defaulters',['controller'=>'FeesDefaulters','action'=>'index'],['class'=>'btn btn-danger m-r-15']) ?>
    <?= $this->Html->link('Fees Query',['controller'=>'Fees','action'=>'feesQuery'],['class'=>'btn btn-info m-r-15']) ?>
</div>

<div class="m-b-20">
    <form id="search-form" action="" class="form-inline">
        <?php if (isset($queryData['page'])) : ?>
        <input type="hidden" name="page" value="">
        <?php endif ?>
        <?= $this->Form->input('fee_category_id',[
            'options' => $feeCategories,'class'=>'form-control',
            'label'=> 'Fee Category',
            'empty' => '- select category -',
            'value'=>(isset($queryData['fee_category_id']) && !empty($queryData['fee_category_id'])) ? $queryData['fee_category_id'] : '']); ?>

        <?= $this->Form->input('session_id',[
            'options' => $sessions,'class'=>'form-control',
            'label'=> 'Session',
            'empty' => '- select session -',
            'value'=>(isset($queryData['session_id']) && !empty($queryData['session_id'])) ? $queryData['session_id'] : '']); ?>

        <?= $this->Form->input('class_id',[
            'options' => $classes,'class'=>'form-control',
            'label'=> 'Class',
            'empty' => '- select term -',
            'value'=>(isset($queryData['class_id']) && !empty($queryData['class_id'])) ? $queryData['class_id'] : '']); ?>

        <?= $this->Form->input('term_id',[
            'options' => $terms,'class'=>'form-control',
            'empty' => '- select term -',
            'label'=> 'Term',
            'value'=>(isset($queryData['term_id']) && !empty($queryData['term_id'])) ? $queryData['term_id'] : '']); ?>

    </form>
</div>

<table id="data-table" class="table table-bordered table-responsive">
    <thead>
    <tr>
        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('fee_category_id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
        <th scope="col"><?= $this->Paginator->sort('term_id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('class_id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('session_id') ?></th>
        <th scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($fees as $fee): ?>
        <tr>
            <td><?= $this->Number->format($fee->id) ?></td>
            <td><?= $fee->fee_category->type ?></td>
            <td><?= $this->Currency->displayCurrency($fee->amount) ?></td>
            <td><?= @$fee->term->name ?></td>
            <td><?= @$fee->class->class ?></td>
            <td><?= @$fee->session->session ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $fee->id],['class'=>'btn btn-primary btn-sm','escape'=>false]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $fee->id],['class'=>'btn btn-info btn-sm','escape'=>false]) ?>
                <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', ['action' => 'delete', $fee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fee->id),'escape'=>false,'class'=>'btn btn-sm btn-danger m-l-5']) ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('first')) ?>
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
        <?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
</div>

<script>
    $('select').change(function(event) {
        loadData();
    });

    function loadData() {
        $('#search-form').submit();
    }
</script>

