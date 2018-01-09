<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Session'), ['action' => 'edit', $session->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Session'), ['action' => 'delete', $session->id], ['confirm' => __('Are you sure you want to delete # {0}?', $session->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sessions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Session'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Students'), ['controller' => 'Students', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Student'), ['controller' => 'Students', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="sessions view large-9 medium-8 columns content">
    <h3><?= h($session->session) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Session') ?></th>
            <td><?= h($session->session) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($session->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($session->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($session->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Students') ?></h4>
        <?php if (!empty($session->students)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('First Name') ?></th>
                <th><?= __('Last Name') ?></th>
                <th><?= __('Date Of Birth') ?></th>
                <th><?= __('Gender') ?></th>
                <th><?= __('State Of Origin') ?></th>
                <th><?= __('Religion') ?></th>
                <th><?= __('Home Residence') ?></th>
                <th><?= __('Gaurdian') ?></th>
                <th><?= __('Relationship To Gaurdian') ?></th>
                <th><?= __('Occupation Of Gaurdian') ?></th>
                <th><?= __('Gaurdian Phone Number') ?></th>
                <th><?= __('Session Id') ?></th>
                <th><?= __('Class Id') ?></th>
                <th><?= __('Photo') ?></th>
                <th><?= __('Photo Dir') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($session->students as $students): ?>
            <tr>
                <td><?= h($students->id) ?></td>
                <td><?= h($students->first_name) ?></td>
                <td><?= h($students->last_name) ?></td>
                <td><?= h($students->date_of_birth) ?></td>
                <td><?= h($students->gender) ?></td>
                <td><?= h($students->state_of_origin) ?></td>
                <td><?= h($students->religion) ?></td>
                <td><?= h($students->home_residence) ?></td>
                <td><?= h($students->gaurdian) ?></td>
                <td><?= h($students->relationship_to_gaurdian) ?></td>
                <td><?= h($students->occupation_of_gaurdian) ?></td>
                <td><?= h($students->gaurdian_phone_number) ?></td>
                <td><?= h($students->session_id) ?></td>
                <td><?= h($students->class_id) ?></td>
                <td><?= h($students->photo) ?></td>
                <td><?= h($students->photo_dir) ?></td>
                <td><?= h($students->created) ?></td>
                <td><?= h($students->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Students', 'action' => 'view', $students->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Students', 'action' => 'edit', $students->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Students', 'action' => 'delete', $students->id], ['confirm' => __('Are you sure you want to delete # {0}?', $students->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
