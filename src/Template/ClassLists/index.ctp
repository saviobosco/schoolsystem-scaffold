<?php
$this->layout = 'custom';
$queryData = $this->request->getQuery();
?>
<div class="row">
    <div class="col-sm-12">

        <div>
            <?= $this->Form->create('',['class'=>'form-inline','type'=>'GET']) ?>
            <div class="form-group">
                <?= $this->Form->input('class_id',['empty' => 'all Classes', 'options' => $classes,'class'=>'form-control','label'=>['text'=>'Select Class'],'value'=>(isset($queryData['class_id']) && !empty($queryData['class_id'])) ? $queryData['class_id'] : 1]); ?>
                <?= $this->Form->input(__('change'),['class'=>'btn btn-primary','type' => 'submit',
                    'templates' => [
                        'submitContainer' => '{{content}}'
                    ]
                ]) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>

        <?php if (isset($classLists) && !empty($classLists)) :  ?>
            <table class="table">
                <thead>
                <tr>
                    <th>Admission Number</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($classLists as $student) :  ?>
                    <tr>
                        <td> <?= $student->id ?> </td>
                        <td> <?= $student->first_name ?> </td>
                        <td> <?= $student->last_name ?> </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                </ul>
                <p><?= $this->Paginator->counter(
                        'Page {{page}} of {{pages}}, showing {{current}} records out of
                                {{count}} total, starting on record {{start}}, ending on {{end}}'
                    ); ?>
                </p>
            </div>
        <?php endif; ?>




    </div>
</div>