<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Term'), ['action' => 'edit', $term->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Term'), ['action' => 'delete', $term->id], ['confirm' => __('Are you sure you want to delete # {0}?', $term->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Terms'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Term'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Student Termly Results'), ['controller' => 'StudentTermlyResults', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Termly Result'), ['controller' => 'StudentTermlyResults', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="terms view large-9 medium-8 columns content">
    <h3><?= h($term->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($term->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($term->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($term->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($term->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Student Termly Results') ?></h4>
        <?php if (!empty($term->student_termly_results)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Student Id') ?></th>
                <th><?= __('Subject Id') ?></th>
                <th><?= __('First Test') ?></th>
                <th><?= __('Second Test') ?></th>
                <th><?= __('Third Test') ?></th>
                <th><?= __('Exam') ?></th>
                <th><?= __('Total') ?></th>
                <th><?= __('Grade') ?></th>
                <th><?= __('Remark') ?></th>
                <th><?= __('Principal Comment') ?></th>
                <th><?= __('Head Teacher Comment') ?></th>
                <th><?= __('Class Id') ?></th>
                <th><?= __('Term Id') ?></th>
                <th><?= __('Session Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($term->student_termly_results as $studentTermlyResults): ?>
            <tr>
                <td><?= h($studentTermlyResults->id) ?></td>
                <td><?= h($studentTermlyResults->student_id) ?></td>
                <td><?= h($studentTermlyResults->subject_id) ?></td>
                <td><?= h($studentTermlyResults->first_test) ?></td>
                <td><?= h($studentTermlyResults->second_test) ?></td>
                <td><?= h($studentTermlyResults->third_test) ?></td>
                <td><?= h($studentTermlyResults->exam) ?></td>
                <td><?= h($studentTermlyResults->total) ?></td>
                <td><?= h($studentTermlyResults->grade) ?></td>
                <td><?= h($studentTermlyResults->remark) ?></td>
                <td><?= h($studentTermlyResults->principal_comment) ?></td>
                <td><?= h($studentTermlyResults->head_teacher_comment) ?></td>
                <td><?= h($studentTermlyResults->class_id) ?></td>
                <td><?= h($studentTermlyResults->term_id) ?></td>
                <td><?= h($studentTermlyResults->session_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'StudentTermlyResults', 'action' => 'view', $studentTermlyResults->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'StudentTermlyResults', 'action' => 'edit', $studentTermlyResults->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'StudentTermlyResults', 'action' => 'delete', $studentTermlyResults->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentTermlyResults->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
