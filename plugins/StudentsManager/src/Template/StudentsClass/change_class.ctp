<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Student[]|\Cake\Collection\CollectionInterface $students
  */

$formTemplates = [
    'submitContainer' => '{{content}}'
];
$this->Form->setTemplates($formTemplates);
$this->extend('/Common/view');
$this->assign('title','Add Students');
?>
<?= $this->element('searchParametersClass') ?>
<?php if ( $students) : ?>
    <?= $this->Form->create() ?>

    <h3><?= __('Students') ?></h3>
    <table class="table table-responsive" >
        <thead>
        <tr>
            <th scope="col"><?= h('Admission Number') ?></th>
            <th scope="col"><?= __('Full Name') ?></th>
            <th scope="col"><?= __('class') ?></th>
            <th scope="col"> <input type="checkbox" id="selectall"> select all</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= h($student->id) ?></td>
                <td><?= h($student->full_name) ?></td>
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
