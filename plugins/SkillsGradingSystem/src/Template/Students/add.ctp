<?php
$edittemplates = [
    'label' => '',
    'submitContainer' => '{{content}}'
];
$this->Form->templates($edittemplates);

?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Students'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Sessions'), ['controller' => 'Sessions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Session'), ['controller' => 'Sessions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Classes'), ['controller' => 'Classes', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="students form large-9 medium-8 columns content">
    <?= $this->Form->create($student) ?>
    <fieldset>
        <legend><?= __('Add Students Skills ') ?></legend>
        <?php if (!empty($affectiveSkills)): ?>

            <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Affective Skills') ?></th>
                <th><?= __('Scores') ?></th>
            </tr>
            <?php for ($num = 0; $num < count($affectiveSkills); $num++ ): ?>
                <tr>
                    <td><?= h($affectiveSkills[$num]['name']) ?></td>
                    <td><?= $this->Form->input('students_affective_disposition_scores.'.$num.'.score') ?></td>
                    <td><?= $this->Form->hidden('students_affective_disposition_scores.'.$num.'.affective_id',['value'=>$affectiveSkills[$num]['id']]) ?></td>
                    <td><?= $this->Form->hidden('students_affective_disposition_scores.'.$num.'.student_id',['value' => $student->id]) ?></td>
                    <td><?= $this->Form->hidden('students_affective_disposition_scores.'.$num.'.class_id',['value' => $student->class_id]) ?></td>
                    <td><?= $this->Form->hidden('students_affective_disposition_scores.'.$num.'.term_id',['value' => $student->id]) ?></td>
                    <td><?= $this->Form->hidden('students_affective_disposition_scores.'.$num.'.session_id',['value' => $student->session_id]) ?></td>


                </tr>
            <?php endfor; ?>
        </table>
        <?php endif; ?>

        <?php if (!empty($psychomotorSkills)): ?>

            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th><?= __('Psychomotor Skills') ?></th>
                    <th><?= __('Scores') ?></th>
                </tr>
                <?php for ($num = 0; $num < count($psychomotorSkills); $num++ ): ?>
                    <tr>
                        <td><?= h($psychomotorSkills[$num]['name']) ?></td>
                        <td><?= $this->Form->input('students_psychomotor_skill_scores.'.$num.'.score') ?></td>
                        <td><?= $this->Form->hidden('students_psychomotor_skill_scores.'.$num.'.psychomotor_id',['value' =>$psychomotorSkills[$num]['id'] ]) ?></td>
                        <td><?= $this->Form->hidden('students_psychomotor_skill_scores.'.$num.'.student_id',['value' => $student->id]) ?></td>
                        <td><?= $this->Form->hidden('students_psychomotor_skill_scores.'.$num.'.class_id',['value' => $student->class_id]) ?></td>
                        <td><?= $this->Form->hidden('students_psychomotor_skill_scores.'.$num.'.term_id',['value' => $student->id]) ?></td>
                        <td><?= $this->Form->hidden('students_psychomotor_skill_scores.'.$num.'.session_id',['value' => $student->session_id]) ?></td>


                    </tr>
                <?php endfor; ?>
            </table>
        <?php endif; ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
