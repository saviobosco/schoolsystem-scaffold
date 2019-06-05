<?php $this->assign('title', 'My pins'); ?>

<div class="row m-t-20">
    <div class="col-sm-12">

        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> <?= __('My Pins') ?> </h4>
            </div>
            <div class="panel-body">

                <?php if($pins): ?>
                    <h3></h3>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th> Serial Number</th>
                            <th> Pin</th>
                            <th> Session</th>
                            <th> Class</th>
                            <th> Term</th>
                            <th> Created</th>
                            <th> Used on </th>
                            <th> Actions </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($pins as $pin): ?>
                            <tr>
                                <td><?= $pin->serial_number ?></td>
                                <td><?= $pin->pin ?></td>
                                <td><?= @$pin->session->session ?></td>
                                <td><?= @$pin->class->class ?></td>
                                <td><?= @$pin->term->name ?></td>
                                <td><?= (new \Cake\I18n\Time($pin->created))->format('Y-m-d')  ?></td>
                                <td><?= (new \Cake\I18n\Time($pin->modified))->format('Y-m-d') ?></td>
                                <td>
                                    <?= $this->Html->link('View result', [
                                        'plugin' => 'StudentAccount',
                                        'controller' => 'ResultPins',
                                        'action' => 'view',
                                        '?' => [
                                            'pin' => $pin->pin,
                                            'class_id' => $pin->class_id,
                                            'session_id' => $pin->session_id,
                                            'term_id' => $pin->term_id
                                        ]
                                    ]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>