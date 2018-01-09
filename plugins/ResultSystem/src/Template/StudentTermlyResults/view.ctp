<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Student Termly Result'), ['action' => 'edit', $studentTermlyResult->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Student Termly Result'), ['action' => 'delete', $studentTermlyResult->id], ['confirm' => __('Are you sure you want to delete # {0}?', $studentTermlyResult->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Student Termly Results'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student Termly Result'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subjects'), ['controller' => 'Subjects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subject'), ['controller' => 'Subjects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Classes'), ['controller' => 'Classes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Class'), ['controller' => 'Classes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Terms'), ['controller' => 'Terms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Term'), ['controller' => 'Terms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sessions'), ['controller' => 'Sessions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session'), ['controller' => 'Sessions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="studentTermlyResults view large-9 medium-8 columns content">
    <h3><?= h($studentTermlyResult->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Student') ?></th>
            <td><?= $studentTermlyResult->has('student') ? $this->Html->link($studentTermlyResult->student->id, ['controller' => 'Students', 'action' => 'view', $studentTermlyResult->student->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Subject') ?></th>
            <td><?= $studentTermlyResult->has('subject') ? $this->Html->link($studentTermlyResult->subject->name, ['controller' => 'Subjects', 'action' => 'view', $studentTermlyResult->subject->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Grade') ?></th>
            <td><?= h($studentTermlyResult->grade) ?></td>
        </tr>
        <tr>
            <th><?= __('Remark') ?></th>
            <td><?= h($studentTermlyResult->remark) ?></td>
        </tr>
        <tr>
            <th><?= __('Principal Comment') ?></th>
            <td><?= h($studentTermlyResult->principal_comment) ?></td>
        </tr>
        <tr>
            <th><?= __('Head Teacher Comment') ?></th>
            <td><?= h($studentTermlyResult->head_teacher_comment) ?></td>
        </tr>
        <tr>
            <th><?= __('Class') ?></th>
            <td><?= $studentTermlyResult->has('class') ? $this->Html->link($studentTermlyResult->class->class, ['controller' => 'Classes', 'action' => 'view', $studentTermlyResult->class->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Term') ?></th>
            <td><?= $studentTermlyResult->has('term') ? $this->Html->link($studentTermlyResult->term->name, ['controller' => 'Terms', 'action' => 'view', $studentTermlyResult->term->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Session') ?></th>
            <td><?= $studentTermlyResult->has('session') ? $this->Html->link($studentTermlyResult->session->session, ['controller' => 'Sessions', 'action' => 'view', $studentTermlyResult->session->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($studentTermlyResult->id) ?></td>
        </tr>
        <tr>
            <th><?= __('First Test') ?></th>
            <td><?= $this->Number->format($studentTermlyResult->first_test) ?></td>
        </tr>
        <tr>
            <th><?= __('Second Test') ?></th>
            <td><?= $this->Number->format($studentTermlyResult->second_test) ?></td>
        </tr>
        <tr>
            <th><?= __('Third Test') ?></th>
            <td><?= $this->Number->format($studentTermlyResult->third_test) ?></td>
        </tr>
        <tr>
            <th><?= __('Exam') ?></th>
            <td><?= $this->Number->format($studentTermlyResult->exam) ?></td>
        </tr>
        <tr>
            <th><?= __('Total') ?></th>
            <td><?= $this->Number->format($studentTermlyResult->total) ?></td>
        </tr>
    </table>
</div>
