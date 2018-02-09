<?php
use Cake\I18n\Time;
?>
<div class="row">
    <div class="col-sm-12">
        <h3><?= h($termTimeTable->id) ?></h3>
        <table class="vertical-table">
            <tr>
                <th><?= __('Term') ?></th>
                <td><?= $termTimeTable->has('term') ? $this->Html->link($termTimeTable->term->name, ['controller' => 'Terms', 'action' => 'view', $termTimeTable->term->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Session') ?></th>
                <td><?= $termTimeTable->has('session') ? $this->Html->link($termTimeTable->session->id, ['controller' => 'Sessions', 'action' => 'view', $termTimeTable->session->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($termTimeTable->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Start Date') ?></th>
                <td><?= (new Time($termTimeTable->start_date))->format('l jS \\of F, Y')  ?></td>
            </tr>
            <tr>
                <th><?= __('End Date') ?></th>
                <td><?= (new Time($termTimeTable->end_date))->format('l jS \\of F, Y')  ?></td>
            </tr>
        </table>
    </div>
</div>