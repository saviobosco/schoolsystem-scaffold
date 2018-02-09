<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Student[]|\Cake\Collection\CollectionInterface $students
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
                            <?= $this->Form->control('class_id',['empty'=>true, 'options' => $classes,'class'=>'form-control','data-select-id'=>'level','label'=>['text'=>'Select Students Class'],'value'=>@$this->SearchParameter->getDefaultValue($this->request->query['class_id'])]); ?>
                            <?= $this->Form->submit(__('change'),[
                                'templates' => [
                                    'submitContainer' => '{{content}}'
                                ],
                                'class'=>'btn btn-primary']) ?>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>

                <?php if ( $students) : ?>
                <?= $this->Form->create() ?>

                <h3><?= __('Students') ?></h3>
                <table class="table table-responsive" >
                    <thead>
                    <tr>
                        <th scope="col"><?= h('Admission Number') ?></th>
                        <th scope="col"><?= __('First Name') ?></th>
                        <th scope="col"><?= __('Last Name') ?></th>
                        <th scope="col"><?= __('class') ?></th>
                        <th scope="col"> <input type="checkbox" id="selectall"> select all</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?= h($student->id) ?></td>
                            <td><?= h($student->first_name) ?></td>
                            <td><?= h($student->last_name) ?></td>
                            <td><?= h($student->class->class) ?></td>
                            <td> <input type="checkbox" class="checkbox1" name="student_ids[]" value="<?= $student->id ?>"> </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $this->Form->control('change_class_id',['options' => $classes,'class'=>'form-control','data-select-id'=>'level','label'=>['text'=>'Change Students Class To'],'required'=>true ]); ?>
                <?= $this->Form->submit(__('change Class'),[
                    'class'=>'btn btn-primary'
                ]) ?>

                <?= $this->Form->end() ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
