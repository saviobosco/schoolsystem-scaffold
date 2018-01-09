<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $students
 */
$formTemplates = [
    'submitContainer' => '{{content}}'
];
$this->Form->setTemplates($formTemplates);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> All Students  </h4>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-sm-12">
                        <?= $this->Form->create('',['class'=>'form-inline','type'=>'GET']) ?>
                        <div class="form-group">
                            <?= $this->Form->control('class_id',['empty'=>'All','options' => $classes,'class'=>'form-control','data-select-id'=>'level','label'=>['text'=>'Change Class'],'value'=>($this->request->getQuery('class_id')) ? $this->request->getQuery('class_id') : '' ]); ?>
                            <?= $this->Form->submit(__('change'),[
                                'templates' => [
                                    'submitContainer' => '{{content}}'
                                ],
                                'class'=>'btn btn-primary']) ?>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>


                <h3><?= __('Students') ?></h3>
                <table id="data-table" class="table table-responsive" >
                    <thead>
                    <tr>
                        <th scope="col"><?= h('Admission Number') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('gender') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('class_id') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?= h($student->id) ?></td>
                            <td><?= h($student->first_name) ?></td>
                            <td><?= h($student->last_name) ?></td>
                            <td><?= h($student->gender) ?></td>
                            <td><?= h($student->class->class) ?></td>
                            <td class="actions">
                                <?= $this->Html->link('Pay Fees <i class="fa fa-money"></i>',[
                                    'controller'=>'Students',
                                    'action'=>'getStudentFees',
                                    '?'=>[
                                        'student_id'=>$student->id
                                    ]
                                ], [
                                        'escape' => false,
                                        'class'=>'btn btn-sm btn-primary m-r-5'
                                    ]
                                ) ?>
                                <?= $this->Html->link(__('View'), ['action' => 'view','?'=>['student_id'=>$student->id]],['escape'=>false,'class'=>'btn btn-inverse btn-sm']) ?>

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
            </div>
        </div>
    </div>
</div>
